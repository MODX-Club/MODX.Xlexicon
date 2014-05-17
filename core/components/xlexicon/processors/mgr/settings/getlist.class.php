<?php
class modMgrSettingsGetListProcessor extends modObjectGetListProcessor {
  public $classKey = 'XlexiconSetting';
  public $languageTopics = array('Xlexicon:manager');
  public $objectType = 'XlexiconSetting';
  public $defaultSortField = 'key';

  public function prepareQueryBeforeCount(xPDOQuery $c) {
    $lang_key = $this->getProperty('langid');
    $contextlm = $this->getProperty('contextlm');
    
    $c->where(array('lang_key' => $lang_key, 'context' => $contextlm));
    return $c;
  }
  
  public function prepareRow(xPDOObject $object) {
    $object = parent::prepareRow($object);
    
    $menu = array();
    
    $menu[] = array(
      'text' => $this->modx->lexicon('xlexicon.contextMenu_setting_update')
      ,'handler' => 'this.updateProperty'
    );
    $menu[] = array(
      'text' => $this->modx->lexicon('xlexicon.contextMenu_setting_remove')    
      ,'handler' => 'this.removeProperty'
    );
    
    $object['menu'] = $menu;
    
    return $object;
  }

}
return 'modMgrSettingsGetListProcessor';