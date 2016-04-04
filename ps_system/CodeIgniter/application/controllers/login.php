<?php
class Login extends CI_Controller 
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
		$this->load->view('system_views/login');
		$this->load->view('includes/footer');
	}
	public function check_data()
	{
		$this->load->library('form_validation');
		$this->form_validation->set_rules('user_name', 'User name', 'required');
		$this->form_validation->set_rules('password', 'Password', 'required|min_length[6]');
		
		if ($this->form_validation->run() == FALSE)
		{
			$this->index();
		}
		else
		{
			$user = $this->manage_data->user_login();
			if($user)
			{
				$user_data = array('user_id' => $user['user_id'],'privilege' => $user['privilege']);
				$this->session->set_userdata($user_data);

				if($this->session->userdata('privilege') == 1)
				{
					redirect('user_profile');
				}
				else if($this->session->userdata('privilege') == 2)
				{
					redirect('manage_user');
				}
			}
			else 
			{
				$message['err_message'] = 'Invalid user name or password';
				$this->load->view('includes/header');
				$this->load->view('system_views/login', $message);
				$this->load->view('includes/footer');
			}
		}
	}
}
?>
