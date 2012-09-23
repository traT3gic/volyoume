<?php

class Search extends VMT_Controller
{
	
	public function index()
	{
		if ($action = $this->input->post('submit')) {
			$results = $this->member->search($query);
			$this->view->set('results', $results);
		}
	}
	
}