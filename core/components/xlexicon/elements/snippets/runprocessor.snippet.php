<?php
$output = '';

if(!$action){
  $modx->log(xPDO::LOG_LEVEL_ERROR, "Can't find action");
  $modx->log(xPDO::LOG_LEVEL_ERROR, print_r($scriptProperties, true));
  return;
}

$params = array();
// get namespace settings
if($ns){
  if($namespace = $modx->getObject('modNamespace', $ns)){
    $params['processors_path'] = $namespace->getCorePath().'processors/';
  }
  else{
    $modx->log(xPDO::LOG_LEVEL_ERROR, "Can't find '{$ns}' namespace");
    $modx->log(xPDO::LOG_LEVEL_ERROR, print_r($scriptProperties, true));
  }
}
// run processor
if(!$response = $modx->runProcessor($action, $scriptProperties, $params)){  
  $modx->log(xPDO::LOG_LEVEL_ERROR, "Processor execute error");
  $modx->log(xPDO::LOG_LEVEL_ERROR, print_r($scriptProperties, true));
  return;
}
// get processor response
$result = $response->getResponse();

if(!isset($ph)) $ph = false;
if(!isset($row)) $row = false;
if(!isset($outer)) $outer = false;

if(!function_exists('rp_wrappering')){
  function rp_wrappering($modx,$data,$scriptProperties,$dataKey='object',$ph,$row='row',$outer='outer'){
    if(!$row){
      $output = $data[$dataKey];   
    // if row template is set
    }else{
      /*
       * wrappering
       */
      $output = '';
      $i = 1;
      // get rows
      if(is_array($data[$dataKey]) && count($data[$dataKey]) > 0){
        foreach($data[$dataKey] as $k => $v){
          $v['array_key'] = $k;
          $v['array_index'] = $i;
          switch($i){
            case 1:
              $v['array_pos'] = 'first';
              break;
            case (count($data[$dataKey]) == $i):
              $v['array_pos'] = 'last';
              break;
            default:
              break;
          }
          
          $output .= $modx->getChunk($row,$v);
          $i++;
        }
      }
      // if outer template is set
      if($outer){
        // prepare data
        $data = $scriptProperties+$data;
        unset($data['results']);
        $data['row'] = $output;
        
        // get wrapper
        $output = $modx->getChunk($outer,$data);
      }
      
      // try to get ph
      if($ph){
        $modx->setPlaceholder($ph,$output);
        return;
      }      
      // eof wrappering
    }
    return $output;
  }    
}

/*
 * analyze data
 */
if(is_string($result)){
  $data = $modx->fromJSON($result);
  
  // try to decode. if !array — simple output
  if(!is_array($data)){ 
    $output = $result; 
  
  // if response was json-like
  }else{
    $output = rp_wrappering($modx,$data,$scriptProperties,'results',$ph,$row,$outer);
  }  
  
}
// if we have one element in array array but string in array('object')
else if(is_array($result)){
  // if error
  if(!$result['success']){
    $modx->log(xPDO::LOG_LEVEL_ERROR,"[runprocessor] Data:".print_r($scriptProperties,1)." Message:".$response->getMessage());
    $output = $response->getMessage();
    
  }else if(!empty($result['object']) && is_string($result['object'])){
    $output = $result['object'];
    
  // others
  }else{
    $modx->log(xPDO::LOG_LEVEL_INFO,$response->getMessage());
    $output = rp_wrappering($modx,$result,$scriptProperties,'object',$ph,$row,$outer);
  }
}
return $output;