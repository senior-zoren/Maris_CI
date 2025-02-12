<?php
defined("BASEPATH") or exit("No direct script access allowed");

class FisherCatchReport extends CI_Model
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
   * Get all fisher catches
   */
  public function getFisherCatches()
  {
    $this->db->select('gc.species, gc.gen_quantity, gc.date_of_catch, gc.date_of_submission');
    $this->db->from('fisher_gen_catch_report gc');
    $this->db->join('species s', 'gc.species = s.common_name', 'inner');
    $this->db->order_by('gc.date_of_catch', 'ASC');
    $query = $this->db->get();
    return $query->result_array();
  }

  /**
   * Get total monthly catch data for the current year
   */
  public function getMonthlyCatchData($year)
  {
    $this->db->select("DATE_FORMAT(date_of_catch, '%Y-%m') AS month, SUM(gen_quantity) AS total");
    $this->db->from('fisher_gen_catch_report');
    $this->db->where('YEAR(date_of_catch)', $year);
    $this->db->group_by('month');
    $this->db->order_by('month', 'ASC');
    $query = $this->db->get();

    $monthlyData = array_fill(0, 12, 0);
    foreach ($query->result_array() as $row) {
      $month = date('n', strtotime($row['month'])) - 1; // Convert to zero-based index
      $monthlyData[$month] = round((float) $row['total'], 3);
    }
    return $monthlyData;
  }

  /**
   * Get catch data by species for the current year
   */
  public function getSpeciesCatchData($year)
  {
    $this->db->select("gc.species AS species, DATE_FORMAT(gc.date_of_catch, '%Y-%m') AS month, SUM(gc.gen_quantity) AS total_quantity, s.image_path");
    $this->db->from('fisher_gen_catch_report gc');
    $this->db->join('species s', 'gc.species = s.common_name', 'inner');
    $this->db->where('YEAR(gc.date_of_catch)', $year);
    $this->db->group_by('gc.species', 'month', 's.image_path');
    $this->db->order_by('gc.species', 'month', 'ASC');
    $query = $this->db->get();

    $species_data = [];
    $species_chart_data = [];

    foreach ($query->result_array() as $row) {
      $species_name = $row['species'];
      $month = date('n', strtotime($row['month'])) - 1;
      $total_quantity = round((float) $row['total_quantity'], 3);
      $imagePath = $row['image_path'];

      if (!isset($species_chart_data[$species_name])) {
        $species_chart_data[$species_name] = array_fill(0, 12, 0);
      }
      $species_chart_data[$species_name][$month] = $total_quantity;

      if (!isset($species_data[$species_name])) {
        $species_data[$species_name] = [
          'species' => $species_name,
          'total_quantity' => 0,
          'image_path' => $imagePath
        ];
      }
      $species_data[$species_name]['total_quantity'] += $total_quantity;
    }

    return [
      'species_data' => $species_data,
      'species_chart_data' => $species_chart_data
    ];
  }
}
?>