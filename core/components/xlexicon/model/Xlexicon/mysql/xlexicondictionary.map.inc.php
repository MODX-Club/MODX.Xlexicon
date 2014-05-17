<?php
$xpdo_meta_map['XlexiconDictionary']= array (
  'package' => 'Xlexicon',
  'version' => '2.1',
  'table' => 'xlexicon_dictionaries',
  'extends' => 'xPDOSimpleObject',
  'fields' => 
  array (
    'res' => NULL,
    'language' => NULL,
    'pagetitle' => NULL,
    'longtitle' => NULL,
    'menutitle' => NULL,
    'published' => 0,
    'description' => NULL,
    'introtext' => NULL,
    'content' => NULL,
    'uri' => NULL,
  ),
  'fieldMeta' => 
  array (
    'res' => 
    array (
      'dbtype' => 'int',
      'precision' => '11',
      'phptype' => 'integer',
      'null' => false,
      'index' => 'index',
    ),
    'language' => 
    array (
      'dbtype' => 'varchar',
      'precision' => '2',
      'phptype' => 'string',
      'null' => false,
    ),
    'pagetitle' => 
    array (
      'dbtype' => 'varchar',
      'precision' => '255',
      'phptype' => 'string',
      'null' => false,
      'index' => 'index',
    ),
    'longtitle' => 
    array (
      'dbtype' => 'varchar',
      'precision' => '255',
      'phptype' => 'string',
      'null' => false,
    ),
    'menutitle' => 
    array (
      'dbtype' => 'varchar',
      'precision' => '255',
      'phptype' => 'string',
      'null' => false,
    ),
    'published' => 
    array (
      'dbtype' => 'tinyint',
      'precision' => '1',
      'attributes' => 'unsigned',
      'phptype' => 'integer',
      'null' => false,
      'default' => 0,
    ),
    'description' => 
    array (
      'dbtype' => 'text',
      'phptype' => 'string',
      'null' => false,
    ),
    'introtext' => 
    array (
      'dbtype' => 'text',
      'phptype' => 'string',
      'null' => false,
    ),
    'content' => 
    array (
      'dbtype' => 'text',
      'phptype' => 'string',
      'null' => false,
    ),
    'uri' => 
    array (
      'dbtype' => 'text',
      'phptype' => 'string',
      'null' => true,
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
        'res' => 
        array (
          'length' => '',
          'collation' => 'A',
          'null' => false,
        ),
        'language' => 
        array (
          'length' => '',
          'collation' => 'A',
          'null' => false,
        ),
      ),
    ),
    'content_ft_idx' => 
    array (
      'alias' => 'content_ft_idx',
      'primary' => false,
      'unique' => false,
      'type' => 'FULLTEXT',
      'columns' => 
      array (
        'pagetitle' => 
        array (
          'length' => '',
          'collation' => '',
          'null' => false,
        ),
        'longtitle' => 
        array (
          'length' => '',
          'collation' => '',
          'null' => false,
        ),
        'menutitle' => 
        array (
          'length' => '',
          'collation' => '',
          'null' => false,
        ),
        'description' => 
        array (
          'length' => '',
          'collation' => '',
          'null' => false,
        ),
        'introtext' => 
        array (
          'length' => '',
          'collation' => '',
          'null' => false,
        ),
        'content' => 
        array (
          'length' => '',
          'collation' => '',
          'null' => false,
        ),
      ),
    ),
  ),
  'aggregates' => 
  array (
    'Resource' => 
    array (
      'class' => 'modResource',
      'local' => 'res',
      'foreign' => 'id',
      'cardinality' => 'one',
      'owner' => 'foreign',
    ),
    'Language' => 
    array (
      'class' => 'XlexiconLanguage',
      'local' => 'language',
      'foreign' => 'iso_code',
      'cardinality' => 'one',
      'owner' => 'foreign',
    ),
  ),
);
