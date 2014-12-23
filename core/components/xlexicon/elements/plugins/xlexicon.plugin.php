<?php
switch ($modx->event->name) {
  case 'OnDocFormPrerender':
    $assetsUrl = $modx->getOption('xlexicon.manager_url',null,$modx->getOption('manager_url').'components/xlexicon/');
    $jsUrl = $assetsUrl.'js/';
    
    $modx->regClientStartupScript($jsUrl.'xlexicon.js');
    $modx->regClientStartupScript($jsUrl.'misc/fields.js');
    $modx->regClientStartupScript($jsUrl.'widgets/resource.dictionary.panel.js');
    $modx->regClientStartupScript($jsUrl.'widgets/resource.dictionary.tab.js');
    $modx->regClientStartupHTMLBlock('<script type="text/javascript">
      
      Xlexicon.config = '.$modx->toJSON($modx->Xlexicon->publicConfig).';
      Xlexicon.resource = '.$modx->toJSON($_GET).';
      
      </script>');
	break;
  
  case 'OnBeforeDocFormSave':
    if($mode !== 'upd') return;
    $props = array();
    if(
      !$response = $modx->runProcessor('mgr/dictionaries/renew',array_merge($props, is_array($data) ? $data : array() ),array(
        'processors_path' => $modx->Xlexicon->config['processorsPath']  
      ))
    ){
      $error = 'Processor execute error';
      return $modx->event->_output = $error;
    }
    if($response->isError()){
      $error = $response->getMessage();
      return $modx->event->_output = $error;
    }
  break;
  
  case 'OnDocFormSave':
    //cleanup to be out of jsondecode error on parsing updateresource response
    foreach($scriptProperties as $resource){
        if(is_object($resource)){
            $resource->set('xlexicon','');
            
            foreach($resource->Dictionary as $Dictionary){
                $resource->set("xlexicon[{$Dictionary->language}][id]", $Dictionary->id);
            }
            
            break;
        }
    }
  break;
    
	case 'OnHandleRequest':
		if ($modx->context->key == 'mgr') break;
    
        $ck = $modx->Xlexicon->sanitizeCultureKey(false);
        
        $modx->setPlaceholders(array('cultureKey'=>$ck),'+');
        
        $cache_prefix = $modx->getOption('cache_prefix');
        $cache_prefix .= "_{$ck}";
        $modx->setOption('cache_prefix', $cache_prefix);
	break;

  case 'OnLoadWebDocument':
    // get resource dictionary by cultureKey
    $d = $modx->resource->getMany('Dictionary',array('language'=>$modx->getOption('cultureKey')));
    if(count($d) > 0){
      $data = current($d)->toArray();
      // clear stuff
      unset($data['uri'],$data['res'],$data['id']);
      // redefine data on fly     
      foreach($data as $k => $prop){
        if($prop){
          $modx->resource->set($k,$prop);
        }
      }
    }
  break;
  
  case 'OnWebPageInit':
    $lexicons = explode(',',$modx->getOption('xlexicon.lexicon_list'));
    if(count($lexicons)>0){
      foreach($lexicons as $v){
        $modx->lexicon->load($v);
      }
    }
  break;
}
