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

    //Inseart user data for register user.
	public function insert_data()
	{
		$password = md5(md5(SALT) + md5($this->input->post('password')));
		$data = array(
			'privilege' => 1,
			'first_name' => $this->input->post('first_name'),
			'last_name' =>  $this->input->post('last_name'),
			'user_name' => $this->input->post('user_name'),
			'email_id' => $this->input->post('email_id'),
			'password' => $password,
			'address_line1' => $this->input->post('address_line1'),
			'address_line2' => $this->input->post('address_line2'),
			'city' => $this->input->post('city'),
			'zip_code' => $this->input->post('zip_code'),
			'state' => $this->input->post('state'),
			'country' => $this->input->post('country'),
			'profile_pic' => "default_profile.jpg"
		);
		$result = $this->db->insert('user_data', $data);
		return $this->db->insert_id();
	}

	//Check user name and password when user login 
	public function user_login()
	{
		$password = md5(md5(SALT) + md5($this->input->post('password')));
		$condition = "user_name =" . "'" . $this->input->post('user_name') . "' AND " . "password =" . "'" . $password . "'";
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

	// Get user data who has specific user id
	public function get_userdata($user_id)
	{
		$query = $this->db->get_where('user_data', array('user_id' => $user_id));
		return $query->row_array();
	}

	// To update user data.
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
				$password = md5(md5(SALT) + md5($this->input->post('password')));
				$data['password'] = $password;
			}
		}
		if($this->session->userdata('privilege') == 1)
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
				$password = md5(md5(SALT) + md5($this->input->post('password')));
				$data['password'] = $password;
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

	//for checking if email or user name already exist.
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

	// Retrive all user data from database
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

	// Delete user as requested by admin.
	public function delete_user($remove_id)
	{
		$result = $this->manage_data->get_userdata($remove_id);
		if($result['privilege'] == 1)
		{
			$this->db->delete('user_data', array('user_id' => $remove_id));
			return true;
		}
		else
		{
			return false;
		} 
	}
	
	// Inseart profile picture into database.
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