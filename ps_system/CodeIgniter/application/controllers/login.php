<?php
class Login extends CI_Controller 
{
	public function __construct()
    {
        parent::__construct();
        $this->load->helper(array('url','form'));
        $this->load->model('data_model', '', TRUE);
        $this->load->view('includes/header');
        $this->load->view('includes/footer');
    }
	public function index()
	{
		$this->load->view('system_views/login');
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
			$user = $this->data_model->user_login($this->input->post('user_name'), $this->input->post('password'));
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
				$this->load->view('system_views/login', $message);
			}
		}
	}
}
?>
