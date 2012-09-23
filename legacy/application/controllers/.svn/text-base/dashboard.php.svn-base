<?php

class Dashboard extends VMT_Controller
{
	protected $_is_manager = false;
	
	public function index()
	{
		// localize the user data
		$user = $this->view->get('user');
		
		// page properties
		$this->view->set('title', 'Dashboard');
		$this->view->set('screen', 'dashboard/index');
		
		// set info by user role		
		if ($this->auth->is_super_admin()) {
			$percentage_alert_threshold = '30';
			$num_assigned_users = $this->user->find_assigned('', 0, 1);
			$this->view->set('num_assigned_users', $num_assigned_users);
			$num_unassigned_users = $this->user->find_unassigned('', 0, 1);
			$this->view->set('num_unassigned_users', $num_unassigned_users);
		} else if ($this->auth->is_leader()) {
		}
	}

}
