<?php  if(!defined('BASEPATH')) exit('No direct script access allowed');

$config = array(
    		'login/check_data' => array(
							array(
							    'field' => 'user_name',
							    'label' => 'User name',
							    'rules' => 'trim|required|xss_clean'
							),
							array(
							    'field' => 'password',
							    'label' => 'Password',
							    'rules' => 'trim|required|xss_clean'
							)
		    ),
		    'check_user' => array(
							array(
							    'field' => 'first_name',
							    'label' => 'First name',
							    'rules' => 'required|alpha|xss_clean'
							),
							array(
							    'field' => 'last_name',
							    'label' => 'Last name',
							    'rules' => 'required|alpha|xss_clean'
							),
							array(
							    'field' => 'address_line1',
							    'label' => 'Address',
							    'rules' => 'required|xss_clean'
							),
							array(
							    'field' => 'address_line2',
							    'label' => 'Address',
							    'rules' => 'xss_clean'
							),
							array(
							    'field' => 'city',
							    'label' => 'City',
							    'rules' => 'required|xss_clean'
							),
							array(
							    'field' => 'zip_code',
							    'label' => 'Zip code',
							    'rules' => 'required|exact_length[6]|numeric|xss_clean'
							),
							array(
							    'field' => 'state',
							    'label' => 'State',
							    'rules' => 'required|xss_clean'
							),
							array(
							    'field' => 'country',
							    'label' => 'Country',
							    'rules' => 'required|xss_clean'
							)

		    ),
			'register_user' =>array(
								array(
							    'field' => 'user_name',
							    'label' => 'User name',
							    'rules' => 'required|is_unique[user_data.user_name]|xss_clean'
								),
								array(
								    'field' => 'email_id',
								    'label' => 'Email id',
								    'rules' => 'required|valid_email|is_unique[user_data.email_id]|xss_clean'
								),
								array(
								    'field' => 'password',
								    'label' => 'Password',
								    'rules' => 'required|min_length[6]|xss_clean'
								),
								array(
								    'field' => 'confirm_password',
								    'label' => 'Confirm password',
								    'rules' => 'required|matches[password]'
								)
							)
);
$config['registeration'] = array_merge($config['check_user'], $config['register_user']);
?>