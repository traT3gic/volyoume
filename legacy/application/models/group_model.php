<?php

class Group_Model extends VMT_Model
{

	public function find_by_group_id($id)
	{
		$this->db->where('group_id', $id);
		return $this->find_one();
	}

	public function find_by_user_id($id)
	{
		$this->db->select('*');
		$this->db->where('users.user_id', $id);
		$this->db->join('users',
		    'users.group_id = groups.group_id');
		return $this->find_all();
	}
	
	public function add_user($group_id, $user_id)
	{
		
	}
	
	public function remove_user($group_id, $user_id)
	{
		
	}
	
	public function create($data)
	{
		return $this->db->insert('groups', $data);
	}

	public function delete($id)
	{
		if (is_array($id)) {
			$this->db->where_in('group_id', $id);
		} else {
			$this->db->where('group_id', $id);
		}
		return $this->db->delete('groups');		
	}

	public function update($id, $data)
	{
		$this->db->where('group_id', $id);
		return $this->db->update('groups', $data);
	}	
}