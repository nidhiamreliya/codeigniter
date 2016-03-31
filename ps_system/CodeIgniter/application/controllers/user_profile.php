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
		if($this->session->userdata('user_id'))
		{
			$user_data['user'] = $this->manage_data->get_userdata();
			$this->load->view('includes/header');
			$this->load->view('system_views/user_profile',$user_data);
			$this->load->view('includes/footer');
		}
		else
		{
			redirect('login');
		}
	}
	public function update_profile()
	{
		$this->load->library('form_validation');
		$this->form_validation->set_rules('first_name', 'First name', 'required');
		$this->form_validation->set_rules('last_name', 'Last name', 'required');
		
		if($this->session->userdata('privilege') == 2)
		{
			$this->form_validation->set_rules('user_name', 'User name', 'required|is_unique[user_data.user_name]');
			$this->form_validation->set_rules('email_id', 'email id', 'required|valid_email|is_unique[user_data.email_id]');
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
			$this->index();
		}
		else
		{
			$result = $this->manage_data->update_userdata();
			if($result == true)
			{
				$this->index();
			}
		}
	}
}
?>