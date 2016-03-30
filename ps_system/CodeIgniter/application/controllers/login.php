<?php
class Login extends CI_Controller 
{
	public function __construct()
    {
        parent::__construct();
        $this->load->helper(array('url','form'));
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
			$this->load->model('manage_data', '', TRUE);
			$user = $this->manage_data->check_user();
			print_r($user);
			echo $user['user_id'];
			echo $user['privilege'];
			/*$this->load->view('includes/header');
			$this->load->view('system_views/login');
			$this->load->view('includes/footer');*/
		}
	}
}
?>
