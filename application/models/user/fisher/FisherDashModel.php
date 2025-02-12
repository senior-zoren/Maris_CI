<?php
defined('BASEPATH') or exit('No direct script access allowed');

class FisherDashModel extends CI_Model
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
   * Get catch limit details.
   */
  public function getCatchLimit()
  {
    $this->db->select('catch_limit, start_date, end_date');
    $this->db->where('limit_id', 1);
    $query = $this->db->get('catch_limit');
    if ($query->num_rows() > 0) {
      return $query->row_array();
    } else {
      return null; // If no data is found, return null
    }
  }

  /**
   * Get total catch quantity for a specific year.
   */
  public function getTotalCatchQuantity($year)
  {
    $this->db->select_sum('gen_quantity', 'total_quantity');
    $this->db->where('YEAR(date_of_catch)', $year);
    $query = $this->db->get('fisher_gen_catch_report');

    $result = $query->row();
    $total_quantity = $result ? $result->total_quantity : 0;

    // Format to 2 decimal places
    return number_format($total_quantity ?? 0, 2, '.', ',');
  }


  /**
   * Count fisherman profiles.
   */
  public function countFishermanProfiles()
  {
    return $this->db->count_all('fisher_profile');
  }

  /**
   * Count marine species.
   */
  public function countMarineSpecies()
  {
    return $this->db->count_all('species');
  }

  /**
   * Count recorded vessels.
   */
  public function countVessels()
  {
    return $this->db->count_all('vessel');
  }

  /**
   * Get weekly totals for a specific month and year.
   */
  public function getWeeklyTotals($year, $month, $table, $quantity_column)
  {
    $sql = "SELECT WEEK(date_of_catch, 1) - WEEK(DATE_SUB(date_of_catch, INTERVAL DAYOFMONTH(date_of_catch) - 1 DAY), 1) + 1 AS week, 
                       SUM($quantity_column) AS total 
                FROM $table 
                WHERE YEAR(date_of_catch) = ? AND MONTH(date_of_catch) = ?
                GROUP BY week";
    $query = $this->db->query($sql, [$year, $month]);
    $weeklyTotals = array_fill(1, 5, 0); // Initialize weekly totals

    foreach ($query->result_array() as $row) {
      $week = (int) $row['week'];
      if ($week >= 1 && $week <= 5) {
        $weeklyTotals[$week] = $row['total'];
      }
    }
    return $weeklyTotals;
  }

  /**
   * Get weekly totals by species for a specific month and year.
   */
  public function getWeeklySpeciesData($year, $month)
  {
    $sql = "SELECT species, 
                       WEEK(date_of_catch, 1) - WEEK(DATE_SUB(date_of_catch, INTERVAL DAYOFMONTH(date_of_catch) - 1 DAY), 1) + 1 AS week, 
                       SUM(gen_quantity) AS total 
                FROM fisher_gen_catch_report as fgcr
                INNER JOIN species ON fgcr.species = species.common_name 
                WHERE YEAR(date_of_catch) = ? AND MONTH(date_of_catch) = ?
                GROUP BY species, week";
    $query = $this->db->query($sql, [$year, $month]);

    $speciesData = [];
    foreach ($query->result_array() as $row) {
      $species = $row['species'];
      $week = (int) $row['week'];
      $total = $row['total'];

      if (!isset($speciesData[$species])) {
        $speciesData[$species] = [0, 0, 0, 0, 0]; // Initialize array for 5 weeks
      }
      $speciesData[$species][$week - 1] = $total; // Assign total to the correct week
    }
    return $speciesData;
  }
}
?>