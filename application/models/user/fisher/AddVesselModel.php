<?php
defined("BASEPATH") OR exit("No direct script access allowed");

class AddVesselModel extends CI_Model
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
     * Get list of fishers for the dropdown menu.
     */
    public function getFishers()
    {
        $this->db->select('fisher_id, f_name, l_name');
        $query = $this->db->get('fisher_profile');
        return $query->result_array();
    }

    /**
     * Get list of available equipments.
     */
    public function getEquipment()
    {
        $this->db->select('equipment_id, equipment');
        $query = $this->db->get('equipment');
        return $query->result_array();
    }

    /**
     * Get fisher number by fisher ID.
     */
    public function getFisherNumber($fisher_id)
    {
        $this->db->select('fisher_number');
        $this->db->where('fisher_id', $fisher_id);
        $query = $this->db->get('fisher_profile');
        return $query->row_array()['fisher_number'];
    }

    /**
     * Get the last registration number based on the year.
     */
    public function getLastRegNum($year)
    {
        $this->db->select('reg_num');
        $this->db->like('reg_num', "BOR-VE-$year-", 'after');
        $this->db->order_by('reg_num', 'DESC');
        $query = $this->db->get('vessel', 1);
        return $query->row_array();
    }

    /**
     * Insert a new vessel profile.
     */
    public function insertVessel($data)
    {
        $this->db->insert('vessel', $data);
        return $this->db->insert_id();
    }

    /**
     * Log an activity in the audit log.
     */
    public function logAudit($user_id, $user, $activity, $description)
    {
        $sql = "CALL Auditlog(?, ?, ?, ?)";
        $params = [$user_id, $user, $activity, $description];
        return $this->db->query($sql, $params);
    }
}
