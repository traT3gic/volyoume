<?php

class Message_Model extends VMT_Model
{

	public function find_by_author_id($id, $limit = '', $offset = 0, $count = false)
	{
		$this->db->where('messages.author_id', $id);
		return $this->find_all($limit, $offset, $count);
	}

	public function find_new_by_recipient_id($id, $limit = '', $offset = 0, $count = false)
	{
		$this->db->where('messages.is_read', '0');
		return $this->find_by_recipient_id($id, $limit, $offset, $count);
	}

	public function find_by_recipient_id($id, $limit = '', $offset = 0, $count = false)
	{
		$this->db->where('messages.recipient_id', $id);
        return $this->find_all($limit, $offset, $count);
	}

	public function find_all($limit = '', $offset = 0, $count = false)
	{
        $this->db->join('users', 'messages.recipient_id = users.user_id');
        $this->db->join('users as a', 'messages.author_id = a.user_id');
		$this->db->select("messages.*, CONCAT_WS(' ', users.first_name, users.middle_name, users.last_name) as recipient_name, CONCAT_WS(' ', a.first_name, a.middle_name, a.last_name) as author_name", false);
		$this->db->order_by('messages.create_date', 'desc');
        return parent::find_all($limit, $offset, $count);
	}
	
	public function mark_read($id)
	{
		return $this->update($id, array('is_read' => '1'));
	}
	
	public function create($data)
	{
		if (!is_array($data['recipient_id'])) {
			$data['recipient_id'] = array($data['recipient_id']);
		}
		$this->db->trans_start();
		foreach ($data['recipient_id'] as $id) {
			$tmp = $data;
			unset($tmp['recipient_id']);
			$tmp['recipient_id'] = $id;
			$this->db->insert('messages', $tmp);
		}
		$this->db->trans_complete();
		return !($this->db->trans_status() === false);
	}
	
	public function delete($id)
	{
		if (!is_array($id)) $id = array($id);
		$this->db->where_in('message_id', $id);
		return $this->db->delete('messages');
	}
	
	public function update($id, $data)
	{
		$this->db->where('message_id', $id);
		return $this->db->update('messages', $data);
	}

}