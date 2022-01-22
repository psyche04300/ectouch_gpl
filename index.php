<?php

/**
 * ECTouch_gpl Open Source Project
 * ============================================================================
 * Copyright (c) 2012-2014 http://ectouch_gpl.cn All rights reserved.
 * ----------------------------------------------------------------------------
 * 文件名称：index.php
 * ----------------------------------------------------------------------------
 * 功能描述：ECTouch_gpl项目入口文件
 * ----------------------------------------------------------------------------
 * Licensed ( http://www.ectouch_gpl.cn/docs/license.txt )
 * ----------------------------------------------------------------------------
 */

/* 访问控制 */
define('IN_ECTOUCH_GPL', true);
/* 设置系统编码格式 */
header("Content-Type:text/html;charset=utf-8");
/* 设置系统编码格式 */
header("Pragma: no-cache");
/* 修复后退没有提交数据的问题 */
header("Cache-control: private");
/* 加载核心文件 */
require ('include/EcTouch.php');
