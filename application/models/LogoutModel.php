<?php
defined("BASEPATH") OR exit("No direct script access allowed");

class LogoutModel extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    // Fetch user full name by user_id
    public function get_user_full_name($user_id)
    {
        $this->db->select("CONCAT(f_name, ' ', l_name) AS full_name");
        $this->db->from("user");
        $this->db->where("user_id", $user_id);
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->row()->full_name;
        }
        return false;
    }

    // Log the audit activity
    public function log_audit_activity($user_id, $user_name, $activity, $description)
    {
        $sql = "CALL Auditlog(?, ?, ?, ?)";
        return $this->db->query($sql, [$user_id, $user_name, $activity, $description]);
    }

    // Update user status to offline
    public function update_user_status($user_id)
    {
        $this->db->set("status", "offline");
        $this->db->where("user_id", $user_id);
        return $this->db->update("user");
    }
}
