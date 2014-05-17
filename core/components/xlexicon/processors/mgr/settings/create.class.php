<?php
class modMgrSettingsCreateProcessor extends modObjectCreateProcessor {
  public $classKey = 'XlexiconSetting';
  public $languageTopics = array('Xlexicon:manager');
  public $objectType = 'XlexiconSetting';

  public function beforeSave() {
		$this->object->set('lang_key', $this->getProperty('langid'));
    $this->object->set('editedon', time());
		
    return parent::beforeSave();
	}
}
return 'modMgrSettingsCreateProcessor';