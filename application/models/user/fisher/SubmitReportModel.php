<?php
defined("BASEPATH") OR exit("No direct script access allowed");

class SubmitReportModel extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Get user details by user ID.
     */
    public function getUserDetails($user_id)
    {
        $this->db->select('f_name, l_name, user_type, image_path');
        $this->db->where('user_id', $user_id);
        $query = $this->db->get('user');
        $userDetails = $query->row_array();

        if ($userDetails && isset($userDetails['image_path'])) {
            $userDetails['image_path'] = "data:image/jpeg;base64," . base64_encode($userDetails['image_path']);
        }

        return $userDetails;
    }

    /**
     * Count unread notifications.
     */
    public function countUnreadNotifications()
    {
        $this->db->where('status', 'Unread');
        $this->db->from('notifications');
        return $this->db->count_all_results();
    }

    /**
     * Submit a catch report.
     * @param array $postData - Data from the form submission.
     * @return bool - TRUE on success, FALSE on failure.
     */
    public function submitCatchReport($postData)
    {
        // Start transaction
        $this->db->trans_start();

        // Insert into catch_report
        $catchReport = [
            'user_id' => $postData['user_id'],
            'fisherman' => $postData['fisherman'],
            'species' => $postData['species'],
            'quantity' => $postData['quantity'],
            'date_of_catch' => $postData['date_of_catch'],
            'date_of_submission' => date('Y-m-d H:i:s'),
        ];
        $this->db->insert('catch_report', $catchReport);
        $report_id = $this->db->insert_id();

        // Insert into fisher_gen_catch_report
        $fisherGenCatchReport = [
            'species' => $postData['species'],
            'gen_quantity' => $postData['quantity'],
            'date_of_catch' => $postData['date_of_catch'],
            'date_of_submission' => date('Y-m-d H:i:s'),
        ];
        $this->db->insert('fisher_gen_catch_report', $fisherGenCatchReport);

        // Insert into fisher_catch_report
        $fisherCatchReport = [
            'fisher_id' => $postData['fisher_id'],
            'species' => $postData['species'],
            'quantity' => $postData['quantity'],
            'equipments' => $postData['equipments'],
            'distance' => $postData['distance'],
            'operation_start' => $postData['operation_start'],
            'operation_end' => $postData['operation_end'],
            'date_of_catch' => $postData['date_of_catch'],
            'date_of_submission' => date('Y-m-d H:i:s'),
        ];
        $this->db->insert('fisher_catch_report', $fisherCatchReport);
        $fisher_report_id = $this->db->insert_id();

        // Calculate new total catch for the current month
        $fisherId = $postData['fisher_id'];
        $currentYear = date('Y');
        $currentMonth = date('n');

        $this->db->select('SUM(quantity) as total_quantity');
        $this->db->from('fisher_catch_report');
        $this->db->where('fisher_id', $fisherId);
        $this->db->where('MONTH(date_of_catch)', $currentMonth);
        $this->db->where('YEAR(date_of_catch)', $currentYear);
        $query = $this->db->get();
        $currentTotalCatch = $query->row()->total_quantity;
        $newTotalCatch = $currentTotalCatch + $postData['quantity'];

        // Get max catch limit
        $this->db->select('catch_limit');
        $this->db->from('catch_limit');
        $this->db->where('limit_id', 1);
        $this->db->where('CURDATE() BETWEEN start_date AND end_date');
        $limitQuery = $this->db->get();
        $maxCatchLimit = $limitQuery->row()->catch_limit;

        // Check if new total catch exceeds the limit
        if ($newTotalCatch > $maxCatchLimit) {
            // Check if a notification already exists for this fisherman for the current month
            $this->db->select('COUNT(*) as count');
            $this->db->from('notifications');
            $this->db->where('fisher_id', $fisherId);
            $this->db->where('MONTH(date_created)', $currentMonth);
            $this->db->where('YEAR(date_created)', $currentYear);
            $notifQuery = $this->db->get();
            $notificationExists = ($notifQuery->row()->count > 0);

            if (!$notificationExists) {
                // Insert notification
                $notification = [
                    'fisher_report_id' => $report_id,
                    'fisher_id' => $fisherId,
                    'subject' => 'Warning',
                    'message' => "Monthly catch limit exceeded by {$postData['fisherman']}: {$newTotalCatch} kg.",
                    'date_created' => date('Y-m-d H:i:s'),
                    'status' => 'Unread',
                ];
                $this->db->insert('notifications', $notification);
            }

            // Send SMS notification
            $smsSent = $this->sendSMS($postData['fisherPhoneNumber'], $postData['fisherman'], $newTotalCatch, $maxCatchLimit);

            if ($smsSent) {
                // Insert into sms_logs
                $smsLog = [
                    'recipient' => $postData['fisherPhoneNumber'],
                    'message' => $postData['smsMessage'],
                    'status' => 'Sent',
                    'date_created' => date('Y-m-d H:i:s'),
                ];
                $this->db->insert('sms_logs', $smsLog);
            }
        }

        // Insert into audit_log
        $auditLog = [
            'user_id' => $postData['user_id'],
            'user_name' => $postData['user_name'],
            'activity' => 'Report Submission',
            'description' => 'Submitted new catch report for fisherman: ' . $postData['fisherman'],
        ];
        $this->db->insert('audit_log', $auditLog);

        // Complete transaction
        $this->db->trans_complete();

        // Check transaction status
        if ($this->db->trans_status() === FALSE) {
            // Transaction failed
            return FALSE;
        } else {
            return TRUE;
        }
    }

    /**
     * Send SMS via Semaphore API.
     * @param string $recipient - Recipient phone number.
     * @param string $fishermanName - Name of the fisherman.
     * @param float $newTotalCatch - New total catch.
     * @param float $maxCatchLimit - Maximum catch limit.
     * @return bool - TRUE if SMS sent successfully, FALSE otherwise.
     */
    private function sendSMS($recipient, $fishermanName, $newTotalCatch, $maxCatchLimit)
    {
        $apiKey = "4081b71e7ac4d22b8dadbcb026ebd995";
        $smsMessage = "Hello $fishermanName, you have exceeded the monthly fish catch limit: {$maxCatchLimit}kg. Your total catch for this month is: {$newTotalCatch}kg.";

        $smsData = [
            'apikey' => $apiKey,
            'number' => $recipient,
            'message' => $smsMessage,
            'sendername' => "BoronganCAO"
        ];

        $url = "https://api.semaphore.co/api/v4/messages";

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($smsData));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $response = curl_exec($ch);
        curl_close($ch);

        $responseData = json_decode($response, true);

        if (isset($responseData[0]['message_id'])) {
            return TRUE;
        } else {
            return FALSE;
        }
    }
}
?>
