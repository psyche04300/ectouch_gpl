<?php

/**
 * ECTouch_gpl Open Source Project
 * ============================================================================
 * Copyright (c) 2012-2014 http://ectouch_gpl.cn All rights reserved.
 * ----------------------------------------------------------------------------
 * 文件名称：RespondController.class.php
 * ----------------------------------------------------------------------------
 * 功能描述：ECTOUCH_GPL 支付应答控制器
 * ----------------------------------------------------------------------------
 * Licensed ( http://www.ectouch_gpl.cn/docs/license.txt )
 * ----------------------------------------------------------------------------
 */

/* 访问控制 */
defined('IN_ECTOUCH_GPL') or die('Deny Access');

class WXRespondController extends CommonController
{

    private $data;

    public function __construct()
    {
        parent::__construct();
        // 获取参数
   		$xml = $GLOBALS['HTTP_RAW_POST_DATA'];
        $this->data = json_decode(json_encode(simplexml_load_string($xml, 'SimpleXMLElement', LIBXML_NOCDATA)), true);

	}

    // 发送
    public function index()
    {
        /* 判断是否启用 */
	 	if ($this->data["return_code"] == "SUCCESS") {
			$out_trade_no = explode('O', $this->data['out_trade_no']);
			$log_id = $out_trade_no[1];
            if($log_id){
                model('Payment')->order_paid($log_id, 2);
            }/*elseif($out_trade_no) {
                model('Payment')->order_paid2($out_trade_no, 2);
            }*/
		}
		/*elseif($notify->data["result_code"] == "FAIL"){

		  $msg = L('pay_not_exist');

		}*/

	         //显示页面
       // $this->assign('message', $msg);
       // $this->assign('shop_url', __URL__);
       // $this->display('respond.dwt');
    }
}
