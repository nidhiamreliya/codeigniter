<?php
class MY_Controller extends CI_Controller
{
	public function views($name, $data) {
			$this->load->view('includes/header');
			$this->load->view($name, $data);
			$this->load->view('includes/footer');
	}
}
?>