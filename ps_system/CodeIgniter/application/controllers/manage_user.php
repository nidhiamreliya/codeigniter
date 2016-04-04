<?php
class Manage_user extends CI_Controller 
{
	public function __construct()
    {
        parent::__construct();
        $this->load->helper(array('url','form'));
        $this->load->model('manage_data', '', TRUE);
    }
	public function index()
	{
		if($this->session->userdata('user_id') != null &&  $this->session->userdata('privilege') == 2)
		{
			$data['user_data'] = $this->manage_data->get_allusers();
			$this->load->view('includes/header');
			$this->load->view('system_views/manage_user', $data);
			$this->load->view('includes/footer');
		}
		else
		{
			redirect('log_out');
		}
	}

	//To delete user.
	public function delete_user($remove_id)
	{
		if($this->session->userdata('user_id') != null &&  $this->session->userdata('privilege') == 2)
		{
			$result = $this->manage_data->delete_user($remove_id);
			if($result)
			{
				$this->session->set_flashdata('success_msg', 'One row has been deleted.');
				redirect('manage_user');
			}
			else
			{
				$this->session->set_flashdata('error_msg', 'Sorry u can not delete this user.');
				redirect('manage_user');
			}
		}
		else
		{
			redirect('log_out');
		}

	}
}