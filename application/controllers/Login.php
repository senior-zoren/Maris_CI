<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Login extends CI_Controller
{

  public function __construct()
  {
    parent::__construct();
    $this->load->model('LoginModel');
    $this->load->library('session');
    $this->load->helper('url');
  }

  public function login()
  {
    $data['error'] = '';
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      $username = trim($this->input->post('username'));
      $password = trim($this->input->post('password'));

      // Validate user credentials
      $user_cred = $this->LoginModel->validate_user($username);

      if ($user_cred) {
        $stored_password = $user_cred['password'];
        $user_id = $user_cred['user_id'];

        // Check if password is hashed
        $is_hashed = strpos($stored_password, '$2y$') === 0;
        $password_is_valid = $is_hashed ? password_verify($password, $stored_password) : ($password === $stored_password);

        if ($password_is_valid) {
          // Update user status
          $this->LoginModel->update_status($user_id, 'online');

          // Fetch user details
          $user = $this->LoginModel->get_user_details($user_id);

          if ($user) {
            // Set session data
            $this->session->set_userdata([
              'user_id' => $user_id,
              'username' => $username,
              'user_type' => $user['user_type']
            ]);

            // Log activity
            $user_name = $user['f_name'] . ' ' . $user['l_name'];
            $activity = 'Login';
            $description = 'User ' . $user_id . ' logged in';
            $this->LoginModel->log_activity($user_id, $user_name, $activity, $description);

            // Redirect based on user type
            if ($user['user_type'] === 'admin') {
              redirect(base_url('admin/adminDashboard'));
            } elseif ($user['user_type'] === 'agriculturist') {
              redirect(base_url('agriculturist/fisher_dashboard'));
            } else {
              $data['error'] = 'Unknown user type.';
            }
          } else {
            $data['error'] = 'User details not found.';
          }
        } else {
          $data['error'] = 'Invalid username or password.';
        }
      } else {
        $data['error'] = 'Invalid username or password.';
      }
    }
  }
}
