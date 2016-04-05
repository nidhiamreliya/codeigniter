<?php
class User_profile extends CI_Controller 
{
	public function __construct()
    {
        parent::__construct();
        $this->load->helper(array('url','form', 'function_helper'));
        $this->load->library('session');
        $this->load->model('data_model', '', TRUE);
        $this->load->view('includes/header');
        $this->load->view('includes/footer');
    }
	public function index()
	{
		if($this->session->userdata('user_id') != null &&  $this->session->userdata('privilege'))
		{
			$user_data['user'] = $this->data_model->get_userdata($this->session->userdata('user_id'));
			$this->load->view('system_views/user_profile',$user_data);
		}
		else
		{
			redirect('login');
		}
	}
	public function edit_user($user_id)
	{
		if($this->session->userdata('privilege') == 2 && $this->session->userdata('user_id') != '')
		{
			$user_data['user'] = $this->data_model->get_userdata($user_id);
			$this->load->view('system_views/user_profile',$user_data);
		}
		else
		{
			redirect('login');
		}
	}
	public function update_profile()
	{
		$this->load->library('form_validation');
		$this->form_validation->set_rules('first_name', 'First name', 'required|alpha');
		$this->form_validation->set_rules('last_name', 'Last name', 'required|alpha');
		
		if($this->session->userdata('privilege') == 2)
		{
			$this->form_validation->set_rules('user_name', 'User name', 'required');
			$this->form_validation->set_rules('email_id', 'email id', 'required|valid_email');
		}
		if($this->input->post('password') != '')
		{
			$this->form_validation->set_rules('password', 'Password', 'required|min_length[6]');
			$this->form_validation->set_rules('confirm_password', 'confirm Password', 'required|matches[password]');
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
	public function update_profile_pic()
	{
		$user_id = $this->input->post('edit_user_id');
		if($this->session->userdata('user_id'))
		{
  			$config['upload_path'] = "/var/www/ps_system/CodeIgniter/assets/profile_pics/";
  			$config['allowed_types'] = 'gif|jpg|jpeg|png';
  			$config['max_size'] = '1000';
			$config['max_width']  = '1024';
  			$config['max_height']  = '768';
  			$config['overwrite'] = false;
  			$this->load->library('upload', $config);
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
				$this->session->set_flashdata('success_msg', "Your profile picture updated successfully.");
    			$result = $this->manage_data->user_pic($user_id, $file_name);
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