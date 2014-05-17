<?php

$settings = array();
/*
$setting_name = PKG_NAME_LOWER.'.setting';
$setting = $modx->newObject('modSystemSetting');
$setting->fromArray(array(
 'key' => $setting_name,
 'value' => '',
 'xtype' => 'textfield',
 'namespace' => NAMESPACE_NAME,
 'area' => 'default',
),'',true,true);

$settings[] = $setting;
*/

$setting_name = 'modConnectorRequest.class';
$setting = $modx->newObject('modSystemSetting');
$setting->fromArray(array(
 'key' => $setting_name,
 'value' => 'classes.XlexiconConnectorRequest',
 'xtype' => 'textfield',
 'namespace' => NAMESPACE_NAME,
 'area' => 'core',
),'',true,true);
$settings[] = $setting;

$setting_name = PKG_NAME_LOWER.'.cultureKey_base';
$setting = $modx->newObject('modSystemSetting');
$setting->fromArray(array(
 'key' => $setting_name,
 'value' => 'ru',
 'xtype' => 'textfield',
 'namespace' => NAMESPACE_NAME,
 'area' => 'core',
),'',true,true);
$settings[] = $setting;

$setting_name = PKG_NAME_LOWER.'.lexicon_list';
$setting = $modx->newObject('modSystemSetting');
$setting->fromArray(array(
 'key' => $setting_name,
 'value' => 'xlexicon:default',
 'xtype' => 'textfield',
 'namespace' => NAMESPACE_NAME,
 'area' => 'core',
),'',true,true);
$settings[] = $setting;

unset($setting,$setting_name);
return $settings;