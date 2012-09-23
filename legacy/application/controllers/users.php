<?php

class Users extends VMT_Controller
{

	public function index()
	{
		$users = $this->user->find_all();
		$this->view->set('title', 'View Volunteers');
		$headings = array(
			'full_name' => 'Name',
			'email' => 'E-mail'
		);
		$this->view->create_index_table($headings, $users, $this->_get_user_actions());
	}

	protected function _create()
	{
		parent::_create();
		$this->view->set('screen', 'profile/manage');
	}	
	
	protected function _edit()
	{
		parent::_edit();
		$this->view->set('screen', 'profile/manage');
	}
	
	protected function _view()
	{
		parent::_view();
		$this->view->set('screen', 'profile/index');
	}
	
}