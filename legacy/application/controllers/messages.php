<?php

class Messages extends VMT_Controller
{

	public function index()
	{
		$this->view->set('title', 'Message Inbox');
		$user_id = $this->session->userdata('user_id');
		$result = $this->message->find_by_recipient_id($user_id);
		$this->_num_total_items = count($result);
		$headings = array(
			'create_date' => 'Date',
			'author_name' => 'From',
			'subject' => 'Subject'
		);
		$messages = array();
		$fields = array_keys($headings);
		$limit = $this->_items_per_page;
		$offset = $this->uri->segment(3, 0);		
		if ($result) {
			$paginated_result = array_slice($result, $offset, $limit);
			foreach ($paginated_result as $message) {
				$message->create_date = date('F d, Y', strtotime($message->create_date));
				if ($message->is_read == '0') {
					foreach ($fields as $field) {
						$message->$field = '<strong>' . $message->$field . '</strong>';
					}
				}
				$messages[] = $message;
			}
		}
		create_index_table($headings, $messages);
	}
	
	protected function _edit()
	{
		show_error('Messages cannot be edited.', 500);
	}

	protected function _view()
	{
		parent::_view();
		$this->message->mark_read($this->uri->segment(2));
	}

}
