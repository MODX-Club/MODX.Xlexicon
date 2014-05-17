<?php

if(
    empty($_REQUEST['ctx'])
    OR $_REQUEST['ctx'] == 'mgr'
){
    $_REQUEST['ctx'] = 'web';
}

require_once dirname(dirname(dirname(dirname(dirname(__FILE__))))).'/connectors/index.php';

$_SERVER['HTTP_MODAUTH']= $modx->user->getUserToken($modx->context->get('key'));
 
$location = '';

/* handle request */
if(!$path = $modx->getOption('xlexicon.core_path')){
    $path = $modx->getOption('core_path').'components/xlexicon/';
}
$path .=  'processors/';

$modx->request->handleRequest(array(
    'processors_path' => $path,
    'location'  => $location,
    'action'    => 'web/public/action',
));