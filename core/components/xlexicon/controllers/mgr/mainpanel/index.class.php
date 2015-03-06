<?php
require_once dirname(dirname(__FILE__)).'/index.class.php';

class ControllersMgrMainpanelManagerController extends XlexiconManagerController{
    
  public static function getInstance(modX &$modx, $className, array $config = array()) {
    $className = __CLASS__;
    return new $className($modx, $config);
  }
  
    public static function getInstanceDeprecated(modX &$modx, $className, array $config = array()) {
        return self::getInstance($modx, $className, $config);
    }
  
  public function getTemplateFile() {
    return 'mainpanel/index.tpl';
  }   
  
  public function getLanguageTopics() {
    return array_merge(parent::getLanguageTopics(),array("{$this->module_name}:manager"));
  }
  
  public function initialize(){
    $this->modx->getVersionData();
    $modxVersion = $this->modx->version['full_version'];

    if (!version_compare($modxVersion, '2.2.6', '>=')) {
      return $this->failure("MODX 2.2.6 or highter required");
    }
    return parent::initialize();
  } 
  
  public function loadCustomCssJs() {
    parent::loadCustomCssJs();
    
    $assets_url = $this->getOption('manager_url');
    
    $this->addJavascript($assets_url.'js/misc/functions.js');
    $this->addJavascript($assets_url.'js/misc/columns.js');
    $this->addJavascript($assets_url.'js/misc/fields.js');
    $this->addJavascript($assets_url.'js/misc/windows.js');
    
    $this->addJavascript($assets_url.'js/widgets/language.settings.grid.js');
    $this->addJavascript($assets_url.'js/widgets/home.grid.js');
    $this->addJavascript($assets_url.'js/widgets/home.panel.js');
    $this->addLastJavascript($assets_url.'js/sections/index.js');
    return;
  }
    
}
