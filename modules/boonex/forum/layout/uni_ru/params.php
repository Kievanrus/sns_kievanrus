<?php
    if( isset($_REQUEST['gConf']) ) die; // globals hack prevention
    require_once ($gConf['dir']['layouts'] . 'base_ru/params.php');

    $gConf['dir']['xsl'] = $gConf['dir']['layouts'] . 'uni_ru/xsl/';	// xsl dir

    $gConf['url']['css'] = $gConf['url']['layouts'] . 'uni_ru/css/';	// css url
    $gConf['url']['xsl'] = $gConf['url']['layouts'] . 'uni_ru/xsl/';	// xsl url
