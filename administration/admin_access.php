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

$_page = array(
    'name_index' => $iNameIndex,
    'header' => _t('_admin_access'),
    'header_text' => _t('_admin_access')
);
/************************/
if($_GET['edit_admin'])
$edit_admin=$_GET['edit_admin'];

if($_POST['save_settings'])
$edit_admin=$_POST['save_settings'];

if(isset($_POST['save_settings'])) {

$rSett=MYSQL_QUERY("SELECT `id`,`access` FROM `sys_menu_admin`");

  while ($aSett = mysql_fetch_assoc($rSett)){

      $rAccessArray=explode(',',$aSett['access']);

if($_POST[$aSett['id']]=='on') {
      if(!in_array($_POST['save_settings'],$rAccessArray)) {

$rAccessArray[]=$edit_admin;

      }

    }
    else
    {

      if(in_array($_POST['save_settings'],$rAccessArray)) {

      for($i=0;$i<count($rAccessArray);$i++){

      if($rAccessArray[$i]==$edit_admin) {unset($rAccessArray[$i]); break;}

	}

      }

    }
$rAccessArrayOut=implode(',',$rAccessArray);
// print '$rAccessArrayOut: '.$aSett['id'].' -- '.$rAccessArrayOut.'<br>';
$rSettSave=MYSQL_QUERY("UPDATE `sys_menu_admin` SET `access`='$rAccessArrayOut' WHERE `id`='{$aSett['id']}'");
  }

}

$aMenu = $GLOBALS['MySQL']->getAll("SELECT `id`, `name`, `title`, `url`, `icon`,`access` FROM `sys_menu_admin` WHERE `parent_id`='0' AND `url`!='{siteAdminUrl}admin_access.php' ORDER BY `order`" );
$iSub=0;
    	foreach($aMenu as $aMenuItem) {


$mArray=explode(',',$aMenuItem['access']);
if(in_array($edit_admin,$mArray)) $mChecked='checked=checked'; else $mChecked='';

	    $titles.='<tr><td class="bord_btm main_titles"><div class="adm-design-box"><img src="'.$oAdmTemplate->getIconUrl($aMenuItem['icon']).'"> <span class="span_main">'._t($aMenuItem['title']).'</span></div></td><td class="bord_btm td_center">
	      <input '.$mChecked.' type="checkbox" name="'.$aMenuItem['id'].'"  onClick="checkbox('.$aMenuItem['id'].')"></td></tr>';

    		$aSubmenu = $GLOBALS['MySQL']->getAll("SELECT `id`, `name`, `title`, `url`, `icon`,`access` FROM `sys_menu_admin` WHERE `parent_id`='" . $aMenuItem['id'] . "' ORDER BY `order`");

    		foreach($aSubmenu as $aSubmenuItem) {
$iSub++;
$sArray=explode(',',$aSubmenuItem['access']);
if(in_array($edit_admin,$sArray)) $sChecked='checked=checked'; else $sChecked='';

$titles.='<tr><td class="bord_btm sub_titles"> <img src="'.$oAdmTemplate->getIconUrl($aSubmenuItem['icon']).'"> <span class="span_subs">'._t($aSubmenuItem['title']).'</span></td>
<td class="bord_btm td_center"><input '.$sChecked.' id="'.$aMenuItem['id'].'-'.$iSub.'" name="'.$aSubmenuItem['id'].'" type="checkbox" onClick="checkbox(\'sub\',0)"></td></tr>';

    		}
    	}

$admins_ddmenu="<select id='admins_select' name='admins' onChange='document.location.replace(\"admin_access.php?edit_admin=\"+document.getElementById(\"admins_select\").value)'>";
$admins_ddmenu.="<option value='0'>"._t('_adm_select_admin')."</option>";

$aAdmins = $GLOBALS['MySQL']->getAll("SELECT `ID`, `NickName` FROM `Profiles` WHERE `Role`='3'" );

foreach($aAdmins as $aAdminItem) {

  if($aAdminItem['ID']!=1){   // to not show main admin in the list with ID=1

  if($edit_admin==$aAdminItem['ID']) $selected='selected=selected'; else $selected='';
	  $admins_ddmenu.="<option value='{$aAdminItem['ID']}' $selected>{$aAdminItem['NickName']}</option>";

  }

}
$admins_ddmenu.="</select>";

/************************/
$_page_cont[$iNameIndex]['page_main_code'] = "
<style>

div.adm-design-box{
  border:none !important;
}

span.span_subs{
  position: relative;
  bottom: 3px;
}

span.span_main{
  position: relative;
  bottom: 10px;
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
  padding: 5px;
}

.bord_btm{
  border-bottom:solid 1px #bababa;
}

.aaheaderf{
  width:70%;
}
select, button, .aac_inp{
  border:solid 1px #BCBCBC !important;
  background:#ffffff;
}

.tabheader{
  position:relative;
  background-color:#eaeaea;
}
</style>

<script type='text/javascript'>

function checkbox(main){


for (i=0; i<5; i++){
  if (document.getElementById(main+'-'+i).checked==true)
  alert('Checkbox at index '+main+'-'+i+' is checked!');
}


}
/*
function change_all(checkbox){

for (i=0; i<document.admin_access_form.checkbox.length; i++){

document.admin_access_form.checkbox.checked == false;

 }
}*/


</script>

<table border=0 width=100% class='tabheader'>
<tr>
  <td class='aaheaderf'></td>
  <td class='aaheader'><a href='add_admins.php'>"._t('_admin_accounts')."</a></td>
  <td class='aaheader'><a href='admin_access.php'>"._t('_adm_acc_access')."</a></td>
</tr>
</table>

<table width=100% border=0>

  <tr><td class='bord_btm main_header' colspan=2>"._t('_adm_sel_admin')." $admins_ddmenu</td></tr>
</table>
";
/************************/

if((!empty($edit_admin))||($edit_admin!=0))
$_page_cont[$iNameIndex]['page_main_code'].= "
<table width=100% border=0>
<form method='POST' action='admin_access.php' name='admin_access_form'>
  <input type='hidden' name='save_settings' value='$edit_admin'>
  <tr><td class='bord_btm main_header'>"._t('_adm_access_title')."</td><td class='bord_btm main_header'>"._t('_adm_access_access')."</td></tr>

  $titles

<tr><td class='bord_btm td_center' colspan=2><input type='submit' value='"._t('_adm_save')."'></td></tr>

</form>
</table>
";

PageCodeAdmin();
?>