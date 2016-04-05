<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

function create_password($password)
{
    return md5(md5(SALT) + md5($password));
}   
