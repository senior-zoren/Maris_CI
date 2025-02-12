<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Home extends CI_Controller
{

	// Constructor to load the necessary model
	public function __construct()
	{
		parent::__construct();
		// Load the DashboardModel for fetching data
		$this->load->model('DashboardModel');
		$this->load->model('ViewFisherModel');
		$this->load->model('ViewFarmerModel');
    $this->load->library('session');
    $this->load->helper('url');
	}

	// Default index page method
	public function index()
	{
		$this->load->view('home');
	}

	public function aboutus()
	{
		$this->load->view('aboutus');
	}

	public function contactus()
	{
		$this->load->view('contactus');
	}

	public function faq()
	{
		$this->load->view('faq');
	}

	public function feedback()
	{
		$this->load->view('feedback');
	}

	public function manual()
	{
		$this->load->view('manual');
	}

	// Dashboard method to display the dashboard view with data
	public function dashboard()
	{
		// Fetch counts and profiles using the model
		$counts = $this->DashboardModel->getCounts();
		$profiles = $this->DashboardModel->getProfiles();

		// Prepare the data array to pass to the view
		$data = [
			'counts' => $counts,
			'profiles' => $profiles
		];

		// Load the dashboard view with the data
		$this->load->view('dashboard', $data);
	}

	public function viewFisher()
	{
		$fisher_id = $this->input->get('fisher_id');

		// Fetch fisher data (update this based on your model)
		$fisher_data = $this->ViewFisherModel->getFisherDetails($fisher_id);
		$catches = $this->ViewFisherModel->getFisherCatches($fisher_id);
		$fisher_address = $this->ViewFisherModel->getFisherAddress($fisher_id);
		$monthly_catch_data = $this->ViewFisherModel->getMonthlyCatchData($fisher_id);
		$species_catch_data = $this->ViewFisherModel->getSpeciesCatchData($fisher_id);


		// var_dump($id);
		// Prepare the address parts
		$addressParts = array_filter([
			$fisher_address['brgy_name'],
			$fisher_address['city'],
			$fisher_address['province'],
		]);


		// Prepare the data array to pass to the view
		$data = [
			'fisher_number' => $fisher_data['fisher_number'],
			'gender' => $fisher_data['gender'],
			'f_name' => $fisher_data['f_name'],
			'm_name' => $fisher_data['m_name'],
			'l_name' => $fisher_data['l_name'],
			'suffix' => $fisher_data['suffix'],
			'addressParts' => $addressParts,
			'age' => $fisher_data['age'],
			'cell_number' => $fisher_data['cell_number'],
			'catches' => $catches,
			'monthly_catch_data' => $monthly_catch_data,
			'species_data' => $species_catch_data['species_data'],
			'species_chart_data' => $species_catch_data['species_chart_data'],
		];

		// Load the fisher view and pass the data
		return $this->load->view('fisherView', $data);
	}

	public function viewFarmer()
	{
		$farmer_id = $this->input->get('farmer_id');

		// Fetch farmer data (update this based on your model)
		$farmer_data = $this->ViewFarmerModel->getFarmerDetails($farmer_id);
		$catches = $this->ViewFarmerModel->getFarmerCatches($farmer_id);
		$farmer_address = $this->ViewFarmerModel->getFarmerAddress($farmer_id);
		$monthly_catch_data = $this->ViewFarmerModel->getMonthlyCatchData($farmer_id);
		$species_catch_data = $this->ViewFarmerModel->getSpeciesCatchData($farmer_id);

		// Prepare the address parts
		$addressParts = array_filter([
			$farmer_address['brgy_name'],
			$farmer_address['city'],
			$farmer_address['province'],
		]);


		// Prepare the data array to pass to the view
		$data = [
			'farmer_number' => $farmer_data['farmer_number'],
			'gender' => $farmer_data['gender'],
			'f_name' => $farmer_data['f_name'],
			'm_name' => $farmer_data['m_name'],
			'l_name' => $farmer_data['l_name'],
			'suffix' => $farmer_data['suffix'],
			'addressParts' => $addressParts,
			'age' => $farmer_data['age'],
			'cell_number' => $farmer_data['cell_number'],
			'catches' => $catches,
			'monthly_catch_data' => $monthly_catch_data,
			'species_data' => $species_catch_data['species_data'],
			'species_chart_data' => $species_catch_data['species_chart_data'],
		];

		// Load the farmer view and pass the data
		$this->load->view('farmerView', $data);
	}
}
?>