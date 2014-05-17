<?php
$xpdo_meta_map['XlexiconLanguage']= array (
  'package' => 'Xlexicon',
  'version' => '2.1',
  'table' => 'xlexicon_languages',
  'extends' => 'xPDOSimpleObject',
  'fields' => 
  array (
    'name' => NULL,
    'active' => 0,
    'iso_code' => NULL,
    'language_code' => NULL,
    'context' => 'web',
  ),
  'fieldMeta' => 
  array (
    'name' => 
    array (
      'dbtype' => 'varchar',
      'precision' => '32',
      'phptype' => 'string',
      'null' => false,
    ),
    'active' => 
    array (
      'dbtype' => 'tinyint',
      'precision' => '1',
      'attributes' => 'unsigned',
      'phptype' => 'integer',
      'null' => false,
      'default' => 0,
    ),
    'iso_code' => 
    array (
      'dbtype' => 'char',
      'precision' => '2',
      'phptype' => 'string',
      'null' => false,
      'index' => 'unique',
    ),
    'language_code' => 
    array (
      'dbtype' => 'char',
      'precision' => '5',
      'phptype' => 'string',
      'null' => false,
    ),
    'context' => 
    array (
      'dbtype' => 'varchar',
      'precision' => '100',
      'phptype' => 'string',
      'null' => false,
      'default' => 'web',
      'index' => 'index',
    ),
  ),
  'indexes' => 
  array (
    'iso_code' => 
    array (
      'alias' => 'iso_code',
      'primary' => false,
      'unique' => true,
      'type' => 'BTREE',
      'columns' => 
      array (
        'iso_code' => 
        array (
          'length' => '',
          'collation' => 'A',
          'null' => false,
        ),
      ),
    ),
    'context' => 
    array (
      'alias' => 'context',
      'primary' => false,
      'unique' => false,
      'type' => 'BTREE',
      'columns' => 
      array (
        'context' => 
        array (
          'length' => '',
          'collation' => 'A',
          'null' => false,
        ),
      ),
    ),
  ),
  'composites' => 
  array (
    'Dictionary' => 
    array (
      'class' => 'XlexiconDictionary',
      'local' => 'iso_code',
      'foreign' => 'language',
      'cardinality' => 'many',
      'owner' => 'local',
    ),
    'Setting' => 
    array (
      'class' => 'XlexiconSetting',
      'local' => 'id',
      'foreign' => 'lang_key',
      'cardinality' => 'many',
      'owner' => 'local',
    ),
  ),
);
