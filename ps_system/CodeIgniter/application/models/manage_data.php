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
	public function get_userdata($user_id)
	{
		$query = $this->db->get_where('user_data', array('user_id' => $user_id));
		return $query->row_array();
	}
	public function update_userdata($user_id)
	{
		if($this->session->userdata('privilege') == 2)
		{
			$data = array(
				'first_name' => $this->input->post('first_name'),
				'last_name' =>  $this->input->post('last_name'),
				'user_name' => $this->input->post('user_name'),
				'email_id' => $this->input->post('email_id'),
				'address_line1' => $this->input->post('address_line1'),
				'address_line2' => $this->input->post('address_line2'),
				'city' => $this->input->post('city'),
				'zip_code' => $this->input->post('zip_code'),
				'state' => $this->input->post('state'),
				'country' => $this->input->post('country')
			);
			if($this->input->post('password') != '')
			{
				$data['password'] = $this->input->post('password');
			}
		}
		else if($this->session->userdata('privilege') == 1)
		{
			$data = array(
				'first_name' => $this->input->post('first_name'),
				'last_name' =>  $this->input->post('last_name'),
				'address_line1' => $this->input->post('address_line1'),
				'address_line2' => $this->input->post('address_line2'),
				'city' => $this->input->post('city'),
				'zip_code' => $this->input->post('zip_code'),
				'state' => $this->input->post('state'),
				'country' => $this->input->post('country')
			);
			if($this->input->post('password') != '')
			{
				$data['password'] = $this->input->post('password');
			}
		}
		$this->db->where('user_id', $user_id);
		$this->db->update('user_data', $data);
		if ($this->db->trans_status() === true) 
		{
    		return true;
		} 
		else 
		{
   			return 	false;
    	}
	}
	 //for checking email existance
	public function check_Duplicate($user_id, $user_name, $email_id) 
	{
		$query ="SELECT user_id, user_name, email_id FROM user_data WHERE (user_name = ? OR email_id = ?) AND user_id != ?";
		$result = $this->db->query($query, array($user_name, $email_id, $user_id));
    	$result = $result->row_array(); 
    	if ($result) 
    	{
    	    return $result;
    	} 
    	else 
    	{
        	return false;

    	}
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
	function getImage($id)
	{
 		$this->session->userdata('is_logged_in');
 		$query = $this->db->query("SELECT * FROM users WHERE  id ='$id' ");
 		if($query->num_rows()==0)
 		{
 			die("Picture not foun!");
 		}
 		else
 		{
    		$row = $query->fetch_assoc();
    		$q = $row['profile_picture'];
    		return true;
     	}
	} 
	public function user_pic($user_id, $image)
	{
		$image_path = array('profile_pic' => $image);
		$this->db->where('user_id', $user_id);
		$this->db->update('user_data', $image_path);
		if ($this->db->trans_status() === true) 
		{
    		return true;
		} 
		else 
		{
   			return 	false;
    	}
	}
}
?>