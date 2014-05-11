<?
/*************************Product owner info********************************
*
*     author               : Boonexpert
*     contact info         : boonexpert@gmail.com
*
/*************************Product info**************************************
*
*                          Multi Admin Access
*                          ------------------------
*     version              : 1.2
*     date		   : August, 2, 2012
*     compability          : Dolphin 7.0.0 - 7.0.x
*     License type         : Custom
*
* IMPORTANT: This is a commercial product made by Boonexpert and cannot be modified for other than personal use.
* This product cannot be redistributed for free or a fee without written permission from Boonexpert.
*
*     Upgrade possibilities : All future upgrades will be added to this product package
*
****************************************************************************/

$aConfig = array(

	'title' => '<font color="red">Multiadmin access</font>',
	'version' => '1.1',
	'vendor' => 'Boonexpert',
	'update_url' => '',

	'compatible_with' => array(
        '7.x.x'
    ),

    /**
	 * 'home_dir' and 'home_uri' - should be unique. Don't use spaces in 'home_uri' and the other special chars.
	 */
	  'home_dir' => 'boonexpert/multiadmin/',
	  'home_uri' => 'multiadmin',
	  'db_prefix' => 'multiadminaccess_',
	  'class_prefix' => 'Aa',

	  'home_dir' => 'boonexpert/multiadmin/',
	  'home_uri' => 'multiadmin',

	'install' => array(
	  'update_languages' => 1,
	  'execute_sql' => 1,
	  'recompile_permalinks' => 1,
	),

	'uninstall' => array (
	  'update_languages' => 1,
	  'execute_sql' => 1,
	  'recompile_permalinks' => 1,
	),

	  'language_category' => 'Multiadmin',

	  'install_permissions' => array(),
	  'uninstall_permissions' => array(),

	'install_info' => array(
		'introduction' => '',
		'conclusion' => ''
	),
	'uninstall_info' => array(
		'introduction' => '',
		'conclusion' => ''
	)
);

?>
