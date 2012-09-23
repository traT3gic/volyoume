<?php
class Api extends CI_Controller
{

	public function _remap($method = '')
	{
		
		$host = parse_url(site_url(), PHP_URL_HOST);
		if ($referer = $this->input->get_request_header('referer')) {
			$referer_host = parse_url($url, PHP_URL_HOST);
			$host = parse_url(site_url(), PHP_URL_HOST);
			if ($referer_host != $host) {
				$this->_error(401, 'Permission denied.');
			}
		}
		
		
		
		$model = singular($this->uri->segment(2)) . '_model';
		if ($model_path = realpath(APPPATH . '/models/' . $model . '.php')) {
			$command = null;
			$this->load->model($model, 'item');
			if ($id = $this->uri->segment(3)) {
				if (preg_match('/[0-9]+/', $id, $matches)) {
					if ($matches[0] == $id) {
						$command = $this->uri->segment(3, 'view');
					}
				} else if ($method == 'new') {
					$command = 'create';
				}
			} else {
				$command = 'index';
			}
			$data = array();
			switch ($command) {
				case 'create':
					$result = $this->item->create();
					break;
				case 'delete':
					$result = $this->item->delete($id);
					break;
				case 'edit':
					$result = $this->item->update($id, $data);
					break;
				case 'index':
					if (!$limit = $this->input->post('limit')) {
						$limit = 0;
					}
					$result = $this->item->find_all($limit);
					break;
				case 'view':
					$type = singular($this->uri->segment(1));
					$m = 'find_by_' . $type . '_id';
					$result = $this->item->$m($id);
					break;
				default:
					$this->_error(404, 'Invalid command');
					break;					
			}
			if ($result) {
				$this->_success($result);
			}
		} else {
			$this->_error(404, 'Invalid API call');
		}
	}
	
	protected function _error($code, $message)
	{
		$result = array(
			'message'	=> $message,
			'request'	=> $this->uri->uri_string()
		);
		$this->_respond($code, $result);
	}
	
	protected function _success($result)
	{
		$this->_respond(200, $result);	
	}
	
	protected function _respond($header, $result)
	{
		$this->output->set_status_header($header);
		header('Content-type: application/json');
		$output = json_encode($result);
		$this->output->set_output($output);
	}
	
}