<?php
defined("BASEPATH") or exit("No direct script access allowed");

class ViewFisherModel extends CI_Model
{

  public function __construct()
  {
    parent::__construct();
    $this->load->database();
  }

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

  // Get the count of unread notifications for the user
  public function countUnreadNotifications()
  {
    $this->db->select('COUNT(*) as unread_count');
    $this->db->from('notifications');
    $this->db->where('status', 'Unread');
    $query = $this->db->get();

    $result = $query->row_array();
    return $result ? $result['unread_count'] : 0;
  }

  // Fetch fisher profile details based on fisher_id
  public function getFisherDetails($fisher_id)
  {
    $this->db->select('fisher_number, f_name, m_name, l_name, suffix, TIMESTAMPDIFF(YEAR, birthdate, CURDATE()) AS age, gender, cell_number');
    $this->db->from('fisher_profile');
    $this->db->where('fisher_id', $fisher_id);
    $query = $this->db->get();

    return $query->row_array(); // Returns fisher details
  }

  // Fetch fisher address details
  public function getFisherAddress($fisher_id)
  {
    $this->db->select('brgy_name, city, province');
    $this->db->from('fisher_address');
    $this->db->where('fisher_id', $fisher_id);
    $query = $this->db->get();

    return $query->row_array(); // Returns address details
  }

  // Fetch vessel image for the fisher
  public function getVesselImage($fisher_id)
  {
    $this->db->select('image');
    $this->db->from('vessel');
    $this->db->where('fisher_id', $fisher_id);
    $query = $this->db->get();

    return $query->row_array(); // Returns image data
  }

  // Fetch catches for a given fisher
  public function getFisherCatches($fisher_id)
  {
    $this->db->select('fcr.fisher_report_id, fcr.fisher_id, fp.f_name AS first_name, fp.l_name AS last_name, fcr.species, fcr.quantity, fcr.equipments, fcr.distance, fcr.operation_start, fcr.operation_end, fcr.date_of_catch, fcr.date_of_submission');
    $this->db->from('fisher_catch_report fcr');
    $this->db->join('fisher_profile fp', 'fcr.fisher_id = fp.fisher_id');
    $this->db->where('fcr.fisher_id', $fisher_id);
    $this->db->order_by('fcr.species');
    $query = $this->db->get();

    return $query->result_array();
  }

  // Fetch monthly total catch data
  public function getMonthlyCatchData($fisher_id)
  {
    $this->db->select("DATE_FORMAT(date_of_catch, '%Y-%m') AS month, ROUND(SUM(quantity), 2) AS total");
    $this->db->from('fisher_catch_report');
    $this->db->where('fisher_id', $fisher_id);
    $this->db->group_by('month');
    $this->db->order_by('month');
    $query = $this->db->get();

    $data = array_fill(0, 12, 0); // Initialize data for 12 months
    foreach ($query->result_array() as $row) {
      $month = date('n', strtotime($row['month'])) - 1; // Get month index (0-11)
      $data[$month] = round((float) $row['total'], 3);
    }

    return $data;
  }

  // Fetch catch data by species and month
  public function getSpeciesCatchData($fisher_id)
  {
    $this->db->select('gc.species AS species, DATE_FORMAT(gc.date_of_catch, "%Y-%m") AS month, SUM(gc.quantity) AS total_quantity');
    $this->db->from('fisher_catch_report gc');
    $this->db->where('gc.fisher_id', $fisher_id);
    $this->db->group_by('gc.species, month');
    $this->db->order_by('gc.species, month');
    $query = $this->db->get();

    $species_data = [];
    $species_chart_data = [];

    foreach ($query->result_array() as $row) {
      $species_name = $row['species'];
      $month = date('n', strtotime($row['month'])) - 1; // Get month index (0-11)
      $total_quantity = round((float) $row['total_quantity'], 3);

      if (!isset($species_chart_data[$species_name])) {
        $species_chart_data[$species_name] = array_fill(0, 12, 0);
      }
      $species_chart_data[$species_name][$month] = $total_quantity;

      if (!isset($species_data[$species_name])) {
        $species_data[$species_name] = ['species' => $species_name, 'total_quantity' => 0];
      }
      $species_data[$species_name]['total_quantity'] += $total_quantity;
    }

    return [
      'species_data' => $species_data,
      'species_chart_data' => $species_chart_data,
    ];
  }

  // Fetch image base64 encoding for the vessel image
  public function getVesselImageBase64($fisher_id)
  {
    $this->db->select('image');
    $this->db->from('vessel');
    $this->db->where('fisher_id', $fisher_id);
    $query = $this->db->get();

    $result = $query->row_array();
    if ($result && isset($result['image'])) {
      return "data:image/jpeg;base64," . base64_encode($result['image']);
    }
    return null; // Return null if no image found
  }
}
?>