<?php

/**
 * ECTouch_gpl Open Source Project
 * ============================================================================
 * Copyright (c) 2012-2014 http://ectouch_gpl.cn All rights reserved.
 * ----------------------------------------------------------------------------
 * 文件名称：bank.php
 * ----------------------------------------------------------------------------
 * 功能描述：银行汇款（转账）插件
 * ----------------------------------------------------------------------------
 * Licensed ( http://www.ectouch_gpl.cn/docs/license.txt )
 * ----------------------------------------------------------------------------
 */

/* 访问控制 */
defined('IN_ECTOUCH_GPL') or die('Deny Access');

$payment_lang = ROOT_PATH . 'plugins/payment/language/' . C('lang') . '/' . basename(__FILE__);

if (file_exists($payment_lang)) {
    include_once ($payment_lang);
    L($_LANG);
}

/* 模块的基本信息 */
if (isset($set_modules) && $set_modules == TRUE) {
    $i = isset($modules) ? count($modules) : 0;
    /* 代码 */
    $modules[$i]['code'] = basename(__FILE__, '.php');
    /* 描述对应的语言项 */
    $modules[$i]['desc'] = 'bank_desc';
    /* 是否支持货到付款 */
    $modules[$i]['is_cod'] = '0';
    /* 是否支持在线支付 */
    $modules[$i]['is_online'] = '0';
    /* 作者 */
    $modules[$i]['author'] = 'ECSHOP TEAM';
    /* 网址 */
    $modules[$i]['website'] = 'http://www.ecshop.com';
    /* 版本号 */
    $modules[$i]['version'] = '1.0.0';
    /* 配置信息 */
    $modules[$i]['config'] = array();
    return;
}

/**
 * 银行汇款（转账）插件类
 */
class bank
{

    /**
     * 提交函数
     */
    function get_code()
    {
        return '';
    }

    /**
     * 处理函数
     */
    function response()
    {
        return;
    }
}

?>
