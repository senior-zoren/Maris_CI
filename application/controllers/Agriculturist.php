<?php
defined('BASEPATH') or exit("No direct script access allowed");

class Agriculturist extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();
    $this->load->model("user/UserProfileModel");
    $this->load->model("user/ManualModel");
    $this->load->model("user/fisher/FisherDashModel");
    $this->load->model("user/fisher/AddFisherModel");
    $this->load->model("user/fisher/AddVesselModel");
    $this->load->model("user/fisher/FisherInfoModel");
    $this->load->model("user/fisher/ViewFisherModel");
    $this->load->model("user/fisher/FisherCatchReport");
    $this->load->model("user/fisher/VesselModel");
    $this->load->model("user/fisher/SubmitReportModel");
    $this->load->library('session');
    $this->load->helper('url');
  }

  public function user_profile()
  {
      // Check if user is logged in
      if (!$this->session->userdata("user_id")) {
          redirect('home');
      }
      
      $user_id = $this->session->userdata("user_id");
  
      // Fetch user details
      $userDetails = $this->UserProfileModel->getUserDetails($user_id);
      if (!$userDetails) {
          show_error("User profile not found.", 404);
      }
  
      // Fetch unread notifications
      $unreadNotifications = $this->UserProfileModel->countUnreadNotifications();
  
      // Fetch address
      $address = $this->UserProfileModel->get_user_address($user_id);
  
      // Fetch logs with pagination
      $results_per_page = 10;
      $total_logs = $this->UserProfileModel->count_user_logs($user_id);
      $total_pages = ceil($total_logs / $results_per_page);
  
      $page = max(1, (int) $this->input->get('page', true));
      $offset = ($page - 1) * $results_per_page;
  
      $logs = $this->UserProfileModel->get_user_logs($user_id, $results_per_page, $offset);
  
      // Pass data to the view
      $data = [
          "userDetails" => $userDetails,
          "unreadNotifications" => $unreadNotifications,
          "address" => $address,
          "logs" => $logs,
          "current_page" => $page,
          "total_pages" => $total_pages,
      ];
  
      $this->load->view("user/userprofile", $data);
  }
  

  public function fisherDash()
  {
    if (!$this->session->userdata('user_id')) {
      redirect('home');
      return;
    }

    $user_id = $this->session->userdata('user_id');

    $data = [
      'userDetails' => $this->FisherDashModel->getUserDetails($user_id),
      'catchLimit' => $this->FisherDashModel->getCatchLimit(),
      'unreadNotifications' => $this->FisherDashModel->countUnreadNotifications(),
      'totalCatch' => $this->FisherDashModel->getTotalCatchQuantity(date('Y')),
      'fishermanCount' => $this->FisherDashModel->countFishermanProfiles(),
      'marineSpeciesCount' => $this->FisherDashModel->countMarineSpecies(),
      'vesselCount' => $this->FisherDashModel->countVessels(),
      'weeklyTotals' => $this->FisherDashModel->getWeeklyTotals(date('Y'), date('m'), 'fisher_gen_catch_report', 'gen_quantity'),
      'weeklySpeciesData' => $this->FisherDashModel->getWeeklySpeciesData(date('Y'), date('m'))
    ];

    $this->load->view('user/fisher/fisherDashPage', $data);
  }

  public function user_manual()
  {
    if (!$this->session->userdata('user_id')) {
      redirect('home');
      return;
    }

    $user_id = $this->session->userdata('user_id');

    // Handle form submission
    if ($this->input->server('REQUEST_METHOD') === 'POST') {
      $this->processFisherForm($user_id);
    }

    // Fetch data for the form
    $data = [
      'userDetails' => $this->ManualModel->getUserDetails($user_id),
      'unreadNotifications' => $this->ManualModel->countUnreadNotifications(),
    ];

    $this->load->view('user/manual', $data);
  }

  public function fisher_registry()
  {
    if (!$this->session->userdata('user_id')) {
      redirect('home');
      return;
    }

    $user_id = $this->session->userdata('user_id');

    // Handle form submission
    if ($this->input->server('REQUEST_METHOD') === 'POST') {
      $this->processFisherForm($user_id);
    }

    // Fetch data for the form
    $data = [
      'userDetails' => $this->AddFisherModel->getUserDetails($user_id),
      'unreadNotifications' => $this->AddFisherModel->countUnreadNotifications(),
      'ports' => $this->AddFisherModel->getPorts()
    ];

    $this->load->view('user/fisher/addfisher', $data);
  }

  private function processFisherForm($user_id)
  {
    $fisherNumber = $this->generateFisherNumber();
    $firstName = $this->input->post('f_name');
    $lastName = $this->input->post('l_name');
    $gender = $this->input->post('gender');
    $portId = $this->input->post('port_id');
    $barangayId = $this->input->post('brgy_id');

    // Prepare fisher profile data
    $profileData = [
      'fisher_number' => $fisherNumber,
      'f_name' => $firstName,
      'l_name' => $lastName,
      'gender' => $gender,
      'created_by' => $user_id,
    ];

    // Insert profile
    $fisherId = $this->AddFisherModel->insertFisherProfile($profileData);

    if ($fisherId) {
      // Prepare and insert address data
      $addressData = [
        'fisher_id' => $fisherId,
        'port_id' => $portId,
        'brgy_id' => $barangayId
      ];
      $this->AddFisherModel->insertFisherAddress($addressData);

      // Log activity
      $this->AddFisherModel->logActivity(
        $user_id,
        $this->session->userdata('user_name'),
        'Add Fisher Profile',
        "Added a new fisher: $firstName $lastName"
      );

      $this->session->set_flashdata('success', 'Fisher profile added successfully.');
      redirect('agriculturist/addfisher');
    } else {
      $this->session->set_flashdata('error', 'Failed to add fisher profile. Please try again.');
      redirect('agriculturist/addfisher');
    }
  }

  private function generateFisherNumber()
  {
    $lastNumber = $this->AddFisherModel->getLastFisherNumber();
    $year = date('y');

    if ($lastNumber) {
      $lastIncrement = (int) substr($lastNumber, -4);
      $newIncrement = str_pad($lastIncrement + 1, 4, '0', STR_PAD_LEFT);
    } else {
      $newIncrement = '0001';
    }

    return "BOR-FM$year-$newIncrement";
  }

  public function getBarangaysByPort($port_id)
  {
    $barangays = $this->AddFisherModel->getBarangaysByPort($port_id);
    echo json_encode($barangays);
  }

  public function submitFisherProfile()
  {
    if ($this->input->server('REQUEST_METHOD') === 'POST') {
      $this->processFisherForm($this->session->userdata('user_id'));
    }
  }

  public function vessel_registry()
  {
    if (!$this->session->userdata('user_id')) {
      redirect('home');
      return;
    }

    $user_id = $this->session->userdata('user_id');

    $data = [
      'userDetails' => $this->AddVesselModel->getUserDetails($user_id),
      'unreadNotifications' => $this->AddVesselModel->countUnreadNotifications(),
      'fishers' => $this->AddVesselModel->getFishers(),
      'equipments' => $this->AddVesselModel->getEquipment()
    ];

    $this->load->view('user/fisher/addvessel', $data);
  }

  public function submitVesselProfile()
  {
    if ($this->input->server('REQUEST_METHOD') === 'POST') {
      $fisher_id = $this->input->post('fisher');
      $vesselData = [
        'fisher_id' => $fisher_id,
        'reg_num' => $this->generateRegNum($fisher_id),
        'year_built' => $this->input->post('yearBuilt'),
        'equipments' => implode(', ', $this->input->post('equipment')),
        'material_used' => $this->input->post('materialUsed'),
        'gross_tonnage' => $this->input->post('grossTonnage'),
        'net_tonnage' => $this->input->post('netTonnage'),
        'engine_make' => $this->input->post('engineMake'),
        'vessel_name' => $this->input->post('vesselName'),
        'image' => file_get_contents($_FILES['vesselImage']['tmp_name']),
        'status' => 'Active',
        'date_registered' => date('Y-m-d H:i:s')
      ];

      $inserted = $this->AddVesselModel->insertVessel($vesselData);
      if ($inserted) {
        $user = $this->AddVesselModel->getUserDetails($this->session->userdata('user_id'));
        $this->AddVesselModel->logAudit(
          $this->session->userdata('user_id'),
          $user['f_name'] . ' ' . $user['l_name'],
          'Fishing Vessel Registry',
          'New fishing vessel registered: ' . $vesselData['reg_num']
        );

        $this->session->set_flashdata('success', 'New vessel profile added successfully!');
        redirect('agriculturist/vessel_registry');
      } else {
        $this->session->set_flashdata('error', 'Error adding vessel profile.');
        redirect('agriculturist/vessel_registry');
      }
    }
  }

  private function generateRegNum()
  {
    $year = date('y');
    $lastReg = $this->AddVesselModel->getLastRegNum($year);
    if ($lastReg) {
      preg_match('/BOR-VE-' . $year . '-(\d+)/', $lastReg['reg_num'], $matches);
      $sequence = isset($matches[1]) ? (int) $matches[1] + 1 : 1;
    } else {
      $sequence = 1;
    }

    return sprintf("BOR-VE-%s-%03d", $year, $sequence);
  }

  public function fisher_info_hub()
  {
    if (!$this->session->userdata('user_id')) {
      redirect('home');
      return;
    }

    $user_id = $this->session->userdata('user_id');

    $data = [
      'userDetails' => $this->FisherInfoModel->getUserDetails($user_id),
      'unreadNotifications' => $this->FisherInfoModel->countUnreadNotifications(),
      'fisherData' => $this->FisherInfoModel->getFishermanData(),
    ];
    $this->load->view("user/fisher/fisherlist", $data);
  }
  

  public function submit_catch_report()
  {
    if (!$this->session->userdata('user_id')) {
      redirect('home');
      return;
    }

    $user_id = $this->session->userdata('user_id');

    // Fetch necessary data
    $userDetails = $this->SubmitReportModel->getUserDetails($user_id);
    $unreadNotifications = $this->SubmitReportModel->countUnreadNotifications();

    // Pass data to the view
    $data = [
      'userDetails' => $userDetails,
      'unreadNotifications' => $unreadNotifications,
    ];

    $this->load->view("user/fisher/submitreport", $data);
  }


  public function view_profile_data($fisher_id = null)
  {
    // Check if user is logged in
    if (!$this->session->userdata('user_id')) {
      redirect('home');
      return;
    }

    // Get user ID from session
    $user_id = $this->session->userdata('user_id');

    // Get user details and unread notifications count
    $userDetails = $this->ViewFisherModel->getUserDetails($user_id);
    $unreadNotifications = $this->ViewFisherModel->countUnreadNotifications();

    // Check if fisher_id is provided, either through URL segment or GET parameter
    if ($fisher_id === null) {
      $fisher_id = $this->input->get('fisher_id'); // Get fisher_id from the query string
    }

    if ($fisher_id) {
      // Fetch fisher profile and data if available
      $fisherDetails = $this->ViewFisherModel->getFisherDetails($fisher_id);
      $fisherAddress = $this->ViewFisherModel->getFisherAddress($fisher_id);
      $vesselImage = $this->ViewFisherModel->getVesselImageBase64($fisher_id);
      $fisherCatches = $this->ViewFisherModel->getFisherCatches($fisher_id);
      $monthly_catch_data = $this->ViewFisherModel->getMonthlyCatchData($fisher_id);
      $species_catch_data = $this->ViewFisherModel->getSpeciesCatchData($fisher_id);

      // Prepare data array for view
      $data = [
        'userDetails' => $userDetails,
        'unreadNotifications' => $unreadNotifications,
        'fisherDetails' => $fisherDetails,
        'fisherAddress' => $fisherAddress,
        'vesselImage' => $vesselImage,
        'fisherCatches' => $fisherCatches,
        'monthly_catch_data' => $monthly_catch_data,
        'species_data' => $species_catch_data['species_data'],
        'species_chart_data' => $species_catch_data['species_chart_data'],
        'fisher_id' => $fisher_id
      ];

      // Load the view with the data
      $this->load->view("user/fisher/viewfisher", $data);
    }
  }

  public function fisher_catch_report()
  {
    if (!$this->session->userdata('user_id')) {
      redirect('home');
      return;
    }

    $user_id = $this->session->userdata('user_id');
    $currentYear = date('Y');

    // Fetch necessary data
    $userDetails = $this->FisherCatchReport->getUserDetails($user_id);
    $unreadNotifications = $this->FisherCatchReport->countUnreadNotifications();
    $fisherCatches = $this->FisherCatchReport->getFisherCatches();
    $monthly_catch_data = $this->FisherCatchReport->getMonthlyCatchData($currentYear);
    $species_catch_data = $this->FisherCatchReport->getSpeciesCatchData($currentYear);

    // Pass data to the view
    $data = [
      'userDetails' => $userDetails,
      'unreadNotifications' => $unreadNotifications,
      'fisherCatches' => $fisherCatches,
      'monthly_catch_data' => $monthly_catch_data,
      'species_data' => $species_catch_data['species_data'],
      'species_chart_data' => $species_catch_data['species_chart_data'],
    ];

    $this->load->view('user/fisher/fishercatchreport', $data);
  }

  public function vessel()
  {
    if (!$this->session->userdata('user_id')) {
      redirect('home');
      return;
    }

    $user_id = $this->session->userdata('user_id');

    // Fetch necessary data
    $userDetails = $this->VesselModel->getUserDetails($user_id);
    $unreadNotifications = $this->VesselModel->countUnreadNotifications();
    $vesselData = $this->VesselModel->getVesselData();

    // Pass data to the view
    $data = [
      'userDetails' => $userDetails,
      'unreadNotifications' => $unreadNotifications,
      'vesselData' => $vesselData
    ];
    $this->load->view('user/fisher/vessel', $data);
  }

  public function marine_compendium()
  {
    echo "this is marine_compendium";
  }

  public function notifications()
  {
    echo "this is notifications";
  }

  public function farmerDash()
  {
    echo "this is farmer dash";
  }
}
