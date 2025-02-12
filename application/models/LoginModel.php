<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class LoginModel extends CI_Model {

    // Validate user credentials
    public function validate_user($username) {
        $this->db->select('*');
        $this->db->from('user_cred');
        $this->db->where('username', $username);
        $query = $this->db->get();

        return $query->row_array(); // Returns user credentials or null
    }

    // Fetch user details by user_id
    public function get_user_details($user_id) {
        $this->db->select('*');
        $this->db->from('user');
        $this->db->where('user_id', $user_id);
        $query = $this->db->get();

        return $query->row_array(); // Returns user details or null
    }

    // Update user status
    public function update_status($user_id, $status) {
        $this->db->set('status', $status);
        $this->db->where('user_id', $user_id);
        return $this->db->update('user'); // Returns true on success
    }

    // Log activity in the audit log
    public function log_activity($user_id, $user_name, $activity, $description) {
        $sql = "CALL Auditlog(?, ?, ?, ?)";
        $this->db->query($sql, [$user_id, $user_name, $activity, $description]);
    }
}
