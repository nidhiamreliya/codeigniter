<?php
class registration extends CI_Controller 
{
	public function __construct()
    {
        parent::__construct();
        $this->load->helper(array('url','form'));
        $this->load->model('manage_data', '', TRUE);
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
		$this->form_validation->set_rules('first_name', 'First name', 'required|alpha');
		$this->form_validation->set_rules('last_name', 'Last name', 'required|alpha');
		$this->form_validation->set_rules('user_name', 'User name', 'required|is_unique[user_data.user_name]');
		$this->form_validation->set_rules('email_id', 'email id', 'required|valid_email|is_unique[user_data.email_id]');
		$this->form_validation->set_rules('password', 'Password', 'required|min_length[6]');
		$this->form_validation->set_rules('confirm_password', 'confirm Password', 'required|matches[password]');
		$this->form_validation->set_rules('address_line1', 'Address', 'required');
		$this->form_validation->set_rules('address_line2', 'Address', '');
		$this->form_validation->set_rules('city', 'City', 'required');
		$this->form_validation->set_rules('zip_code', 'Zip code', 'required|exact_length[6]|numeric');
		$this->form_validation->set_rules('state', 'State', 'required');
		$this->form_validation->set_rules('country', 'Country', 'required');
		
		if ($this->form_validation->run() == FALSE)
		{
			$this->index();
		}
		else
		{
			$result = $this->manage_data->insert_data();
			if($result != null)
			{
				$user_data = array('user_id' => $result,'privilege' => 1);
				$this->session->set_userdata($user_data);
				redirect('user_profile');
			}
		}
	}
}
?>
