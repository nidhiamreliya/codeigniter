<?php
class data_model extends CI_Model 
{
    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }

    /*Inseart user data for register user.
     *@params array $data data entered by user
     *@return int user id
	*/
	public function insert_data($data)
	{
		$result = $this->db->insert('user_data', $data);
		return $this->db->insert_id();
	}

	/*Check user data and retrive user data from database.
     *@params string $user_name user name or email_id 
     *@params string $password 
     *@returns array row
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

		if ($query->num_rows() > 0) 
		{
			return $query->row_array();
		} 
		else 
		{
			return false;
		}
	}

	/*Retrive user information stored in database
     *@params int id
     *@return array row
    */
	public function get_userdata($user_id)
	{
		$query = $this->db->get_where('user_data', array('user_id' => $user_id));
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

	/*To update user data.
	 *@params int $user_id
	 *@params array $data updated information
     *@return: bool 
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
	 *@params int user_id
	 *@params string user_name
	 *@params string email id
     *@return array row
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
     *@return int total users in database
    */
    public function record_count() 
    {
		$query = $this->db
				->where('privilege', 1)
				->get('user_data');
		
		return $query->num_rows();
	}

	/*Fetch data according to per_page limit.
	 *@params int $page page no 
	 *@params int $limit no of record to retrive
     *@return array rows
	*/
	public function fetch_data($page, $limit) 
	{
		$query = $this->db
				->select('user_id, first_name, last_name, user_name, email_id, address_line1, address_line2, city, zip_code, state, country')
				->from('user_data')
				->where('privilege', 1)
				->limit($limit,$page)
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
	 *@params int $remove_id id of user to remove
     *@return bool
	*/
	public function delete_user($remove_id)
	{
		$query = $this->db
				->select('privilege')
				->from('user_data')
				->where('user_id', $remove_id)
				->get();

		$result = $query->row_array(); 
		if($result['privilege'] == 1) {
			$this->db->delete('user_data', array('user_id' => $remove_id));
			return true;
		} else {
			return false;
		} 
	}
	
	/*Inseart profile picture path into database.
	 *@params int $user_id 
	 *@params string $image image path
     *@return bool
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