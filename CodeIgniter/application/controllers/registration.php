<?php
class registration extends MY_Controller
{
	public function __construct()
    {
        parent::__construct();
    }

    //Display registration form
	public function index()
	{
		$this->views('system_views/registration', null);
	}

	//Validate user data and insert data into database
	public function validate_user()
	{
		if ($this->form_validation->run('registeration') == FALSE )
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
			$result = $this->user_model->insert_data($data);
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
