<?php
class modMgrDictionariesGetlistProcessor extends modObjectGetListProcessor {
  public $classKey = 'XlexiconDictionary';
  public $languageTopics = array('Xlexicon:resource');
  public $objectType = 'XlexiconDictionary';
  public $defaultSortField = 'language';

  public function initialize(){
    if(!$this->getProperty('res')){
      return 'Empty resource id';
    }
    return parent::initialize();
  }
  
  public function prepareQueryBeforeCount(xPDOQuery $c) {
    $where = array();
    
    
    if($res = $this->getProperty('res')){
      $where['res'] = $res;
    }
    
    $where['Language.active'] = 1;
    if($ctx = $this->getProperty('context')){
      $c->leftJoin('XlexiconLanguage','Language',"Language.iso_code = {$this->classKey}.language");
      $c->andCondition(array(
        'Language.context:REGEXP' => "(^|.+,){$ctx}(,.+|$)"  
      ));
    }
    
    $c->where($where);
    return $c;
  }

  public function iterate(array $data) {
    $list = array();
    $list = $this->beforeIteration($list);
    
    $list['data'] = parent::iterate($data);

    // try to get languages
  	$q = $this->modx->newQuery('XlexiconLanguage',array('active' => 1));
  	$q->select(array('id','name','iso_code'));
    if($ctx = $this->getProperty('context')){
      $q->andCondition(array(
        'XlexiconLanguage.context:REGEXP' => "(^|.+,){$ctx}(,.+|$)"  
      ));
    }
  	if ($q->prepare() && $q->stmt->execute()) {
      $list['lang'] = $q->stmt->fetchAll(PDO::FETCH_ASSOC);
    }    
    
    $list = $this->afterIteration($list);
    return $list;
  }

}
return 'modMgrDictionariesGetlistProcessor';