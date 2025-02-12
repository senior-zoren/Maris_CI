<?php
defined("BASEPATH") OR exit("No direct script access allowed");

class ManualModel extends CI_Model
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
}
?>