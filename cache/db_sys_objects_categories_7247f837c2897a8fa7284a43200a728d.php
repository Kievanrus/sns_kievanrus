<?php $mixedData=array (
  'bx_articles' => 
  array (
    'ID' => '1',
    'ObjectName' => 'bx_articles',
    'Query' => 'SELECT `categories` FROM `bx_arl_entries` WHERE `id`=\'{iID}\' AND `status`=\'0\'',
    'PermalinkParam' => 'permalinks_module_articles',
    'EnabledPermalink' => 'm/articles/category/{tag}',
    'DisabledPermalink' => 'modules/?r=articles/category/{tag}',
    'LangKey' => '_articles_lcaption_categories',
  ),
  'bx_files' => 
  array (
    'ID' => '2',
    'ObjectName' => 'bx_files',
    'Query' => 'SELECT `Categories` FROM `bx_files_main` WHERE `ID`  = {iID} AND `Status` = \'approved\'',
    'PermalinkParam' => 'bx_files_permalinks',
    'EnabledPermalink' => 'm/files/browse/category/{tag}',
    'DisabledPermalink' => 'modules/?r=files/files/category/{tag}',
    'LangKey' => '_bx_files',
  ),
  'bx_groups' => 
  array (
    'ID' => '3',
    'ObjectName' => 'bx_groups',
    'Query' => 'SELECT `Categories` FROM `bx_groups_main` WHERE `id` = {iID} AND `status` = \'approved\'',
    'PermalinkParam' => 'bx_groups_permalinks',
    'EnabledPermalink' => 'm/groups/browse/category/{tag}',
    'DisabledPermalink' => 'modules/?r=groups/browse/category/{tag}',
    'LangKey' => '_bx_groups',
  ),
  'bx_photos' => 
  array (
    'ID' => '4',
    'ObjectName' => 'bx_photos',
    'Query' => 'SELECT `Categories` FROM `bx_photos_main` WHERE `ID`  = {iID} AND `Status` = \'approved\'',
    'PermalinkParam' => 'bx_photos_permalinks',
    'EnabledPermalink' => 'm/photos/browse/category/{tag}',
    'DisabledPermalink' => 'modules/?r=photos/browse/category/{tag}',
    'LangKey' => '_bx_photos',
  ),
); ?>