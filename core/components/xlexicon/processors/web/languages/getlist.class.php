<?php
require_once dirname(dirname(__FILE__)).'/getdata.class.php'; 
class modWebLanguagesGetlistProcessor extends XlexiconWebGetDataProcessor {
  public $classKey = 'XlexiconLanguage';
  public $languageTopics = array('Xlexicon:manager');
  public $objectType = 'XlexiconLanguage';    
  
  public function initialize(){
    
    $this->setDefaultProperties(array(
      'cache'         => true  
      ,'cache_prefix' => 'getlangs_'.$this->getOption('cultureKey').'/'
      ,'context'      => $this->modx->context->key
    ));
    
    return parent::initialize();
  }
  
  public function prepareQueryBeforeCount(xPDOQuery $c){
    $c = parent::prepareQueryBeforeCount($c);
    
    $where = array();
    
    if(!$this->getProperty('showinactive')){
      $where['active'] = 1;
    }
    
    if($ctx = $this->getOption('context')){
      $c->andCondition(array(
        "{$this->classKey}.context:REGEXP" => "(^|.+,){$ctx}(,.+|$)"  
      ));
    }
    
    $c->where($where);
    return $c;
  }
  
  public function afterIteration(array $list) {
    $_list = parent::afterIteration($list);
    $list = array();
    
    $list = $_list;
    array_push($list,array(
      'iso_code' => $this->getOption('xlexicon.cultureKey_base')  
    ));
    
    return $list;
  }
  
  public function outputArray(array $array, $count = false){
    //fix total
    $count = count($array);
    return parent::outputArray($array,$count);
  }
  
}

return 'modWebLanguagesGetlistProcessor';