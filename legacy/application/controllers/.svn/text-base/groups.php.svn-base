<?php

class Groups extends VMT_Controller
{

	public function index()
	{
		if (!$this->auth->is_super_admin()) {
			$groups = $this->group->find_by_user_id(session_info('user_id'));
		} else {
			$groups = $this->group->find_all();
		}
		$this->view->set('title', 'View ' . ucwords(plural(config_item('group_alias'))));
		$this->view->set('groups', 1);
		$headings = array(
			'name' => 'Name',
			'description' => 'Description'
		);
		create_index_table($headings, $groups);
	}
	
	protected function _init()
	{
		$result = $this->group->find_all();
		$groups = array();
		foreach ($result as $g) {
			$groups[$g->group_id] = $g->name;
		}
		$this->view->set('groups_dropdown_data', $groups);
	}
	
	protected function _view()
	{
		parent::_view();
		$item = $this->view->get('item');
		$user = $this->user->find_group_leader($item->group_id);
		$item->user = $user;
		$this->view->set('item', $item);
		$this->view->set('title', 'View ' . ucwords(singular(config_item('group_alias'))));
		$this->session->set_flashdata('recipient_id', $user->user_id);
		$this->session->set_flashdata('recipient_name', $user->full_name);
	}
	
	
}
