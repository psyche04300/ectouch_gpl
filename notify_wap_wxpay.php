<?php
define('IN_ECTOUCH_GPL', true);
/**
 * 通用通知接口demo
 * ====================================================
 * 支付完成后，微信会把相关支付和用户信息发送到商户设定的通知URL，
 * 商户接收回调信息后，根据需要设定相应的处理流程。
 * 
 * 这里举例使用log文件形式记录回调信息。
*/
		
define('CONTROLLER_NAME', 'WXRespond');
require ('include/EcTouch.php');	
	
?>
