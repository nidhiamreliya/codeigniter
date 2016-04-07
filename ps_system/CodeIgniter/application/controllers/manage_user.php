<?php
class Manage_user extends CI_Controller 
{
	public function __construct()
    {
        parent::__construct();
        $this->load->library('pagination');
    }

    //Show all user's information to admin
	public function index()
	{
		if($this->session->userdata('user_id') != null &&  $this->session->userdata('privilege') == 2)
		{
			$config["base_url"] = base_url("index.php/manage_user/index");
			$total_row = $this->data_model->record_count();
			$config["total_rows"] = $total_row;
			$config["per_page"] = 5;
			$config['use_page_numbers'] = TRUE;
			$config['num_links'] = ceil($total_row/$config["per_page"]);
			$config['cur_tag_open'] = '&nbsp;<a class="current"><strong><u>';
			$config['cur_tag_close'] = '</u></strong></a>';
			$config['next_link'] = 'Next';
			$config['prev_link'] = 'Previous';
			$this->pagination->initialize($config);

			if($this->uri->segment(3))
			{
				$page = ($this->uri->segment(3)-1) * $config["per_page"];
			}
			else
			{
				$page = 1;
			}
			$data["results"] = $this->data_model->fetch_data($page, $config["per_page"]);
			$str_links = $this->pagination->create_links();
			$data["links"] = explode('&nbsp;',$str_links );
			 $this->load->view('includes/header');
			$this->load->view('system_views/manage_user', $data);
			$this->load->view('includes/footer');
		}
		else
		{
			redirect('log_out');
		}
	}

	//To delete user.
	//param: id if user to remove
	public function delete_user($remove_id)
	{
		if($this->session->userdata('user_id') != null &&  $this->session->userdata('privilege') == 2)
		{
			$result = $this->data_model->delete_user($remove_id);
			if($result)
			{
				$this->session->set_flashdata('success_msg', 'One user has been deleted.');
				redirect('manage_user');
			}
			else
			{
				$this->session->set_flashdata('error_msg', 'Sorry u can not delete this user.');
				redirect('manage_user');
			}
		}
		else
		{
			redirect('log_out');
		}

	}
}