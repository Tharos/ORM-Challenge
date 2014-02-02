<?php

namespace Model\Repository;

use LeanMapper\Repository;
use Model\Entity\Article;

/**
 * @author Vojtěch Kohout
 */
class ArticleRepository extends Repository
{

	/**
	 * @return Article[]
	 */
	public function findAll()
	{
		return $this->createEntities(
			$this->createFluent()->orderBy('id')->desc()->fetchAll()
		);
	}

}