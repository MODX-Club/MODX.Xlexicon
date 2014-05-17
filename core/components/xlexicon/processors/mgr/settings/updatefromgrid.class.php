<?php

require_once (dirname(__FILE__).'/update.class.php');
class modMgrSettingsUpdatefromgridProcessor extends modMgrSettingsUpdateProcessor {
    
  public function initialize(){
    if($data = $this->modx->fromJSON($this->getProperty('data'))){
      unset($this->properties['data']);
      $this->setDefaultProperties($data);
    }else{
      return $this->modx->lexicon('invalid_data');
    }
    return parent::initialize();
  }
}
return 'modMgrSettingsUpdatefromgridProcessor';