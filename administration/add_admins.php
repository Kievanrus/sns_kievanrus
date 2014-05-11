<?php
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

require_once( '../inc/header.inc.php' );
require_once( BX_DIRECTORY_PATH_INC . 'design.inc.php' );
require_once( BX_DIRECTORY_PATH_INC . 'admin_design.inc.php' );
require_once( BX_DIRECTORY_PATH_INC . 'admin.inc.php' );

$logged['admin'] = member_auth( 1, true, true );

$rSett="SELECT `access` FROM `sys_menu_admin` WHERE `url` = '{siteAdminUrl}admin_access.php'";
  $rResult=MYSQL_QUERY($rSett);
  if(mysql_numrows($rResult)) $access=split(',',mysql_result($rResult,0,'access'));

if(!in_array($logged['admin'],$access)) die('Sorrry, you have no access to this page');

$_page = array(
    'name_index' => $iNameIndex,
    'header' => _t('_admin_access'),
    'header_text' => _t('_admin_access')
);
/************************/

$error='';

/*************** Remove admin ***************/
if(isset($_GET['remove_admin_confirmed'])) {

$remove_admin_confirmed=$_GET['remove_admin_confirmed'];

//   MYSQL_QUERY("DELETE FROM `Profiles` WHERE `ID`='$remove_admin_confirmed'");
  MYSQL_QUERY("UPDATE `Profiles` SET `Role`=1 WHERE `ID`='$remove_admin_confirmed'");

  $error=mysql_error();

$rSett=MYSQL_QUERY("SELECT `id`,`access` FROM `sys_menu_admin`");

  while ($aSett = mysql_fetch_assoc($rSett)){

      $rAccessArray=explode(',',$aSett['access']);

      if(in_array($remove_admin_confirmed,$rAccessArray)) {

      for($i=0;$i<count($rAccessArray);$i++){

      if($rAccessArray[$i]==$remove_admin_confirmed) {unset($rAccessArray[$i]); break;}

	}
$rAccessArrayOut=implode(',',$rAccessArray);

$rSettSave=MYSQL_QUERY("UPDATE `sys_menu_admin` SET `access`='$rAccessArrayOut' WHERE `id`='{$aSett['id']}'");
      }
}
}


/*************** Add admin ***************/

if(isset($_POST['admin_name'])) {

$iName=str_replace(' ','',$_POST['admin_name']);
$iPassword=str_replace(' ','',$_POST['admin_password']);

$aName='';
$aPass='';

if((empty($iName)) || (empty($iPassword))) $error='Entered name or password is empty';
  else
    if(mysql_num_rows(MYSQL_QUERY("SELECT `ID` FROM `Profiles` WHERE `NickName`='{$_POST['admin_name']}'"))>0) {

	$error='Entered login already exist';
	$aName=$_POST['admin_name'];
	$aPass=$_POST['admin_password'];
  }
    else
  {
  $salt = base64_encode(substr(md5(microtime()), 2, 6));
		  $iNewPassword = sha1(md5($iPassword) . $salt);

    MYSQL_QUERY("INSERT INTO `Profiles` (`NickName`,`Password`,`Salt`,`Role`,`Status`) VALUES ('$iName', '$iNewPassword','$salt','3','Active')");

    $error=mysql_error();
  }

}

/*************** Show admins ***************/

$admins_ddmenu='';
$aAdmins = $GLOBALS['MySQL']->getAll("SELECT `ID`, `NickName` FROM `Profiles` WHERE `Role`='3'" );

    	foreach($aAdmins as $aAdminItem) {
	$admins_ddmenu.="<tr><td class='bord_btm td_center'>{$aAdminItem['ID']}</td><td class='bord_btm'><a href='../pedit.php?ID={$aAdminItem['ID']}'>{$aAdminItem['NickName']}</a></td><td class='bord_btm td_center last'>";

if($aAdminItem['ID']!=1)
    $admins_ddmenu.="<a href='adm_confirm.php?remove_admin={$aAdminItem['ID']}'>x</a>";
      else
    $admins_ddmenu.="<font class='gray'>"._t('_adm_main_admin').'</font>';

 $admins_ddmenu.="</td>";


}



/*************** Page code ***************/

$_page_cont[$iNameIndex]['page_main_code'] = "
<style>

font.gray{
  color:#aaaaaa;
}

td.last{
  width:200px;
}

.td_center{
  text-align:center;
}

.main_header{
  font-size:13px;
  text-align:center;
  background-color:#eaeaea;
}

.main_titles{
  font-size:13px;
  font-weight:bold;
}

.sub_titles{
  font-size:13px;
  font-weight:normal;
}

.bord_btm{
  border-bottom:solid 1px #bababa;
}

.aaheaderf{
  width:70%;
}

.tabheader{
  position:relative;
  background-color:#eaeaea;
}

input{
  border:solid 1px #BCBCBC !important;
  background:#ffffff;
}
.adm_center{
  text-align:center;
}

.aas_field{
  padding-left:50px;
}
</style>

<table border=0 width=100% class='tabheader'>
<tr>
  <td class='aaheaderf'></td>
  <td class='aaheader'><a href='add_admins.php'>"._t('_admin_accounts')."</a></td>
  <td class='aaheader'><a href='admin_access.php'>"._t('_adm_acc_access')."</a></td>
</tr>
</table>

&nbsp;
<center>
<form method=POST action='add_admins.php'>
<table border=0>
<tr>
  <td class='sub_titles adm_center tabheader' colspan=3>"._t('_adm_add')."</td>
</tr>
<tr>
  <td class='sub_titles adm_center tabheader' colspan=3>$error</td>
</tr>

<tr>
  <td class='sub_titles'>"._t('_Login').": <input type='text' name='admin_name' class='aac_inp' value='$aName'></td>
  <td class='sub_titles aas_field'>"._t('_Password').": <input type='text' name='admin_password' class='aac_inp' value='$aPass'></td>
</tr>
<tr>
  <td class='sub_titles adm_center' colspan=3><input type='submit' value='"._t('_add')."'></td>
</tr>
</table>
</form>
</center>

<table width=100% border=0>

<tr><td class='bord_btm main_header'>ID</td><td class='bord_btm main_header'>"._t('_adm_admin_nick')."</td><td class='bord_btm main_header'>"._t('_adm_remove')."</td></tr>

  $admins_ddmenu

</table>


";


PageCodeAdmin();
?>