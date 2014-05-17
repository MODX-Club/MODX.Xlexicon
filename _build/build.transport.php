<?php

$pkg_name = 'Xlexicon';

/* define package */
define('PKG_NAME', $pkg_name);
define('PKG_NAME_LOWER',strtolower(PKG_NAME));
define('NAMESPACE_NAME', PKG_NAME_LOWER);

define('PKG_PATH', PKG_NAME_LOWER);
define('PKG_CATEGORY', PKG_NAME);

$pkg_version = '2.1.4';
$pkg_release = 'beta';
define('PKG_VERSION', $pkg_version);
define('PKG_RELEASE', $pkg_release);


$mtime= microtime();
$mtime= explode(" ", $mtime);
$mtime= $mtime[1] + $mtime[0];
$tstart = $mtime;


print '<pre>';
require_once dirname(__FILE__). '/build.config.php';

/*
 * Set log Params
 */
$modx->setLogLevel(modX::LOG_LEVEL_INFO);
$modx->setLogTarget('ECHO'); echo '<pre>'; flush();

/*
 * Create Builder
 */
$modx->loadClass('transport.modPackageBuilder','',false, true);
$builder = new modPackageBuilder($modx);

/*
 * Create Package
 */
$builder->createPackage(PKG_NAME_LOWER,PKG_VERSION,PKG_RELEASE);
$builder->registerNamespace(PKG_NAME_LOWER,false,true,'{core_path}components/'.PKG_NAME_LOWER.'/');

/*
 * Load lexicon
 */
include_once $sources['builder_includes'] . 'lexicon.php'; //OK

/*
 * Add Namespace
 */
include_once $sources['builder_includes'] . 'namespace.php'; //OK

/*
 * Add mediasources
 */
//include_once $sources['builder_includes'] . 'mediasources.php';

/* 
 * Create system settings via vehicle
 */
include_once $sources['builder_includes'] . 'system.settings.php'; //OK

/*
 * Create custom system settings via vehicle 
 */
include_once $sources['builder_includes'] . 'system.events.php'; //OK

/*
 * Create Category
 */
include_once $sources['builder_includes'] . 'category.php'; //OK

/* add plugins */
include_once $sources['builder_includes'] . 'plugins.php'; //OK

/* add snippets */
include_once $sources['builder_includes'] . 'snippets.php'; //OK

/* add chunks */
include_once $sources['builder_includes'] . 'chunks.php'; //OK

/*
 * Create category vehicle
 */
include_once $sources['builder_includes'] . 'category.attributes.php'; //OK
$vehicle = $builder->createVehicle($category,$attr);
// eof Create Category

/*
 * Adding sources (3 sources by default)
 */
include_once $sources['builder_includes'] . 'resolver.sources.php';

/*
 * Adding resolvers
 */
$modx->log(modX::LOG_LEVEL_INFO,'Adding in PHP resolvers...'); flush();
include_once $sources['builder_includes'] . 'resolver.tables.php';
include_once $sources['builder_includes'] . 'resolver.register.php';
$builder->putVehicle($vehicle);
// eof adding resolvers


/*
 * Load Menu 
 */
include_once $sources['builder_includes'] . 'menu.php';

/* now pack in the license file, readme and setup options */
include_once $sources['builder_includes'] . 'eula.php';


$modx->log(modX::LOG_LEVEL_INFO,'Packing...'); flush();
$builder->pack();

$mtime= microtime();
$mtime= explode(" ", $mtime);
$mtime= $mtime[1] + $mtime[0];
$tend= $mtime;

$totalTime= ($tend - $tstart);
$totalTime= sprintf("%2.4f s", $totalTime);

$modx->log(modX::LOG_LEVEL_INFO,"\n<br />Package Built.<br />\nExecution time: {$totalTime}\n");

exit ();