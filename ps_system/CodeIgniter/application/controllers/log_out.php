<?php
class Log_out extends CI_Controller 
{
	public function __construct()
    {
        parent::__construct();
    }

    //Unset all sessions
	public function index()
	{
		$this->session->unset_userdata('user_id');
		$this->session->unset_userdata('privilege');
		redirect('login');
	}
}
?>