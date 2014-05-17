<?php
class modMgrDictionariesRenewProcessor extends modProcessor{
  protected $alias = 'Dictionary';
  
  public function process(){
    $trans = $this->getProperty('xlexicon');
    if(is_array($trans)){
      $processorsPath = $this->modx->Xlexicon->config['processorsPath'];
      foreach($trans as $k => $t){
        
        $t['res'] = $this->getProperty('id');
        
        // if there's no resource dictionary it doesn't exist.
        if(empty($t['id'])){
          unset($t['id']);
          $t['language'] = $k;
          
          if(
            !$response = $this->modx->runProcessor('mgr/dictionaries/create',$t,array(
              'processors_path' => $processorsPath
            ))
          ){
            $error = "Processor execute error";
            //$this->modx->log(xPDO::LOG_LEVEL_ERROR, __CLASS__." Line: ".__LINE__."] {$error}");
            return $this->failure($error);
          }
          if($response->isError()){
            return $this->failure($response->getMessage());  
          }
          
        }else{
          
          if(
            !$response = $this->modx->runProcessor('mgr/dictionaries/update',$t,array(
              'processors_path' => $processorsPath
            ))
          ){
            $error = "Processor execute error";
            //$this->modx->log(xPDO::LOG_LEVEL_ERROR, __CLASS__." Line: ".__LINE__."] {$error}");
            return $this->failure($error);            
          }
          if($response->isError()){
            return $this->failure($response->getMessage());  
          }
          
        }      
      }
    }
    return $this->success('Successfully updated');
  }
  
}
return 'modMgrDictionariesRenewProcessor';