<?php
class data_model extends CI_Model 
{
    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }

    /*Inseart user data for register user.
     *Param: array of data entered by user
     *Return: id of registerd user
	*/
	public function insert_data($data)
	{
		$result = $this->db->insert('user_data', $data);
		return $this->db->insert_id();
	}

	/*Check user data and retrive user data from database.
     *Param: user name or email id entered by user
     *Param: password entered by user
     *Return: array of user information
	*/
	public function user_login($user_name, $password)
	{
		$query = $this->db
				->select('user_id, privilege')
				->from('user_data')
			    ->where('user_name', $user_name)
			    ->where('password', $password)
			    ->or_where('email_id', $user_name)
			    ->where('password', $password)
			   	->get();

    	$result = $query->row_array();

		if ($result) 
		{
			return $result;
		} 
		else 
		{
			return false;
		}
	}

	/*Retrive user information stored in database
     *Param: id of user
     *Return: array of user information
	*/
	public function get_userdata($user_id)
	{
		$query = $this->db->get_where('user_data', array('user_id' => $user_id));
		return $query->row_array();
	}

	/*To update user data.
	 *Param: id of user
	 *Param: array of data with updated information
     *Return: return true on successful update
	*/
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

	/*For checking if email or user name already exist.
	 *Param: id of user
	 *Param: user name entered by user
	 *Param: email id entered by user
     *Return: array of user information
	*/
	public function check_Duplicate($user_id, $user_name, $email_id) 
	{
		$query = $this->db
				->select('user_id, user_name, email_id')
				->from('user_data')
			    ->where('user_name', $user_name)
			    ->where('user_id !=', $user_id)
			    ->or_where('email_id', $email_id)
			   	->where('user_id !=', $user_id)
			   	->get();

    	$result = $query->row_array();
    	if ($result) 
    	{
    	    return $result;
    	} 
    	else 
    	{
           	return false;
    	}
	}

	/*Count total records
     *Return: total users in database
    */
    public function record_count() 
    {
		$query = $this->db
				->where('privilege', 1)
				->get('user_data');
		
		return $query->num_rows();
	}

	/*Fetch data according to per_page limit.
	 *Param: start limit 
	 *Param: number of record to retrive
     *Return: array of information
	*/
	public function fetch_data($start, $limit) 
	{
		$query = $this->db
				->select('user_id, first_name, last_name, user_name, email_id, address_line1, address_line2, city, zip_code, state, country')
				->from('user_data')
				->where('privilege', 1)
				->limit($limit,$start)
				->get();

		if ($query->num_rows() >= 1) 
		{
			return $query->result();
		} 
		else 
		{
			return false;
		}
	}

	/*Delete user as requested by admin.
	 *Param: id of user to remove
     *Return: return true on successful delete of row
	*/
	public function delete_user($remove_id)
	{
		$query = $this->db
				->select('privilege')
				->from('user_data')
				->where('user_id', $remove_id)
				->get();

		$result = $query->row_array(); 
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
	
	/*Inseart profile picture path into database.
	 *Param: id of user
	 *Param: image path
     *Return: true on successful taransection
	*/
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