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
		$data['user_data'] = $this->manage_data->get_allusers();
		$this->load->view('includes/header');
		$this->load->view('system_views/manage_user', $data);
		$this->load->view('includes/footer');
	}
	public function delete_user($remove_id)
	{
		$result = $this->manage_data->delete_user($remove_id);
		$this->session->set_flashdata('success_msg', 'One row has been deleted.');
		redirect('manage_user');

	}
}