<?php
class Manage_data extends CI_Model 
{
    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
        $this->load->helper('url');
    }
	public function insert_data()
	{
		$data = array(
			'privilege' => 2,
			'first_name' => $this->input->post('first_name'),
			'last_name' =>  $this->input->post('last_name'),
			'user_name' => $this->input->post('user_name'),
			'email_id' => $this->input->post('email_id'),
			'password' => $this->input->post('password'),
			'address_line1' => $this->input->post('address_line1'),
			'address_line2' => $this->input->post('address_line2'),
			'city' => $this->input->post('city'),
			'zip_code' => $this->input->post('zip_code'),
			'state' => $this->input->post('state'),
			'country' => $this->input->post('country')
		);
		return $this->db->insert('user_data', $data);
	}
	public function check_user()
	{
		$user_name = $this->input->post('user_name');
		$password = $this->input->post('password');
		
	} 
}
?>