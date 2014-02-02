<?php

namespace Model\Entity;

/**
 * @property ArticleCategory|null $category m:hasOne
 * @property Tag[] $tags m:hasMany
 *
 * @property string $title
 * @property string $content_html
 */
class Article extends Entity
{
}