<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

function create_password($password)
{
    return md5(md5(SALT) + md5($password));
}   

function input_array($name, $id, $class, $placeholder)
{
    $data = array(
			'name' => $name,
		    'id' => $id,
		   	'class' => $class,
		   	'placeholder' => $placeholder
		);
    return $data;
}
function control_array($name, $id, $class)
{
    $data = array(
			'name' => $name,
		    'id' => $id,
		   	'class' => $class
		);
    return $data;
}   