<?php

$properties = array(
  array(
    'name' => 'tpl',
    'desc' => 'prop_xlexicon.tpl_desc',
    'type' => 'textfield',
    'options' => '',
    'value' => 'rowTpl',
    'lexicon' => 'xlexicon:properties',
  ),
  array(
    'name' => 'sort',
    'desc' => 'prop_xlexicon.sort_desc',
    'type' => 'textfield',
    'options' => '',
    'value' => 'name',
    'lexicon' => 'xlexicon:properties',
  ),
  array(
    'name' => 'dir',
    'desc' => 'prop_xlexicon.dir_desc',
    'type' => 'list',
    'options' => array(
      array('text' => 'prop_xlexicon.ascending','value' => 'ASC'),
      array('text' => 'prop_xlexicon.descending','value' => 'DESC'),
    ),
    'value' => 'DESC',
    'lexicon' => 'xlexicon:properties',
  ),
);
return $properties;