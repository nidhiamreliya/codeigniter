<?php
class User_profile extends MY_Controller
{
	public function __construct()
    {
        parent::__construct();
    }

    //Show user information to user
	public function index()
	{
		if($this->session->userdata('user_id') != null &&  $this->session->userdata('privilege'))
		{
			$user_data['user'] = $this->data_model->get_userdata($this->session->userdata('user_id'));
			$this->views('system_views/user_profile',$user_data);
		}
		else
		{
			redirect('login');
		}
	}

	//Show user's information to admin
	//@params int $user_id id of user to edit
	public function edit_user($user_id)
	{
		if($this->session->userdata('privilege') == 2 && $this->session->userdata('user_id') != '')
		{
			$user_data['user'] = $this->data_model->get_userdata($user_id);
			if($user_data['user'])
			{
				$this->views('system_views/user_profile',$user_data);
			}
			else
			{
				$this->session->set_flashdata('error_msg', 'Sorry this user not exist.');
				redirect('manage_user');
			}	
		}
		else
		{
			redirect('login');
		}
	}

	//Validate user data and upadte information
	public function update_profile()
	{
		$this->form_validation->set_rules('first_name', 'First name', 'trim|required|alpha|xss_clean');
		$this->form_validation->set_rules('last_name', 'Last name', 'trim|required|alpha|xss_clean');
		
		if($this->session->userdata('privilege') == 2)
		{
			$this->form_validation->set_rules('user_name', 'User name', 'trim|required|xss_clean');
			$this->form_validation->set_rules('email_id', 'email id', 'trim|required|valid_email|xss_clean');
		}
		if($this->input->post('password') != '')
		{
			$this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[6]');
			$this->form_validation->set_rules('confirm_password', 'confirm Password', 'trim|required|matches[password]|xss_clean');
		}
		$this->form_validation->set_rules('address_line1', 'Address', 'required');
		$this->form_validation->set_rules('address_line2', 'Address', '');
		$this->form_validation->set_rules('city', 'City', 'required');
		$this->form_validation->set_rules('zip_code', 'Zip code', 'required|exact_length[6]|numeric');
		$this->form_validation->set_rules('state', 'State', 'required');
		$this->form_validation->set_rules('country', 'Country', 'required');

		if ($this->form_validation->run() == FALSE)
		{
			if($this->session->userdata('privilege') == 2)
			{
				$user_id = $this->input->post('edit_user_id');
				$this->edit_user($user_id);
			}
			else if($this->session->userdata('privilege') == 1)
			{
				$this->index();
			}
		}
		else 
		{
			$user_id = $this->input->post('edit_user_id');
			if($this->session->userdata('privilege') == 2)
			{
				$user_id = $this->input->post('edit_user_id');
				$result = $this->data_model->check_Duplicate($user_id, $this->input->post('user_name'), $this->input->post('email_id'));
				if($result)
				{
					if($result['user_name'] == $this->input->post('user_name'))
					{
						$this->session->set_flashdata('exist_username', 'This user name already exist.');
					}
					else
					{
						$this->session->set_flashdata('exist_emailid', 'This email_id already exist.');
					}
						redirect('user_profile/edit_user/' . $user_id);
				}
			}
			$data = array(
						'first_name' => $this->input->post('first_name'),
						'last_name' =>  $this->input->post('last_name'),
						'address_line1' => $this->input->post('address_line1'),
						'address_line2' => $this->input->post('address_line2'),
						'city' => $this->input->post('city'),
						'zip_code' => $this->input->post('zip_code'),
						'state' => $this->input->post('state'),
						'country' => $this->input->post('country')
					);
			if($this->input->post('password') != '')
			{
				$password = create_password($this->input->post('password'));
				$data['password'] = $password;
			}
			if($this->session->userdata('privilege') == 2)
			{
				$data['user_name'] = $this->input->post('user_name');
				$data['email_id'] = $this->input->post('email_id');
			}
			$result = $this->data_model->update_userdata($user_id, $data);
			if($result)
			{
				$this->session->set_flashdata('successful', 'Your data updated successfully.');
				if($this->session->userdata('privilege') == 2)
				{
					redirect('user_profile/edit_user/' . $user_id);
				}
				else
				{
					redirect('user_profile/index');
				}
			}
		}
	}

	//Upadate user's profile picture
	public function update_profile_pic()
	{
		$user_id = $this->input->post('edit_user_id');
		if($this->session->userdata('user_id'))
		{
			$values = $this->config->config;
  			$values['file_name'] = $user_id;
  			$this->load->library('upload', $values);
  			
 			if ( ! $this->upload->do_upload('profile_pic'))
  			{
    			$error = array('error' => $this->upload->display_errors());
    			$this->session->set_flashdata('error', $error);
				if($this->session->userdata('privilege') == 2)
				{
					$user_id = $this->input->post('edit_user_id');
					redirect('user_profile/edit_user/' . $user_id);
				}
				else if($this->session->userdata('privilege') == 1)
				{	
					redirect('user_profile');
				}
 			}
 			else
       		{   
       			$upload_data = $this->upload->data(); 
				$file_name = $upload_data['file_name'];
				$result = $this->data_model->user_pic($user_id, $file_name);
				image_thumb( 'assets/profile_pics/' . $file_name);
				
				$this->session->set_flashdata('success_msg', "Your profile picture updated successfully.");
    			
				if($this->session->userdata('privilege') == 2)
				{
					$user_id = $this->input->post('edit_user_id');
					redirect('user_profile/edit_user/' . $user_id);
				}
				else if($this->session->userdata('privilege') == 1)
				{	
					redirect('user_profile');
				}
       		}
     	}
     	else
     	{
     		redirect('log_out');
       	}   
    }
}
?>