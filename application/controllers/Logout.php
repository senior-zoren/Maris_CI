<?php
defined("BASEPATH") OR exit("No direct script access allowed");

class Logout extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model("LogoutModel");
        $this->load->helper('url');
    }

    public function logout()
    {
        // Check if user is logged in
        if ($this->session->userdata("user_id")) {
            $user_id = $this->session->userdata("user_id");

            // Fetch user full name
            $user_name = $this->LogoutModel->get_user_full_name($user_id);
            if (!$user_name) {
                show_error("User not found.", 404);
            }

            // Log the logout activity
            $activity = "Logout";
            $description = "User " . $user_id . " logged out";
            if (!$this->LogoutModel->log_audit_activity($user_id, $user_name, $activity, $description)) {
                log_message("error", "Failed to log audit activity for user_id: $user_id");
            }

            // Update the user's status to offline
            if (!$this->LogoutModel->update_user_status($user_id)) {
                log_message("error", "Failed to update user status for user_id: $user_id");
            }

            // Destroy the session
            $this->session->sess_destroy();
        }

        // Redirect to the login page
        redirect(base_url('/'));
    }
}
