<?php

class Pages extends CI_Controller {

	public function view($page = 'home')
	{
		
	}
	
	public function view($page = 'registration')
	{

	}
	
	public function view($page = 'license')
	{

	}
	
	public function view($page = 'report')
	{
		
	}
	
	function handle_view($page) {
		if ( ! file_exists(APPPATH.'/views/pages/'.$page.'.php'))
		{
			// Whoops, we don't have a page for that!
			show_404();
		}
	
		$data['title'] = ucfirst($page); // Capitalize the first letter
	
		$this->load->view('templates/header', $data);
		$this->load->view('pages/'.$page, $data);
		$this->load->view('templates/footer', $data);
	
	}
}
