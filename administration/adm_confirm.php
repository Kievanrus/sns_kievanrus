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

$_page_cont[$iNameIndex]['page_main_code'] = "

<style>

td.buttons{
  text-align:center;
  padding:10px;
}

button, .aac_inp{
  border:solid 1px #BCBCBC !important;
  background:#ffffff;
}
</style>

<script>
  function remove_admin(){

      if(document.getElementById('word').value=='remove') {

	alert('"._t('_adm_has_been_removed')."');
	document.location.replace('add_admins.php?remove_admin_confirmed={$_GET['remove_admin']}');

      }
      else
      {
	alert('"._t('_adm_incorrect_word')."');
      }

    }
</script>

<center>
  <table border=0>
  <tr>
    <td class='buttons'>"._t('_adm_enter_to_confirm')." <input id='word' type='text' name='confirm_rem' class='aac_inp'> </td>
  </tr>
  <tr>
    <td class='buttons'>
	<button onclick='remove_admin()'>"._t('_adm_remove')."</button>
	<button onclick='document.location.replace(\"add_admins.php\")'>"._t('_adm_cancel')."</button>
    </td>
  </tr>
  </table>
</center>

";


PageCodeAdmin();

?>