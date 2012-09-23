<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * VMT
 *
 * A volunteer management system.
 *
 * @package     VMT
 * @author      Guillermo A. Fisher <guillermoandraefisher@gmail.com>
 * @copyright   Copyright (c) 2009 - 2010, Guillermo A. Fisher
 * @since       Version 1.0
 * @filesource
 */

// ------------------------------------------------------------------------

/**
 * VMT Application Model Class
 *
 * This class, which inherits from CodeIgniter's base model class, is the
 * base class for the models in this application.
 *
 * @package     VMT
 * @subpackage  Libraries
 * @category    Libraries
 * @author      Guillermo A. Fisher <guillermoandraefisher@gmail.com>
 */
class VMT_Model extends CI_Model
{
	/**
	 * The name of the table tied to this Model.
	 * @var string
	 */
	protected $_table;

	/**
	 * The database prefix set in the application configuration.
	 * @var string
	 */
	protected $_db_prefix;

	/**
	 * The related table's primary key field.
	 * @var string
	 */
	protected $_primary_key;

	/**
	 * Collection of all of the related table's fields.
	 * @var array
	 */
	protected $_fields = array();

	/**
	 * Collection of all of the related table's indices.
	 * @var array
	 */
	protected $_indices = array();
	
	/**
	 * An instance of the CodeIgniter super object.
	 * @var object
	 */	
	protected $_ci;

	/**
	 * Constructor. Derives table and field information.
	 * 
	 * @return null
	 */
	final public function __construct()
	{
		// invoke parent constructor
		parent::__construct();

		// register an instance of the super object
		$this->_ci =& get_instance();
		
		// try to derive the table if it is not provided
		if (empty($this->_table)) {
			$table = str_replace('_Model', '', get_class($this));
			$this->_table = strtolower(plural($table));
		}

		// get the db prefix from the config
		$this->_db_prefix = $this->db->dbprefix;
	}
	
    /**
     * Retrieves a row from the database by the primary key.
     * 
     * @param $id int  The row ID
     * @return mixed
     */
    public function find_by_id($id)
    {
        $field = singular($this->_table) . '_id';
    	$this->db->where($field, $id);
    	return $this->find_one();
    }	

    /**
     * Retrieves a row from the database.
     * 
     * @return mixed
     */
    public function find_one()
    {
        $result = $this->find_all(1);
    	return $result[0];
    }

    /**
     * Retrieves rows from the database.
     * 
     * @param int $limit OPTIONAL the number of rows to return
     * @param int $offset OPTIONAL the record by which to offset the result
     * @param bool $count OPTIONAL whether or not to return a record count
     * @return mixed
     */
    public function find_all($limit = 0, $offset = 0, $count = false, $table = '')
    {
    	if ($limit) {
    		$this->db->limit($limit, $offset);
    	}
        if (empty($table)) {
        	$table = $this->_table;
        }
        $this->db->from($table);
		if ($count) {
			return $this->db->count_all_results();
        }
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        }
    }

	/**
	 * Create a new database record.
	 * 
	 * @param mixed $data an associate array or object of data to be inserted
	 * @return bool
	 */
	public function create($data){}

	/**
	 * Update database records.
	 * 
	 * @param mixed $id the value of the primary key for the desired record
	 * @param mixed $data an associate array or object of data to be updated
	 * @return mixed
	 */
	public function update($id, $data){}

	/**
	 * Deletes a record from the database.
	 * 
	 * @param mixed $id the value of the primary key for the desired record
	 * @return bool
	 */
	public function delete($id){}

    /**
     * Retrieves records from the database by field.
     * 
     * @param string $field the name of the field by which to search
     * @param array $value the value by which to search
     * @param int $limit OPTIONAL the number of rows to return
     * @param int $offset OPTIONAL the record by which to offset the result
     * @param bool $count OPTIONAL whether or not to return a record count
     * @return mixed
     */
    final protected function _find_by($field, $value, $limit = 0, $offset = 0, $count = false)
    {
        $this->db->where($field, $value);
        return $this->find_all($limit, $offset, $count);
    }

}
