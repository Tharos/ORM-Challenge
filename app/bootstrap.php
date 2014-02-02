<?php

use Nette\Configurator;
use Nette\Diagnostics\Debugger;

require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/functions.php';
require_once __DIR__ . '/SplClassLoader.php';

//////////

$classLoader = new SplClassLoader(null, __DIR__);
$classLoader->register();

//////////

Debugger::$strictMode = true;
Debugger::enable(Debugger::DEVELOPMENT, __DIR__ . '/../log');

//////////

$configurator = new Configurator;
$configurator->defaultExtensions = array();

$configurator->onCompile[] = function ($configurator, $compiler) {
	$compiler->addExtension('leanmapper', new LeanMapperExtension);
};

$configurator->addConfig(__DIR__ . '/config/config.neon');
$configurator->addParameters(array(
	'appDir' => __DIR__,
	'tempDir' => __DIR__ . '/../temp',
));

$container = $configurator->createContainer();