<?php
class Manage_user extends MY_Controller
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
			$values = $this->config->config;
			$values["base_url"] = base_url("/manage_user/index");
			$total_row = $this->data_model->record_count();
			$values["total_rows"] = $total_row;
			$values['num_links'] = ceil($total_row/$values["per_page"]);

			$this->pagination->initialize($values);
			$page_no = $this->uri->segment(3);
			if($page_no > 0 && $page_no <= $values['num_links'])
			{
				$page = ($page_no-1) * $values["per_page"];
			}
			else if($page_no > $values['num_links'])
			{
				$page = ($values['num_links']-1) * $values["per_page"];
			}
			else
			{
				$page = 1;
			}

			$data["results"] = $this->data_model->fetch_data($page, $values["per_page"]);
			if($data)
			{
				$str_links = $this->pagination->create_links();
				$data["links"] = explode('&nbsp;',$str_links );
			}
			else
			{
				$data["links"] = "sorry no data available.";
			}
			$this->views('system_views/manage_user', $data);
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