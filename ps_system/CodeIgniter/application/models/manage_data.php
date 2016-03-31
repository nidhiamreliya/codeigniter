<?php
class Manage_data extends CI_Model 
{
    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
        $this->load->helper('url');
        $this->load->library('session');
    }
	public function insert_data()
	{
		$data = array(
			'privilege' => 1,
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
		$result = $this->db->insert('user_data', $data);
		return $this->db->insert_id();
	}
	public function user_login()
	{
		$condition = "user_name =" . "'" . $this->input->post('user_name') . "' AND " . "password =" . "'" . $this->input->post('password') . "'";
		$this->db->select('user_id, privilege');
		$this->db->from('user_data');
		$this->db->where($condition);
		$this->db->limit(1);
		$query = $this->db->get();

		if ($query->num_rows() == 1) 
		{
			return $query->row_array();
		} 
		else 
		{
			return false;
		}
	}
	public function get_userdata()
	{
		$query = $this->db->get_where('user_data', array('user_id' => $this->session->userdata('user_id')));
		return $query->row_array();
	}
	public function update_userdata()
	{
		$data = array(
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
		$this->db->where('user_id', $this->session->userdata('user_id'));
		$this->db->update('user_data', $data);
	}
	public function get_allusers()
	{
		$condition = "privilege != 2";
		$this->db->select('user_id, first_name, last_name, user_name, email_id, address_line1, address_line2, city, zip_code, state, country');
		$this->db->from('user_data');
		$this->db->where($condition);
		$query = $this->db->get();
		if ($query->num_rows() >= 1) 
		{
			return $query->result();
		} 
		else 
		{
			return false;
		}
	} 
	public function delete_user($remove_id)
	{
		$this->db->delete('user_data', array('user_id' => $remove_id)); 
	}
}
?>