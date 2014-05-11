<?php $mixedData=array (
  'alerts' => 
  array (
    'system' => 
    array (
      'begin' => 
      array (
        0 => '1',
      ),
    ),
    'profile' => 
    array (
      'before_join' => 
      array (
        0 => '2',
      ),
      'join' => 
      array (
        0 => '2',
        1 => '3',
        2 => '4',
      ),
      'before_login' => 
      array (
        0 => '2',
      ),
      'login' => 
      array (
        0 => '2',
      ),
      'logout' => 
      array (
        0 => '2',
      ),
      'edit' => 
      array (
        0 => '2',
        1 => '3',
        2 => '4',
        3 => '13',
      ),
      'delete' => 
      array (
        0 => '3',
        1 => '4',
        2 => '6',
        3 => '7',
        4 => '9',
        5 => '12',
        6 => '13',
      ),
      'change_status' => 
      array (
        0 => '4',
      ),
      'commentRemoved' => 
      array (
        0 => '5',
      ),
      'edit_status_message' => 
      array (
        0 => '13',
      ),
      'commentPost' => 
      array (
        0 => '13',
      ),
    ),
    'bx_photos' => 
    array (
      'delete' => 
      array (
        0 => '10',
      ),
      'add' => 
      array (
        0 => '13',
      ),
      'commentPost' => 
      array (
        0 => '13',
      ),
    ),
    'bx_videos' => 
    array (
      'delete' => 
      array (
        0 => '10',
      ),
    ),
    'bx_sounds' => 
    array (
      'delete' => 
      array (
        0 => '10',
      ),
    ),
    'bx_files' => 
    array (
      'delete' => 
      array (
        0 => '10',
      ),
      'add' => 
      array (
        0 => '13',
      ),
      'commentPost' => 
      array (
        0 => '13',
      ),
    ),
    'module' => 
    array (
      'install' => 
      array (
        0 => '11',
      ),
    ),
    'friend' => 
    array (
      'accept' => 
      array (
        0 => '13',
      ),
    ),
    'bx_avatar' => 
    array (
      'add' => 
      array (
        0 => '13',
      ),
      'change' => 
      array (
        0 => '13',
      ),
    ),
    'bx_groups' => 
    array (
      'add' => 
      array (
        0 => '13',
      ),
      'commentPost' => 
      array (
        0 => '13',
      ),
    ),
  ),
  'handlers' => 
  array (
    1 => 
    array (
      'class' => 'BxDolAlertsResponseSystem',
      'file' => 'inc/classes/BxDolAlertsResponseSystem.php',
      'eval' => '',
    ),
    2 => 
    array (
      'class' => 'BxDolAlertsResponseProfile',
      'file' => 'inc/classes/BxDolAlertsResponseProfile.php',
      'eval' => '',
    ),
    3 => 
    array (
      'class' => 'BxDolUpdateMembersCache',
      'file' => 'inc/classes/BxDolUpdateMembersCache.php',
      'eval' => '',
    ),
    4 => 
    array (
      'class' => 'BxDolAlertsResponceMatch',
      'file' => 'inc/classes/BxDolAlertsResponceMatch.php',
      'eval' => '',
    ),
    5 => 
    array (
      'class' => 'BxDolVideoDeleteResponse',
      'file' => 'flash/modules/video_comments/inc/classes/BxDolVideoDeleteResponse.php',
      'eval' => '',
    ),
    6 => 
    array (
      'class' => 'BxAvaProfileDeleteResponse',
      'file' => 'modules/boonex/avatar/classes/BxAvaProfileDeleteResponse.php',
      'eval' => '',
    ),
    7 => 
    array (
      'class' => '',
      'file' => '',
      'eval' => 'BxDolService::call(\'files\', \'response_profile_delete\', array($this));',
    ),
    8 => 
    array (
      'class' => 'BxForumProfileResponse',
      'file' => 'modules/boonex/forum/profile_response.php',
      'eval' => '',
    ),
    9 => 
    array (
      'class' => '',
      'file' => '',
      'eval' => 'BxDolService::call(\'groups\', \'response_profile_delete\', array($this));',
    ),
    10 => 
    array (
      'class' => '',
      'file' => '',
      'eval' => 'BxDolService::call(\'groups\', \'response_media_delete\', array($this));',
    ),
    11 => 
    array (
      'class' => '',
      'file' => '',
      'eval' => 'if (\'wmap\' == $this->aExtras[\'uri\'] && $this->aExtras[\'res\'][\'result\']) BxDolService::call(\'groups\', \'map_install\');',
    ),
    12 => 
    array (
      'class' => '',
      'file' => '',
      'eval' => 'BxDolService::call(\'photos\', \'response_profile_delete\', array($this));',
    ),
    13 => 
    array (
      'class' => '',
      'file' => '',
      'eval' => 'BxDolService::call(\'wall\', \'response\', array($this));',
    ),
  ),
); ?>