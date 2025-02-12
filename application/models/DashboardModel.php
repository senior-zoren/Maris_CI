<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class DashboardModel extends CI_Model {

    // Method to get all counts
    public function getCounts() {
        // Fetching counts for all entities
        return [
            'fisherman_count' => $this->getFishermanCount(),
            'farmer_count' => $this->getFarmerCount(),
            'farm_count' => $this->getFarmCount(),
            'vessel_count' => $this->getVesselCount()
        ];
    }

    // Method to get the count of fishermen
    private function getFishermanCount() {
        return $this->db->count_all('fisher_profile');
    }

    // Method to get the count of farmers
    private function getFarmerCount() {
        return $this->db->count_all('farmer_profile');
    }

    // Method to get the count of farms
    private function getFarmCount() {
        return $this->db->count_all('farm_profile');
    }

    // Method to get the count of vessels
    private function getVesselCount() {
        return $this->db->count_all('vessel');
    }

    // Method to get all fisherman and farmer profiles
    public function getProfiles() {
        $sql = "
            SELECT 
                fp.fisher_id AS id, 
                fp.fisher_number as reg_number, 
                fp.f_name, 
                fp.m_name, 
                fp.l_name, 
                fp.suffix, 
                fp.gender,
                'Fisherman' AS profile_type
            FROM fisher_profile fp
            JOIN fisher_address fa ON fp.fisher_id = fa.fisher_id
            JOIN barangay b ON fa.brgy_name = b.brgy_name

            UNION ALL

            SELECT 
                fp.farmer_id AS id, 
                fp.farmer_number as reg_number, 
                fp.f_name, 
                fp.m_name, 
                fp.l_name, 
                fp.suffix, 
                fp.gender,
                'Farmer' AS profile_type
            FROM farmer_profile fp
            JOIN farmer_address fa ON fp.farmer_id = fa.farmer_id
            JOIN barangay b ON fa.brgy_name = b.brgy_name

            ORDER BY f_name, id ASC
        ";

        // Execute the query and return the result as an array
        $query = $this->db->query($sql);
        return $query->result_array();
    }
}
