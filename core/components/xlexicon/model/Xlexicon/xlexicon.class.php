<?php
class Xlexicon {

  function __construct(modX &$modx,array $config = array()) {
    $this->modx =& $modx;
    // using system settings instead of namespace for lightweight def. settings request
    $basePath = $this->modx->getOption('xlexicon.core_path',$config,$this->modx->getOption('core_path').'components/xlexicon/');
    $assetsUrl = $this->modx->getOption('xlexicon.assets_url',$config,$this->modx->getOption('assets_url').'components/xlexicon/');
    $managerUrl = $this->modx->getOption('xlexicon.manager_url',$config,$this->modx->getOption('manager_url').'components/xlexicon/');
    
    $this->config = array_merge(array(
      'corePath' => $basePath,
      'modelPath' => $basePath.'model/',
      'processorsPath' => $basePath.'processors/',
      'templatesPath' => $basePath.'templates/',
      'elementsPath' => $basePath.'elements/',
      'jsUrl' => $managerUrl.'js/',
      'cssUrl' => $managerUrl.'css/',
      'assetsUrl' => $assetsUrl,
      'managerUrl' => $managerUrl,
      'connectorsUrl' => $managerUrl.'connectors/',            
    ),$config);

    $this->publicConfig = array(
      'jsUrl' => $this->config['jsUrl'],
      'cssUrl' => $this->config['cssUrl'],
      'assetsUrl' => $this->config['assetsUrl'],
      'managerUrl' => $this->config['managerUrl'],
      'connectorsUrl' => $this->config['connectorsUrl'],       
    );

    $this->modx->addPackage('Xlexicon',$this->config['modelPath']);
  }    
  
  public function sanitizeCultureKey($debug = 'true'){
    
    if(
      !$response = $this->modx->runProcessor('web/languages/getlist',array(),array(
        'processors_path' => $this->config['processorsPath']
      ))
    ){
      $error = "Processor execute error";
      if($debug) $this->modx->log(xPDO::LOG_LEVEL_ERROR, __CLASS__." Line: ".__LINE__."] {$error}");
    }
    if($response->isError()){
      $error = $response->getMessage();
      if($debug) $this->modx->log(xPDO::LOG_LEVEL_ERROR, __CLASS__." Line: ".__LINE__."] {$error}");
    }else{
      $langs = array();
      foreach($response->getObject() as $v){
        array_push($langs,$v['iso_code']);
      }
      
      if(!empty($_REQUEST['cultureKey'])){
        if(!in_array($_REQUEST['cultureKey'],$langs)){
          $this->modx->cultureKey = $this->modx->getOption('xlexicon.cultureKey_base');  
        }else{
          $this->modx->cultureKey = $_REQUEST['cultureKey'];
        }        
        $_SESSION['cultureKey'] = $this->modx->cultureKey;
      }
    }
    $this->modx->setOption('cultureKey', $this->modx->cultureKey);  
    
    return $this->modx->cultureKey;
  }
  
}