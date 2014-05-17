<?php

$xpdo_meta_map = array (
  'xPDOSimpleObject' => 
  array (
    0 => 'XlexiconLanguage',
    1 => 'XlexiconSetting',
    2 => 'XlexiconDictionary',
  ),
);

$this->map['modResource']['composites']['Dictionary'] = array(
  'class' => 'XlexiconDictionary',
  'local' => 'id',
  'foreign' => 'res',
  'cardinality' => 'many',
  'owner' => 'local',
);