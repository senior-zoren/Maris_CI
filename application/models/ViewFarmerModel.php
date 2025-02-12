<?php
defined("BASEPATH") OR exit("No direct script access allowed");

class ViewFarmerModel extends CI_Model 
{

  public function __construct()
  {
    parent::__construct();
  }

  public function getFarmerDetails($farmer_id)
  {
    $this->db->select("farmer_number, f_name, m_name, l_name, suffix, TIMESTAMPDIFF(YEAR, birthdate, CURDATE()) AS age, gender, cell_number");
    $this->db->from("farmer_profile");
    $this->db->where("farmer_id", $farmer_id);
    $query = $this->db->get();

    return $query->row_array();
  }

  public function getFarmerAddress($farmer_id)
  {
    $this->db->select("brgy_name, city, province");
    $this->db->from("farmer_address");
    $this->db->where("farmer_id", $farmer_id);
    $query = $this->db->get();

    $row = $query->row_array();

    if (!$row){
      return [
        'brgy_name' => '',
        'city' => '',
        'province'=> '',
      ];
    }
    return $row;
  }

    // Fetch farmer catch reports
    public function getfarmerCatches($farmer_id)
    {
      $this->db->select('fcr.farmer_report_id, fcr.farmer_id, fp.f_name AS first_name, fp.l_name AS last_name, fcr.species, fcr.quantity, fcr.date_of_catch');
      $this->db->from('farmer_catch_report fcr');
      $this->db->join('farmer_profile fp', 'fcr.farmer_id = fp.farmer_id');
      $this->db->where('fcr.farmer_id', $farmer_id);
      $this->db->order_by('fcr.species');
      $query = $this->db->get();
  
      return $query->result_array();
    }
  
    // Fetch monthly total catch data
    public function getMonthlyCatchData($farmer_id)
    {
      $this->db->select("DATE_FORMAT(date_of_catch, '%Y-%m') AS month, ROUND(SUM(quantity), 2) AS total");
      $this->db->from('farmer_catch_report');
      $this->db->where('farmer_id', $farmer_id);
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
    public function getSpeciesCatchData($farmer_id)
    {
      $this->db->select('gc.species AS species, DATE_FORMAT(gc.date_of_catch, "%Y-%m") AS month, SUM(gc.quantity) AS total_quantity');
      $this->db->from('farmer_catch_report gc');
      $this->db->where('gc.farmer_id', $farmer_id);
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
}
?>