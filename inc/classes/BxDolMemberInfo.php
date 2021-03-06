<?php
/**
 * Copyright (c) BoonEx Pty Limited - http://www.boonex.com/
 * CC-BY License - http://creativecommons.org/licenses/by/3.0/
 */

bx_import('BxDolMemberInfoQuery');

/**
 * @page objects
 * @section member_info Member Info
 * @ref BxDolMemberInfo
 */

/**
 * Member info objects.
 */
class BxDolMemberInfo extends BxDolMistake
{
    protected $_sObject;
    protected $_aObject;

    /**
     * Constructor
     * @param $aObject array of member info options
     */
    public function __construct($aObject)
    {
        parent::__construct();

        $this->_sObject = $aObject['object'];
        $this->_aObject = $aObject;
    }

    /**
     * Get object instance by object name
     * @param $sObject object name
     * @return object instance or false on error
     */
    static public function getObjectInstance($sObject)
    {
        if (isset($GLOBALS['bxDolClasses']['BxDolMemberInfo!'.$sObject]))
            return $GLOBALS['bxDolClasses']['BxDolMemberInfo!'.$sObject];

        $aObject = BxDolMemberInfoQuery::getMemberInfoObject($sObject);
        if (!$aObject || !is_array($aObject))
            return false;

        $sClass = 'BxDolMemberInfo';
        if (!empty($aObject['override_class_name'])) {
            $sClass = $aObject['override_class_name'];
            if (!empty($aObject['override_class_file']))
                require_once(BX_DIRECTORY_PATH_ROOT . $aObject['override_class_file']);
            else
                bx_import($sClass);
        }

        $o = new $sClass($aObject);

        return ($GLOBALS['bxDolClasses']['BxDolMemberInfo!'.$sObject] = $o);
    }

    /**
     * Get member info
     */
    public function get ($aData)
    {
        switch ($this->_sObject) {

        case 'sys_username':
            return $aData['NickName'];

        case 'sys_first_name':
            return $aData['FirstName'] ? $aData['FirstName'] : $aData['NickName'];

        case 'sys_first_name_last_name':
            return $aData['FirstName'] || $aData['LastName'] ? $aData['FirstName'] . ' ' . $aData['LastName'] : $aData['NickName'];

        case 'sys_last_name_firs_name':
            return $aData['FirstName'] || $aData['LastName'] ? $aData['LastName'] . ' ' . $aData['FirstName'] : $aData['NickName'];

        case 'sys_headline':
            return $aData['Headline'];

        case 'sys_status_message':
            return $aData['UserStatusMessage'];

        case 'sys_age_sex':
            $s = ('0000-00-00' == $aData['DateOfBirth'] ? '' :  _t('_y/o', age($aData['DateOfBirth'])) . ' ') . _t('_' . $aData['Sex']);
            if ($aData['Couple'] > 0) {
                $aData2 = getProfileInfo($aData['Couple']);
                $s .= '<br />' . ('0000-00-00' == $aData2['DateOfBirth'] ? '' :  _t('_y/o', age($aData2['DateOfBirth'])) . ' ') . _t('_' . $aData2['Sex']);
            }
            return $s;

        case 'sys_location':
            return (empty($aData['City']) ? '' : $aData['City'] . ', ') . _t($GLOBALS['aPreValues']['Country'][$aData['Country']]['LKey']);

        case 'sys_avatar':
            if (!$aData || !@include_once (BX_DIRECTORY_PATH_MODULES . 'boonex/avatar/include.php'))
                return false;
            return $aData['Avatar'] ? BX_AVA_URL_USER_AVATARS . $aData['Avatar'] . BX_AVA_EXT : $GLOBALS['oFunctions']->getSexPic($aData['Sex'], 'medium');

        case 'sys_avatar_icon':
            if (!$aData || !@include_once (BX_DIRECTORY_PATH_MODULES . 'boonex/avatar/include.php'))
                return false;
            return $aData['Avatar'] ? BX_AVA_URL_USER_AVATARS . $aData['Avatar'] . 'i' . BX_AVA_EXT : $GLOBALS['oFunctions']->getSexPic($aData['Sex'], 'small');
        }
    }

    public function isAvatarSearchAllowed ()
    {
        return true;
    }

    public function isSetAvatarFromDefaultAlbumOnly ()
    {
        return false;
    }
}
