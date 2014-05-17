<?php
$xpdo_meta_map['XlexiconSetting']= array (
  'package' => 'Xlexicon',
  'version' => '1.1',
  'table' => 'xlexicon_settings',
  'extends' => 'xPDOSimpleObject',
  'fields' => 
  array (
    'lang_key' => NULL,
    'key' => NULL,
    'value' => NULL,
    'xtype' => 'textfield',
    'namespace' => 'core',
    'area' => '',
    'editedon' => '0000-00-00 00:00:00',
    'context' => 'web',
  ),
  'fieldMeta' => 
  array (
    'lang_key' => 
    array (
      'dbtype' => 'int',
      'precision' => '10',
      'phptype' => 'integer',
      'null' => false,
      'index' => 'index',
    ),
    'key' => 
    array (
      'dbtype' => 'varchar',
      'precision' => '50',
      'phptype' => 'string',
      'null' => false,
    ),
    'value' => 
    array (
      'dbtype' => 'mediumtext',
      'phptype' => 'string',
      'null' => true,
    ),
    'xtype' => 
    array (
      'dbtype' => 'varchar',
      'precision' => '75',
      'phptype' => 'string',
      'null' => false,
      'default' => 'textfield',
    ),
    'namespace' => 
    array (
      'dbtype' => 'varchar',
      'precision' => '40',
      'phptype' => 'string',
      'null' => false,
      'default' => 'core',
    ),
    'area' => 
    array (
      'dbtype' => 'varchar',
      'precision' => '255',
      'phptype' => 'string',
      'null' => false,
      'default' => '',
    ),
    'editedon' => 
    array (
      'dbtype' => 'timestamp',
      'phptype' => 'timestamp',
      'null' => false,
      'default' => '0000-00-00 00:00:00',
      'extra' => 'on update current_timestamp',
    ),
    'context' => 
    array (
      'dbtype' => 'varchar',
      'precision' => '100',
      'phptype' => 'string',
      'null' => false,
      'default' => 'web',
    ),
  ),
  'indexes' => 
  array (
    'unique_entity' => 
    array (
      'alias' => 'unique_entity',
      'primary' => false,
      'unique' => true,
      'type' => 'BTREE',
      'columns' => 
      array (
        'lang_key' => 
        array (
          'length' => '',
          'collation' => 'A',
          'null' => false,
        ),
        'key' => 
        array (
          'length' => '',
          'collation' => 'A',
          'null' => false,
        ),
        'context' => 
        array (
          'length' => '',
          'collation' => 'A',
          'null' => false,
        ),
      ),
    ),
  ),
  'aggregates' => 
  array (
    'Language' => 
    array (
      'class' => 'XlexiconLanguage',
      'local' => 'lang_key',
      'foreign' => 'id',
      'cardinality' => 'one',
      'owner' => 'foreign',
    ),
  ),
);
