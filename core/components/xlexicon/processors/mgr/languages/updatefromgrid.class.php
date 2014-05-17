<?php
require_once (dirname(__FILE__).'/update.class.php');
class modMgrLanguagesUpdateFromGridProcessor extends modMgrLanguagesUpdateProcessor {

  public function initialize(){
    if($data = $this->modx->fromJSON($this->getProperty('data'))){
      unset($this->properties['data']);
      $this->setDefaultProperties($data);
    }else{
      return $this->modx->lexicon('invalid_data');
    }
    return parent::initialize();
  }
  
  public function beforeSave(){
      
    $this->object->set('modified_by', $this->modx->user->id);
    $this->object->set('modified_date', time());
    
    return parent::beforeSave();
  }
  
}
return 'modMgrLanguagesUpdateFromGridProcessor';