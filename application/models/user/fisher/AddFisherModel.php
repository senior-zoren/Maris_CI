<?php
defined("BASEPATH") or exit("No direct script access allowed");

class AddFisherModel extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Get user details by user ID.
     *
     * @param int $user_id
     * @return array|null
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
     *
     * @return int
     */
    public function countUnreadNotifications()
    {
        $this->db->where('status', 'Unread');
        $this->db->from('notifications');
        return $this->db->count_all_results();
    }

    /**
     * Get barangays by port ID.
     *
     * @param int $port_id
     * @return array
     */
    public function getBarangaysByPort($port_id)
    {
        $this->db->select('brgy_id, brgy_name');
        $this->db->where('port_id', $port_id);
        $query = $this->db->get('barangay');
        return $query->result_array();
    }

    /**
     * Get ports for dropdown.
     *
     * @return array
     */
    public function getPorts()
    {
        $this->db->select('port_id, port_name');
        $query = $this->db->get('ports');
        return $query->result_array();
    }

    /**
     * Insert a new fisher profile.
     *
     * @param array $data Profile data
     * @return int|null New fisher ID or null on failure
     */
    public function insertFisherProfile($data)
    {
        $this->db->insert('fisher_profile', $data);
        return $this->db->insert_id();
    }

    /**
     * Insert fisher address.
     *
     * @param array $data Address data
     * @return bool
     */
    public function insertFisherAddress($data)
    {
        return $this->db->insert('fisher_address', $data);
    }

    /**
     * Fetch the latest fisher number.
     *
     * @return string|null Last fisher number
     */
    public function getLastFisherNumber()
    {
        $year = date('y');
        $this->db->select('fisher_number');
        $this->db->like('fisher_number', "BOR-FM$year-", 'after');
        $this->db->order_by('fisher_number', 'DESC');
        $this->db->limit(1);
        $query = $this->db->get('fisher_profile');
        $row = $query->row_array();

        return $row ? $row['fisher_number'] : null;
    }

    /**
     * Fetch port name by ID.
     *
     * @param int $port_id
     * @return string|null
     */
    public function getPortNameById($port_id)
    {
        $this->db->select('port_name');
        $this->db->where('port_id', $port_id);
        $query = $this->db->get('ports');
        $row = $query->row_array();

        return $row ? $row['port_name'] : null;
    }

    /**
     * Fetch barangay name by ID.
     *
     * @param int $barangay_id
     * @return string|null
     */
    public function getBarangayNameById($barangay_id)
    {
        $this->db->select('brgy_name');
        $this->db->where('brgy_id', $barangay_id);
        $query = $this->db->get('barangay');
        $row = $query->row_array();

        return $row ? $row['brgy_name'] : null;
    }

    /**
     * Log an activity to the audit log.
     *
     * @param int $user_id
     * @param string $user_name
     * @param string $activity
     * @param string $description
     * @return bool
     */
    public function logActivity($user_id, $user_name, $activity, $description)
    {
        $sql = "CALL Auditlog(?, ?, ?, ?)";
        $params = [$user_id, $user_name, $activity, $description];
        return $this->db->query($sql, $params);
    }
}
