<?php
require_once dirname(dirname(__FILE__)).'/getdata.class.php';
class modWebDictionariesGetfieldProcessor extends XlexiconWebGetDataProcessor {
  public $classKey = 'XlexiconDictionary';
  public $objectType = 'XlexiconDictionary';  
  public $defaultSortField = 'id';
  
  public function initialize(){
    
    $this->setDefaultProperties(array(
      'cache'         => true  
      ,'cache_prefix' => 'getfield_'.$this->getOption('cultureKey').'/'
      ,'debug'        => 'true'
    ));
    
    // get resource id
    if(!$this->getProperty('res')){
      return "Can't find resource id";
    }
    // get field
    if(!$this->getProperty('field')){
      return "Can't find field name";
    }
    
    return parent::initialize();
  }
    
  public function prepareQueryBeforeCount(xPDOQuery $c){
    $c = parent::prepareQueryBeforeCount($c);
    
    $where = array();
    
    $where['res'] = $this->getProperty('res');
    $where['language'] = $this->getOption('cultureKey');
    $c->where($where);
    
    return $c;
  }
  
  protected function setSelection(xPDOQuery $c){
    //$c = parent::setSelection($c);
    
    $field = $this->getProperty('field');
    // try to load only needed fields. that's why whe don't inherit parent method
    $c->select(array(
      "{$this->classKey}.id"
      ,"{$this->classKey}.id as `object_id`" // for compatibility
      ,"{$this->classKey}.{$field}"
    ));
    
    return $c;
  }
  
  public function afterIteration(array $list) {
    $_list = parent::afterIteration($list);
    $list = array();
    
    $id = $this->getProperty('res');
    $field = $this->getProperty('field');
    $debug = $this->getProperty('debug');

    // if we have data in dictionary
    if(count($_list) != 0){
      $list = $_list;
      $item = current($list);
      if(empty($item[$field])){
        
        if($debug) $this->modx->log(xPDO::LOG_LEVEL_WARN,"Can't get field value from dictionary. Resource: ".$id.'-'.$field.'-'.$this->getOption('cultureKey'));
        
        $list[$item['object_id']][$field] = $field;
      }
      
    // if we found that there is no data for resource
    }else{
      
      if($debug) $this->modx->log(xPDO::LOG_LEVEL_WARN,"Get native resource field value: ".$this->getProperty('res').'-'.$this->getProperty('field'));

      array_push($list,array(
        'id'=>$id
        ,'object_id'=>$id
        ,$this->getProperty('field') => $this->getNativeField()  
      ));  
    }
    
    return $list;
  }
  
  protected function getNativeField(){
    $id = $this->getProperty('res');
    $field = $this->getProperty('field');
    if($this->modx->resource && $this->modx->resource->id == $id){
      return $this->modx->resource->get($field);
    }else{
      $obj = $this->modx->getObject('modResource',$id);
      if($obj){
        return $obj->get($field);
      }
    }
    return'';
  }
  
  public function outputArray(array $array, $count = false){
    $item = current($array);  
    return $item[$this->getProperty('field')];
  }

}
return 'modWebDictionariesGetfieldProcessor';