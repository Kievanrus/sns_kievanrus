<?php $mixedData=array (
  'all' => 
  array (
    'capt' => 'Members',
    'query' => 'SELECT COUNT(`ID`) FROM `Profiles` WHERE `Status`=\'Active\' AND (`Couple`=\'0\' OR `Couple`>`ID`)',
    'link' => 'browse.php',
    'icon' => 'user',
    'adm_query' => 'SELECT COUNT(`ID`) FROM `Profiles` WHERE `Status`=\'Approval\' AND (`Couple`=\'0\' OR `Couple`>`ID`)',
    'adm_link' => '{admin_url}profiles.php?action=browse&by=status&value=approval',
  ),
  'arl' => 
  array (
    'capt' => 'articles_ss',
    'query' => 'SELECT COUNT(`ID`) FROM `bx_arl_entries` WHERE `status`=\'0\'',
    'link' => 'm/articles/archive/',
    'icon' => 'file',
    'adm_query' => 'SELECT COUNT(`ID`) FROM `bx_arl_entries` WHERE `status`=\'1\'',
    'adm_link' => 'm/articles/admin/',
  ),
  'shf' => 
  array (
    'capt' => 'bx_files',
    'query' => 'SELECT COUNT(`ID`) FROM `bx_files_main` WHERE `Status`=\'approved\'',
    'link' => 'm/files/browse/all',
    'icon' => 'save',
    'adm_query' => 'SELECT COUNT(*) FROM `bx_files_main` as a left JOIN `sys_albums_objects` as b ON b.`id_object`=a.`ID` left JOIN `sys_albums` as c ON c.`ID`=b.`id_album` WHERE a.`Status` =\'pending\' AND c.`AllowAlbumView` NOT IN(8) AND c.`Type`=\'bx_files\'',
    'adm_link' => 'm/files/administration/home/pending',
  ),
  'tps' => 
  array (
    'capt' => 'bx_forum_discussions',
    'query' => 'SELECT IF( NOT ISNULL( SUM(`forum_topics`)), SUM(`forum_posts`), 0) AS `Num` FROM `bx_forum`',
    'link' => 'forum/',
    'icon' => 'comments',
    'adm_query' => '',
    'adm_link' => '',
  ),
  'bx_groups' => 
  array (
    'capt' => 'bx_groups',
    'query' => 'SELECT COUNT(`id`) FROM `bx_groups_main` WHERE `status`=\'approved\'',
    'link' => 'm/groups/browse/recent',
    'icon' => 'group',
    'adm_query' => 'SELECT COUNT(`id`) FROM `bx_groups_main` WHERE `status`=\'pending\'',
    'adm_link' => 'm/groups/administration',
  ),
  'phs' => 
  array (
    'capt' => 'bx_photos',
    'query' => 'SELECT COUNT(`ID`) FROM `bx_photos_main` WHERE `Status`=\'approved\'',
    'link' => 'm/photos/browse/all',
    'icon' => 'picture',
    'adm_query' => 'SELECT COUNT(*) FROM `bx_photos_main` as a left JOIN `sys_albums_objects` as b ON b.`id_object`=a.`ID` left JOIN `sys_albums` as c ON c.`ID`=b.`id_album` WHERE a.`Status` =\'pending\' AND c.`AllowAlbumView` NOT IN(8) AND c.`Type`=\'bx_photos\'',
    'adm_link' => 'm/photos/administration/home/pending',
  ),
); ?>