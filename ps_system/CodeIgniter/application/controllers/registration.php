<?php
class registration extends CI_Controller 
{
	public function __construct()
    {
        parent::__construct();
        $this->load->helper(array('url','form'));
       
    }
	public function index()
	{
		$this->load->view('includes/header');
		$this->load->view('system_views/registration');
		$this->load->view('includes/footer');
	}
	public function validate_user()
	{
		$this->load->library('form_validation');
		$this->form_validation->set_rules('first_name', 'First name', 'required');
		$this->form_validation->set_rules('last_name', 'Last name', 'required');
		$this->form_validation->set_rules('user_name', 'User name', 'required');
		$this->form_validation->set_rules('email_id', 'email id', 'required|valid_email');
		$this->form_validation->set_rules('password', 'Password', 'required|min_length[6]');
		$this->form_validation->set_rules('confirm_password', 'confirm Password', 'required|matches[password]');
		$this->form_validation->set_rules('address_line1', 'Address', 'required');
		$this->form_validation->set_rules('address_line2', 'Address', '');
		$this->form_validation->set_rules('city', 'City', 'required');
		$this->form_validation->set_rules('zip_code', 'Zip code', 'required|min_length[6]|max_length[6]');
		$this->form_validation->set_rules('state', 'State', 'required');
		$this->form_validation->set_rules('country', 'Country', 'required');
		
		if ($this->form_validation->run() == FALSE)
		{
			$this->index();
		}
		else
		{
			$this->load->model('manage_data', '', TRUE);
			$this->manage_data->insert_data();
			$this->load->view('includes/header');
			$this->load->view('system_views/login');
			$this->load->view('includes/footer');
		}
	}
	
}
?>
