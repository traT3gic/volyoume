<?php
/**
 * Creates an index table that will display data.
 * 
 * @param array $headings  The table headings
 * @param array $data  The table data
 */	
function create_index_table($headings, $data)
{
	// get an instance of the CI super object
	$ci =& get_instance();
	
	// if the table is empty, add a row that says as much
	if (empty($data)) {
		$table = '<p>No items found.</p>';

	// else, build the table
	} else {

		// start creating the template
		$ci->table->set_template(array(
			'table_open' => '<table class="index">'
		));		
		
		// build the headings row
		$labels = array_merge(
			array(form_checkbox(array('id'=>'selector'))),
			array_values($headings),
			array('&nbsp;')
		);
		$ci->table->set_heading($labels);
		
		// get the name of the primary index field
		$controller = $ci->uri->segment(1);
		$id_field = singular($controller) . '_id';
			
		// get the names of the fields
		$fields = array_keys($headings);
			
		// define the user actions
		$actions = array();
		foreach (array('view', 'edit', 'delete') as $action) {
			if (has_permission($action)) {
				$actions[] = $action;
			}
		}
		
		// loop through the data
		foreach ($data as $datum) {
			$id = $datum->$id_field;				
			$row = array(form_checkbox(array(
				'name' => 'ids[]',
				'value' => $id,
				'role' => $controller
			)));
			foreach ($fields as $field) {
				$row[] = $datum->$field;
			}
			$links = '<ul>';
			foreach ($actions as $action) {
				$command = '';
				if (strtolower($action) != 'view') {
					$command = strtolower($action);
				}
				$links .= '<li><a class="button ' . strtolower($action)
					. '" href="'
					. site_url('/'.$controller.'/'.$id.'/'.$command)
					. '">' . $action . '</a></li>';
			}
			$links .= '</ul>';
			$row[] = array('data' => $links, 'class' => 'actions');
			$table = $ci->table;
			call_user_func_array(array($table, 'add_row'), $row);
		}
		
		// capture the output
		$table = form_open($ci->uri->uri_string . '/delete') . 
			$ci->table->generate() . 
			form_close();
	}
		
	// generate the table
	$ci->view->set('index_table', $table); 
}

/**
 * Returns the actions needed for the index table.
 * 
 * @return array  The actions
 */       
function get_user_actions()
{
   	$actions = array();
    if ($this->auth->has_permission($this->_controller, 'view')) {
   		$actions[] = 'View';
  	}    	
   	if ($this->auth->has_permission($this->_controller, 'edit')) {
   		$actions[] = 'Edit';
   	}
    if ($this->auth->has_permission($this->_controller, 'delete')) {
   		$actions[] = 'Delete';
   	} 	
   	return $actions;
}

