<?php

class Profile extends VMT_Controller
{

	protected $_is_manager = false;
	
	public function edit()
	{
		$this->view->set('title', 'Edit My Profile');
		$item = $this->view->get('user');
		$this->view->set('item', $item);
		$this->view->set('screen', 'profile/manage');
		$status = null;
		if ($this->form_validation->run('user')) {
			$data = $this->input->post();
			unset($data['submit']);
			if ($this->user->update($item->user_id, $data)) {
				$status = 'Successfully edited profile.';
			} else {
				$status = 'Error.';
			}
			$this->session->set_flashdata('status', $status);
		}
	}

}