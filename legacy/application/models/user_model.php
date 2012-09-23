<?php
class User_Model extends VMT_Model
{

    public function authenticate($email, $password)
    {
    	$this->db->where('email', $email);
        $this->db->where('password', md5($password));
        return $this->find_one();
    }

    public function search($term, $limit = '', $offset = 0)
    {
        $this->db->like('email', $term);
        $this->db->or_like('first_name', $term);
        $this->db->or_like('middle_name', $term);
        $this->db->or_like('last_name', $term);
        return $this->find_all($limit, $offset);
    }

    public function find_by_user_id($id)
    {
    	$this->db->where('user_id', $id);
    	return $this->find_one();
    }

	public function find_leaders($limit = 0, $offset = 0, $count = false)
	{
        $this->db->where('is_leader', 1);
        return $this->find_all($limit, $offset, $count);
	}

    public function find_admins($limit = 0, $offset = 0, $count = false)
    {
        $this->db->where('is_admin', 1);
        return $this->find_all($limit, $offset, $count);
    }

    public function find_pending($limit = 0, $offset = 0, $count = false)
    {
        $this->db->where('is_confirmed', 0);
        return $this->find_all($limit, $offset, $count);
    }

    public function find_confirmed($limit = 0, $offset = 0, $count = false)
    {
        $this->db->where('is_confirmed', 1);
        return $this->find_all($limit, $offset, $count);
    }
    
    public function find_assigned($limit = 0, $offset = 0, $count = false)
    {
        $this->db->where('users.group_id > 0');
        return $this->find_all($limit, $offset, $count);
    }    

    public function find_unassigned($limit = 0, $offset = 0, $count = false)
    {
        $this->db->where('users.group_id', 0);
        return $this->find_all($limit, $offset, $count);
    }

    public function find_group_leader($group_id)
    {
    	$this->db->where('users.group_id', $group_id);
        $this->db->where('users.role_id', 2);
        return $this->find_one();
    }

    public function find_group_admin($group_id)
    {
    	$this->db->where('users.group_id', $group_id);
        $this->db->where('is_admin', 1);
        return $this->find_one();
    }

    public function find_group($group_id, $limit = 0, $offset = 0, $count = false)
    {
        return $this->find_by_group_id($group_id, $limit, $offset, $count);
    }

    public function find_group_confirmed($group_id, $limit = 0, $offset = 0, $count = false)
    {
        $this->db->where('is_confirmed', 1);
        return $this->find_by_group_id($group_id, $limit, $offset, $count);
    }

    public function find_group_pending($group_id, $limit = 0, $offset = 0, $count = false)
    {
        $this->db->where('is_confirmed', 0);
        return $this->find_by_group_id($group_id, $limit, $offset, $count);
    }

	public function find_by_group($group_id, $limit = 0, $offset = 0, $count = false)
	{
		return $this->find_by_group_id($group_id, $limit, $offset, $count);
	}

    public function find_by_group_id($group_id, $limit = 0, $offset = 0, $count = false)
    {
    	$this->db->where('users.group_id', $group_id);
        return $this->find_all($limit, $offset, $count);
    }

    public function find_all($limit = '', $offset = 0, $count = false)
    {
        $this->db->select("users.*, CONCAT_WS(' ', users.first_name, users.middle_name, users.last_name) as full_name, roles.name as role_name, groups.name as group_name", false);
        $this->db->join('groups',
            'groups.group_id = users.group_id', 'right');
        $this->db->join('roles',
            'roles.role_id = users.role_id');
        return parent::find_all($limit, $offset, $count);
    }

	public function has_permission($id, $perm)
	{
		$this->db->select('*');
		$this->db->from('roles_permissions');
		$this->db->join('users', 'roles_permissions.role_id = users.role_id');
		$this->db->join('permissions', 'roles_permissions.permission_id = permissions.permission_id');
		$this->db->where('users.user_id', $id);
		$this->db->where('permissions.value', $perm);
		return ($this->db->count_all_results() > 0);
	}    

	public function populate_permissions()
	{
		$query = $this->db->select('permission_id')->from('permissions')->get();
		$permissions = $query->result();
		foreach ($permissions as $p) {
			$this->db->insert('roles_permissions', array('permission_id' => $p->permission_id, 'role_id'=>4));
		}		
	}
	
    public function update_profile()
    {
    	
    }

    public function create($data)
    {
    	$data['notes'] = date('m-d-Y h:i A', mktime()) . ' | Account created.';
    }

    public function update($id, $data)
    {
    	$data['notes'] = date('m-d-Y h:i A', mktime()) . ' | Account edited.';
    	$this->db->where('user_id', $id);
    	return $this->db->update('users', $data);
    }
    
    public function delete($id)
    {
    	return $this->db->delete('users', array('user_id' => $id));
    }
    
    public function track($id, $message)
    {
    	$this->db->where('user_id', $id);
    	return $this->db->update('users', array(
    		'history' => $message . PHP_EOL
    	));
    }

    protected function _get_user_full_name($user)
    {
        $full_name = $user->first_name;
        if (!empty($user->middle_name)) {
            $full_name .= ' ' . $user->middle_name;
        }
        $full_name .= ' ' . $user->last_name;
        return $full_name;
    }

}