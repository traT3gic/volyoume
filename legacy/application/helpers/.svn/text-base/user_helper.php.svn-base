<?php
function user_info($string)
{
	$user = page_info('user');
	if (isset($user->$string)) {
		return $user->$string;
	}	
}

function is_logged_in()
{
	$ci =& get_instance();
	return $ci->auth->is_logged_in();
}

function is_leader()
{
	$ci =& get_instance();
	return $ci->auth->is_leader();
}

function is_super_admin()
{
	$ci =& get_instance();
	return $ci->auth->is_super_admin();
}

function is_self()
{
	$ci =& get_instance();
	$user_id = $ci->session->userdata('user_id');
	if ($ci->uri->uri_string() == 'profile' || $ci->uri->segment(3) == $user_id) {
		return true;
	}
	return false;
}

function has_permission($action)
{
	$ci =& get_instance();
	$controller = $ci->uri->segment(1);
	return $ci->auth->has_permission($controller, $action);
}