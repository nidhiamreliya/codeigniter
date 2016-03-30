<?php
class User_profile extends CI_Controller 
{
	public function __construct()
    {
        parent::__construct();
        $this->load->helper(array('url','form'));
    }
	public function index()
	{
		$this->load->view('includes/header');
		$this->load->view('system_views/user_profile');
		$this->load->view('includes/footer');
	}
}
?>