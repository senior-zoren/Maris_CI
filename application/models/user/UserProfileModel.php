<?php
defined("BASEPATH") OR exit("No direct script access allowed");

class UserProfileModel extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Fetch user profile details.
     * 
     * @param int $user_id User ID.
     * @return array|false User profile data or false if not found.
     */
    public function getUserDetails($user_id)
    {
      $this->db->select('f_name, m_name, l_name, suffix, TIMESTAMPDIFF(YEAR, birthdate, CURDATE()) AS age, gender, user_type, cell_num, email, image_path');
      $this->db->where('user_id', $user_id);
      $query = $this->db->get('user');
      $userDetails = $query->row_array();
  
      if ($userDetails && isset($userDetails['image_path'])) {
        $userDetails['image_path'] = "data:image/jpeg;base64," . base64_encode($userDetails['image_path']);
      }
  
      return $userDetails;
    }

    /**
     * Fetch unread notifications count.
     * 
     * @return int Unread notifications count.
     */
    public function countUnreadNotifications()
    {
        $this->db->select("COUNT(*) AS unread_count");
        $this->db->from("notifications");
        $this->db->where("status", "Unread");
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return (int) $query->row()->unread_count;
        }
        return 0;
    }

    /**
     * Fetch user address details.
     * 
     * @param int $user_id User ID.
     * @return string User address.
     */
    public function get_user_address($user_id)
    {
        $this->db->select("barangay, city, province");
        $this->db->from("user_address");
        $this->db->where("user_id", $user_id);
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            $address = $query->row_array();
            return implode(", ", array_filter($address)); // Concatenate non-empty address parts.
        }
        return "";
    }

    /**
     * Fetch logs for the user with pagination.
     * 
     * @param int $user_id User ID.
     * @param int $limit Number of records per page.
     * @param int $offset Offset for pagination.
     * @return array Logs data.
     */
    public function get_user_logs($user_id, $limit, $offset)
    {
        $this->db->select("user, activity, description, date");
        $this->db->from("log");
        $this->db->where("user_id", $user_id);
        $this->db->order_by("date", "DESC");
        $this->db->limit($limit, $offset);
        $query = $this->db->get();

        return $query->result_array(); // Return all rows as an array.
    }

    /**
     * Count total logs for a user.
     * 
     * @param int $user_id User ID.
     * @return int Total log count.
     */
    public function count_user_logs($user_id)
    {
        $this->db->select("COUNT(*) AS total");
        $this->db->from("log");
        $this->db->where("user_id", $user_id);
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return (int) $query->row()->total;
        }
        return 0;
    }
}
