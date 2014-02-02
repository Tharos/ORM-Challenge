<?php

use Model\Repository\ArticleRepository;
use Nette\Templating\FileTemplate;

/**
 * @fragment homepage
 * @following initTemplate
 */
function renderHomepage(ArticleRepository $articleRepository, FileTemplate $template)
{
	$template->articles = $articleRepository->findAll();
}