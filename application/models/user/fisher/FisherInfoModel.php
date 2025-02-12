<?php
defined("BASEPATH") or exit("No direct script access allowed");

class FisherInfoModel extends CI_Model
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
   *Get all fisherman data.
   */
  public function getFishermanData()
  {
      $this->db->select("fp.fisher_id, fp.fisher_number, 
                         CONCAT(fp.f_name, ' ', fp.m_name, ' ', fp.l_name, ' ', fp.suffix) AS fullname,
                         fp.cell_number, 
                         TIMESTAMPDIFF(YEAR, fp.birthdate, CURDATE()) AS age, 
                         fp.gender, 
                         CONCAT(b.brgy_name, ', ', fa.city, ', ', fa.province) AS address, 
                         fp.status");
      $this->db->from('fisher_profile fp');
      $this->db->join('fisher_address fa', 'fp.fisher_id = fa.fisher_id');
      $this->db->join('barangay b', 'fa.brgy_name = b.brgy_name');
      $this->db->order_by('fp.fisher_number', 'ASC');
      $query = $this->db->get();
      return $query->result_array();
  }
}
?>