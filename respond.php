<?php

/**
 * ECTouch_gpl Open Source Project
 * ============================================================================
 * Copyright (c) 2012-2014 http://ectouch_gpl.cn All rights reserved.
 * ----------------------------------------------------------------------------
 * 文件名称：respond.php
 * ----------------------------------------------------------------------------
 * 功能描述：支付接口通知文件
 * ----------------------------------------------------------------------------
 * Licensed ( http://www.ectouch_gpl.cn/docs/license.txt )
 * ----------------------------------------------------------------------------
 */


/* 访问控制 */
define('IN_ECTOUCH_GPL', true);
if(!isset($_REQUEST['code'])){
    header('location: ./index.php?'.$_SERVER['QUERY_STRING']);
    exit;
}
define('CONTROLLER_NAME', 'Respond');
/* 加载核心文件 */
require ('include/EcTouch.php');
