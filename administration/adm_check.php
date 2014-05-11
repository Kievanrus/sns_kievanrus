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

function checkAccess(){

	global $admin_dir;

$getScriptName=explode('/',$_SERVER['SCRIPT_NAME']);

  if($_SERVER['SCRIPT_NAME'] == '/'.$admin_dir.'/settings.php'){

$case=1;

    $url=str_replace('/'.$admin_dir.'/', '{siteAdminUrl}', $_SERVER['REQUEST_URI']);
    $rSett = "SELECT `access` FROM `sys_menu_admin` WHERE `url` = '{$url}'";
  }

else

if(isset($_GET['r'])) {
$case=2;

$getR=explode('/',$_GET['r']);
    $url='r='.$getR[0].'/'.$getR[1];

    $rSett = "SELECT `access` FROM `sys_menu_admin` WHERE `url` REGEXP '{$url}'";

}

else
if($getScriptName[1]=='modules'){
$case=3;
    $url='{siteUrl}'.substr($_SERVER['SCRIPT_NAME'],1);

    $rSett = "SELECT `access` FROM `sys_menu_admin` WHERE `url` = '{$url}'";

}

else
if($_SERVER['PHP_SELF']=='/'.$admin_dir.'/index.php'){
$case=4;

$name=$_GET['cat'];


    $rSett = "SELECT `access` FROM `sys_menu_admin` WHERE `name` = '$name'";

}
else
{

$case=5;

    $url=str_replace('/'.$admin_dir.'/', '{siteAdminUrl}', $_SERVER['SCRIPT_NAME']);

    $rSett = "SELECT `access` FROM `sys_menu_admin` WHERE `url` = '{$url}'";
}


  $rResult=MYSQL_QUERY($rSett);

// print $case.' - '.$rSett.'<br>allowed: '.mysql_result($rResult,0,'access').'<br>logged: '.$logged['admin'].'<br>numrows = '.mysql_numrows($rResult);

$logged['admin'] = $_COOKIE['memberID'];

  if(mysql_numrows($rResult)>0) {



    $dbaccess=mysql_result($rResult,0,'access');

 $access=split(',',$dbaccess);

// print_r($_SERVER);




$allowAccess=0;

	  if(($_SERVER['SCRIPT_NAME']!='/'.$admin_dir.'/add_admins.php')&&($_SERVER['REQUEST_URI']!='/'.$admin_dir.'/index.php')
&&($_SERVER['REQUEST_URI']!='/'.$admin_dir.'/')) {
// print $_SERVER['REQUEST_URI'];
	  if(!empty($access))
	      if(is_array($access))  {if(!in_array($logged['admin'],$access)) $allowAccess=0; else {$allowAccess=1;} }
	  else
	      {if($logged['admin'] != $access) $allowAccess=0; else {$allowAccess=1;}}

	  if($allowAccess==0)
	  {

	  die(_t('_adm_no_access').'<br><br> <input type="button" value="Back to previous page" onclick="history.back();">
	  </center>');

      }
}
}
else

if((($_SERVER['SCRIPT_NAME']=='/'.$admin_dir.'/add_admins.php')||($_SERVER['SCRIPT_NAME']=='/'.$admin_dir.'/menu_compose_admin.php'))&&($logged['admin']!=1))   die(_t('_adm_no_access').'<br><br> <input type="button" value="Back to previous page" onclick="history.back();">	  </center>');



}




?>
