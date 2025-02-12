<?php
defined("BASEPATH") or exit("No direct script access allowed");

class VesselModel extends CI_Model
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
   * Get vessel details with fisher information.
   */
  public function getVesselData()
  {
    $this->db->select('
      v.reg_num,
      v.fisher_id,
      fp.f_name,
      fp.l_name,
      fp.suffix,
      v.year_built,
      v.equipments,
      v.material_used,
      v.gross_tonnage,
      v.net_tonnage,
      v.engine_make,
      v.vessel_name,
      v.status,
      DATE_FORMAT(v.date_registered, "%d-%b-%Y") as formatted_date
    ');
    $this->db->from('vessel v');
    $this->db->join('fisher_profile fp', 'v.fisher_id = fp.fisher_id', 'inner');
    $query = $this->db->get();

    return $query->result_array();
  }
}
?>
