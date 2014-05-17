<?php

/*
  Processor-router
*/

//ini_set('display_errors', 1);

class modWebPublicActionProcessor extends modProcessor{
    
  public static function getInstance(modX &$modx,$className,$properties = array()) {
    $actualClass = '';
    // Here we cah redefine processor class
    if(!empty($properties['pub_action'])){

      switch($properties['pub_action']){
          
        case 'dictionary/getfield': 
          require dirname(dirname(__FILE__)) . '/dictionaries/getfield.class.php';                    
          $actualClass = 'modWebDictionariesGetfieldProcessor';
          break;
        
        default:;
      }
      
    }  
    
    if($actualClass){
      $className = $actualClass;
      unset($properties['pub_action']);
    }
    
    return parent::getInstance($modx,$className,$properties);
  }    
  
  public function process(){
    $error = 'Processor execute error';
    $this->modx->log(xPDO::LOG_LEVEL_ERROR, __CLASS__." Line: ".__LINE__."] {$error}");
    $this->modx->log(xPDO::LOG_LEVEL_ERROR, print_r($this->getProperties(), true));
    return $this->failure($error);
  }
  
}

return 'modWebPublicActionProcessor';