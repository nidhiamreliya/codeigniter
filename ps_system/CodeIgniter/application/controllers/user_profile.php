<?php
class User_profile extends CI_Controller 
{
	public function __construct()
    {
        parent::__construct();
        $this->load->helper(array('url','form'));
        $this->load->library('session');
        $this->load->model('manage_data', '', TRUE);
    }
	public function index()
	{
		if($this->session->userdata('user_id') != null &&  $this->session->userdata('privilege') == 1)
		{
			$user_data['user'] = $this->manage_data->get_userdata($this->session->userdata('user_id'));
			$this->load->view('includes/header');
			$this->load->view('system_views/user_profile',$user_data);
			$this->load->view('includes/footer');
		}
		else
		{
			redirect('log_out');
		}
	}
	public function edit_user($user_id)
	{
		if($this->session->userdata('privilege') == 2 && $this->session->userdata('user_id') != '')
		{
			$user_data['user'] = $this->manage_data->get_userdata($user_id);
			$this->load->view('includes/header');
			$this->load->view('system_views/user_profile',$user_data);
			$this->load->view('includes/footer');
		}
		else
		{
			redirect('log_out');
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
			if($this->session->userdata('privilege') == 2)
			{
				$user_id = $this->input->post('edit_user_id');
				$result = $this->manage_data->check_Duplicate($user_id, $this->input->post('user_name'), $this->input->post('email_id'));
				if($result)
				{
					$this->session->set_flashdata('already_exist', 'This user name or email id already exist.');
					redirect('user_profile/edit_user/' . $user_id);
				}
				else
				{
					$result = $this->manage_data->update_userdata($user_id);
					if($result)
					{
						$this->session->set_flashdata('successful', 'Your data updated successfully.');
						redirect('user_profile/edit_user/' . $user_id);
					}
				}
			}
			else if($this->session->userdata('privilege') == 1)
			{
				$user_id = $this->session->userdata('user_id');
				$result = $this->manage_data->update_userdata($user_id);
				if($result)
				{
					$this->session->set_flashdata('successful', 'Your data updated successfully.');
					redirect('user_profile');
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