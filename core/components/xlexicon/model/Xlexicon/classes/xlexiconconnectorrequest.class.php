<?php
require_once MODX_CORE_PATH . 'model/modx/modconnectorrequest.class.php';
class XlexiconConnectorRequest extends modConnectorRequest{

  public function initialize() {
    if ($this->modx && is_object($this->modx->context) && $this->modx->context instanceof modContext) {
      $ctx = $this->modx->context->get('key');
      if (!empty($ctx) && $ctx == 'mgr') {
          $ml = $this->modx->getOption('manager_language',null,$this->modx->getOption('cultureKey',null,'en'));
          if (!empty($ml)) {
              $this->modx->setOption('cultureKey',$ml);
          }
      }elseif(!empty($ctx) && $ctx !== 'mgr'){
        
        if (!isset($this->modx->lexicon)) $this->modx->getService('lexicon', 'modLexicon');
        if (!isset($this->modx->error)) $this->modx->getService('error', 'error.modError');
        $this->modx->Xlexicon->sanitizeCultureKey(false);

      }
    }
    
    /* load default core cache file of lexicon strings */
    $this->modx->lexicon->load('core:default');
    
    if ($this->modx->actionMap === null || !is_array($this->modx->actionMap)) {
        $this->loadActionMap();
    }
    
    return true;
    }
  
}