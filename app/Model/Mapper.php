<?php

namespace Model;

use LeanMapper\Caller;
use LeanMapper\DefaultMapper;
use LeanMapper\Fluent;
use LeanMapper\Row;

/**
 * @author Vojtěch Kohout
 */
class Mapper extends DefaultMapper
{

	/** @var string */
	protected $relationshipTableGlue = '_2_';


	/**
	 * @param string $entityClass
	 * @return string
	 */
	public function getTable($entityClass)
	{
		return $this->camelToUnderdash($this->trimNamespace($entityClass));
	}

	/**
	 * @param string $table
	 * @param Row $row
	 * @return string
	 */
	public function getEntityClass($table, Row $row = null)
	{
		return $this->defaultEntityNamespace . '\\' . ucfirst($this->underdashToCamel($table));
	}

	/**
	 * @param string $entityClass
	 * @param Caller $caller
	 * @return array
	 */
	public function getImplicitFilters($entityClass, Caller $caller = null)
	{
		if ($entityClass === $this->defaultEntityNamespace . '\Tag') {
			return function (Fluent $fluent) {
				$fluent->where('[deleted] != 1');
			};
		}
		return array();
	}


	////////////////////
	////////////////////

	/**
	 * @param  string
	 * @return string
	 */
	private function camelToUnderdash($s)
	{
		return rawurlencode(strtolower(preg_replace('#(.)(?=[A-Z])#', '$1_', $s)));
	}

	/**
	 * @param  string
	 * @return string
	 */
	private function underdashToCamel($s)
	{
		return str_replace(' ', '', substr(ucwords('x' . preg_replace('#_(?=[a-z])#', ' ', strtolower($s))), 1));
	}

}
