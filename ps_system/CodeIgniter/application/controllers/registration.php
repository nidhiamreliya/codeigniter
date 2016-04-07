<?php
class registration extends CI_Controller 
{
	public function __construct()
    {
        parent::__construct();
    }

    //Display registration form
	public function index()
	{
		$this->load->view('includes/header');
		$this->load->view('system_views/registration');
		$this->load->view('includes/footer');
	}

	//Validate user data and insert data into database
	public function validate_user()
	{
		$this->form_validation->set_rules('first_name', 'First name', 'required|alpha|xss_clean');
		$this->form_validation->set_rules('last_name', 'Last name', 'required|alpha|xss_clean');
		$this->form_validation->set_rules('user_name', 'User name', 'required|is_unique[user_data.user_name]|xss_clean');
		$this->form_validation->set_rules('email_id', 'email id', 'required|valid_email|is_unique[user_data.email_id]|xss_clean');
		$this->form_validation->set_rules('password', 'Password', 'required|min_length[6]|xss_clean');
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
			$password = create_password($this->input->post('password'));
			$data = array(
					'privilege' => 1,
					'first_name' => $this->input->post('first_name'),
					'last_name' =>  $this->input->post('last_name'),
					'user_name' => $this->input->post('user_name'),
					'email_id' => $this->input->post('email_id'),
					'password' => $password,
					'address_line1' => $this->input->post('address_line1'),
					'address_line2' => $this->input->post('address_line2'),
					'city' => $this->input->post('city'),
					'zip_code' => $this->input->post('zip_code'),
					'state' => $this->input->post('state'),
					'country' => $this->input->post('country'),
					'profile_pic' => "default_profile.jpg"
				);
			$result = $this->data_model->insert_data($data);
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
