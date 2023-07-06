<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MY_DB_pdo_informix_driver extends CI_DB_pdo_informix_driver 
{
	protected $CI;

	function __construct($params){
	    parent::__construct($params);
	    $this->_protect_identifiers = FALSE;
	}

	protected function _list_tables($prefix_limit = FALSE)
	{
		$sql = 'SELECT tabname FROM systables
			WHERE tabid > 99 AND tabtype = \'T\' AND LOWER(owner) = '.$this->escape(strtolower($this->username));

		if ($prefix_limit === TRUE && $this->dbprefix !== '')
		{
			$sql .= ' AND tabname LIKE \''.$this->escape_like_str($this->dbprefix)."%' "
				.sprintf($this->_like_escape_str, $this->_like_escape_chr);
		}

		return $sql;
	}

	// --------------------------------------------------------------------

	/**
	 * Show column query
	 *
	 * Generates a platform-specific query string so that the column names can be fetched
	 *
	 * @param	string	$table
	 * @return	string
	 */
	protected function _list_columns($table = '')
	{
		if (strpos($table, '.') !== FALSE)
		{
			sscanf($table, '%[^.].%s', $owner, $table);
		}
		else
		{
			$owner = $this->username;
		}

		return 'SELECT colname FROM systables, syscolumns
			WHERE systables.tabid = syscolumns.tabid
				AND systables.tabtype = \'T\'
				AND LOWER(systables.owner) = '.$this->escape(strtolower($owner)).'
				AND LOWER(systables.tabname) = '.$this->escape(strtolower($table));
	}

	// --------------------------------------------------------------------

	/**
	 * Returns an object with field data
	 *
	 * @param	string	$table
	 * @return	array
	 */
	public function field_data($table)
	{
		$sql = 'SELECT syscolumns.colname AS name,
				CASE syscolumns.coltype
					WHEN 0 THEN \'CHAR\'
					WHEN 1 THEN \'SMALLINT\'
					WHEN 2 THEN \'INTEGER\'
					WHEN 3 THEN \'FLOAT\'
					WHEN 4 THEN \'SMALLFLOAT\'
					WHEN 5 THEN \'DECIMAL\'
					WHEN 6 THEN \'SERIAL\'
					WHEN 7 THEN \'DATE\'
					WHEN 8 THEN \'MONEY\'
					WHEN 9 THEN \'NULL\'
					WHEN 10 THEN \'DATETIME\'
					WHEN 11 THEN \'BYTE\'
					WHEN 12 THEN \'TEXT\'
					WHEN 13 THEN \'VARCHAR\'
					WHEN 14 THEN \'INTERVAL\'
					WHEN 15 THEN \'NCHAR\'
					WHEN 16 THEN \'NVARCHAR\'
					WHEN 17 THEN \'INT8\'
					WHEN 18 THEN \'SERIAL8\'
					WHEN 19 THEN \'SET\'
					WHEN 20 THEN \'MULTISET\'
					WHEN 21 THEN \'LIST\'
					WHEN 22 THEN \'Unnamed ROW\'
					WHEN 40 THEN \'LVARCHAR\'
					WHEN 41 THEN \'BLOB/CLOB/BOOLEAN\'
					WHEN 4118 THEN \'Named ROW\'
					ELSE syscolumns.coltype ||\'\'
				END AS type,
				syscolumns.collength as max_length,
				CASE sysdefaults.type
					WHEN \'L\' THEN sysdefaults.default
					ELSE NULL
				END AS default
			FROM syscolumns, systables, outer sysdefaults
			WHERE syscolumns.tabid = systables.tabid
				AND systables.tabid = sysdefaults.tabid
				AND syscolumns.colno = sysdefaults.colno
				AND systables.tabtype = \'T\'
				AND LOWER(systables.tabname) = '.$this->escape(strtolower($table)).'
			ORDER BY syscolumns.colno';
				//AND LOWER(systables.owner) = '.$this->escape(strtolower($this->username)).'

			$query = $this->query($sql)->result();

		return (($query = $this->query($sql)) !== FALSE)
			? $query->result_object()
			: FALSE;
	}


	function get_first($table){
		return $this->limit(1)->get($table);
	}

	//overide query builder..
	// --------------------------------------------------------------------
	/**
	 * WHERE
	 *
	 * Generates the WHERE portion of the query.
	 * Separates multiple calls with 'AND'.
	 *
	 * @param	mixed
	 * @param	mixed
	 * @param	bool
	 * @return	CI_DB_query_builder
	 */
	public function where($key, $value = NULL, $escape = TRUE)
	{
		return $this->_wh('qb_where', $key, $value, 'AND ', $escape);
	}
	// --------------------------------------------------------------------

	/**
	 * Insert
	 *
	 * Compiles an insert string and runs the query
	 *
	 * @param	string	the table to insert data into
	 * @param	array	an associative array of insert values
	 * @param	bool	$escape	Whether to escape values and identifiers
	 * @return	object
	 */
	public function insert($table = '', $set = NULL, $escape = TRUE)
	{
		if ($set !== NULL)
		{
			$this->set($set, '', $escape);
		}

		if ($this->_validate_insert($table) === FALSE)
		{
			return FALSE;
		}

		$sql = $this->_insert(
			$this->protect_identifiers(
				$this->qb_from[0], TRUE, FALSE, FALSE
			),
				// $this->qb_from[0], TRUE, $escape, FALSE

			array_keys($this->qb_set),
			array_values($this->qb_set)
		);

		$this->_reset_write();
		return $this->query($sql);
	}
	// --------------------------------------------------------------------
	/**
	 * OR WHERE
	 *
	 * Generates the WHERE portion of the query.
	 * Separates multiple calls with 'OR'.
	 *
	 * @param	mixed
	 * @param	mixed
	 * @param	bool
	 * @return	CI_DB_query_builder
	 */
	public function or_where($key, $value = NULL, $escape = TRUE)
	{
		return $this->_wh('qb_where', $key, $value, 'OR ', $escape);
	}

	// --------------------------------------------------------------------
	
	/**
	 * The "set" function.
	 *
	 * Allows key/value pairs to be set for inserting or updating
	 *
	 * @param	mixed
	 * @param	string
	 * @param	bool
	 * @return	CI_DB_query_builder
	 */
	public function set($key, $value = '', $escape = TRUE)
	{
		$key = $this->_object_to_array($key);
		if ( ! is_array($key))
		{
			$key = array($key => $value);
		}

		is_bool($escape) OR $escape = $this->_protect_identifiers;

		foreach ($key as $k => $v)
		{
			// $this->qb_set[$this->protect_identifiers($k, FALSE, $escape)] = ($escape)
			// 	? $this->escape($v) : $v;
			$this->qb_set[$this->protect_identifiers($k, FALSE, FALSE)] = ($escape)
				? $this->escape($v) : $v;
		}

		return $this;
	}

}

/* End of file MY_DB_pdo_informix_driver.php */
/* Location: ./application/core/MY_DB_pdo_informix_driver.php */
