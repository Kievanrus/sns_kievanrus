<?php
/**
 * Copyright (c) BoonEx Pty Limited - http://www.boonex.com/
 * CC-BY License - http://creativecommons.org/licenses/by/3.0/
 */

//  mail sending class

class BxMail extends Mistake
{
    var $_sSenderName = 'Orca Forum';

    /**
     * send mail with password
     * @param $p	email template variables to replace
     */
    function sendActivationMail (&$p)
    {
        global $gConf;

        $subj = "Forum Registration Details";

        $mailContent = <<<EOF

<p>Dear {username},</p>

<p>
Your username: {username} <br />
Your password: {pwd} <br />
Site URL: {site_url} <br />
</p>

<p>
Thank you for joining.
</p>
<p>
Best Regards, Forum.
</p>

EOF;

        $p['site_url'] = $gConf['url']['base'];
        for (reset ($p) ; list ($k, $v) = each ($p); ) {
            $mailContent = str_replace ('{'.$k.'}', $v, $mailContent);
        }

        $headers = "From: =?UTF-8?B?" . base64_encode($gConf['def_title']) . "?= <" . $gConf['email']['sender'] . ">\r\nContent-type: text/html; charset=UTF-8\r\n";
        $subj = '=?UTF-8?B?' . base64_encode($subj) . '?=';
        return mail ($p['email'], $subj, $mailContent, $headers, '-f'.$gConf['email']['sender']);
    }

}
