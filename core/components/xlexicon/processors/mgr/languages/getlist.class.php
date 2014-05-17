<?php
 
class modMgrLanguagesGetlistProcessor extends modObjectGetListProcessor {
  public $classKey = 'XlexiconLanguage';
  public $languageTopics = array('Xlexicon:manager');
  public $objectType = 'XlexiconLanguage';    

  public function prepareQueryBeforeCount(xPDOQuery $c) {
    $query = $this->getProperty('query');
    if (!empty($query)) {
      $c->where(array(
        'name:LIKE' => '%'.$query.'%',
        'OR:description:LIKE' => '%'.$query.'%',
      ));
    }
    return $c;
  }
  
  public function prepareRow(xPDOObject $object) {
    $object = parent::prepareRow($object);
    
    $menu = array();
    
    $menu[] = array(
      'text' => $this->modx->lexicon('xlexicon.contextMenu_language_update')
      ,'handler' => 'this.updateLanguage'
    );
    /*
    future feature
    $menu[] = array(
      'text' => $this->modx->lexicon('xlexicon.contextMenu_language_prop')    
      ,'handler' => 'this.propLanguage'
    );*/
    $menu[] = array(
      'text' => $this->modx->lexicon('xlexicon.contextMenu_language_remove')    
      ,'handler' => 'this.removeLanguage'
    );
    
    $object['menu'] = $menu;
    
    return $object;
  }
}
return 'modMgrLanguagesGetlistProcessor';