<?php

class Account extends VMT_Controller
{
	protected $_is_manager = false;
	
	public function login()
	{		
		if (!$this->auth->is_logged_in()) {
			$this->view->set('screen', 'account/login');
			$this->view->set('title', 'Login');
			if ($this->form_validation->run('login')) {
				if ($user = $this->auth->login()) {
					$session_data = array(
						'user_id', 'email', 'password', 'role_id',
						'first_name', 'middle_name', 'last_name', 'full_name'
					);
					foreach ($session_data as $datum) {
						$this->session->set_userdata($datum, $user->$datum);
					}
	                $this->session->set_userdata('full_name', $user->full_name);
					redirect();
				} else {
					show_error('Invalid account.', 401);
				}
			}
		}
	}
	
	public function register()
	{
		$this->view->set('title', 'Create a New Account');
	}
	
    public function authenticate()
    {
    	$email = $this->input->post('email');
		$password = $this->input->post('password');
		if ($user = $this->user->authenticate($email, $password)) {
			$this->session->set_userdata('auth', $user);
			return true;
		} else {
			$message = 'That username/password combination is not in our system.';
			$this->form_validation->set_message('authenticate', $message);
			return false;
		}
    }	

	public function logout()
	{
		$this->auth->logout();
		redirect();
	}

    public function reset()
    {
    	$this->view->set('title', 'Reset your password');
    }

}