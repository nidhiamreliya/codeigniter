<?php
class data_model extends CI_Model 
{
    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
        //Load library and helpers
        $this->load->helper(array('url', 'function_helper'));
        $this->load->library('session');
    }

    //Inseart user data for register user.
	public function insert_data($data)
	{
		$result = $this->db->insert('user_data', $data);
		return $this->db->insert_id();
	}

	//Check user name and password when user login 
	public function user_login($user_name, $password)
	{
		$password = create_password($password);
		$condition = "(user_name = '" . $user_name . "' OR  email_id = '" . $user_name . "') AND password = '" . $password . "'";
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

	// Get user data of specific user id
	public function get_userdata($user_id)
	{
		$query = $this->db->get_where('user_data', array('user_id' => $user_id));
		return $query->row_array();
	}

	// To update user data.
	public function update_userdata($user_id, $data)
	{
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

	// Count total records
    public function record_count() 
    {
		$query = $this->db->where('privilege', 1)->get('user_data');
		return $query->num_rows();
	}

	// Fetch data according to per_page limit.
	public function fetch_data($start, $limit) 
	{
		$condition = "privilege = 1";
		$this->db->select('user_id, first_name, last_name, user_name, email_id, address_line1, address_line2, city, zip_code, state, country');
		$this->db->from('user_data');
		$this->db->where($condition);
		$this->db->limit($limit,$start);
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