<?php
if (! defined('IN_ECTOUCH_GPL')) {
    die('Deny Access');
}

$_LANG['lengcangpinpeisong']          = '冷藏品配送';
$_LANG['lengcangpinpeisong_desc']     = '冷藏品配送';
$_LANG['item_fee'] = '单件商品费用：';
$_LANG['base_fee'] = '首重费用';
$_LANG['step_fee'] = '续重费用';
$_LANG['min_fee'] = '起步价';
$_LANG['shipping_print'] = '<table border="0" cellspacing="0" cellpadding="0" style="width:18.6cm; height:11.3cm;">
  <tr>
    <td valign="top" style="width:7.2cm;">
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td style="height:1.5cm;">&nbsp;</td>
      </tr>
    </table>
    <table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td colspan="4" style="height:0.4cm;"></td>
        </tr>
      <tr>
        <td style="width:1cm; height:1cm;">&nbsp;</td>
        <td style="width:2.4cm;">{$shop_name}</td>
        <td style="width:1cm; height:1cm;">&nbsp;</td>
        <td>{$city}</td>
      </tr>
    </table>
    <table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td colspan="6" style="height:0.4cm;">&nbsp;</td>
        </tr>
      <tr>
        <td style="width:1.6cm;">{$province}</td>
        <td style="width:0.8cm; height:0.6cm;"></td>
        <td style="width:1.6cm;">{$city}</td>
        <td style="width:0.8cm;"></td>
        <td style="width:1.6cm;">&nbsp;</td>
        <td style="width:0.8cm;"></td>
      </tr>
      <tr>
        <td colspan="6" style="height:1cm;">{$shop_address}</td>
        </tr>
    </table>
    <table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td style="height:0.4cm;"></td>
      </tr>
      <tr>
        <td style="height:1cm;">{$shop_name}</td>
      </tr>
    </table>
     <table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td style="height:0.8cm; width:0.8cm;">&nbsp;</td>
        <td style="width:2.8cm;">{$service_phone}</td>
        <td style="height:0.8cm; width:0.8cm;">&nbsp;</td>
        <td style="width:2.8cm;">&nbsp;</td>
      </tr>
    </table>
    </td>
    <td valign="top" style="width:7.2cm;">
    <table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td style="height:2.9cm;">&nbsp;</td>
    </tr>
  </table>
  <table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td style="height:1cm; width:1.2cm;">&nbsp;</td>
    <td style="width:2.4cm;">{$order.consignee}</td>
    <td style="height:1cm; width:1.2cm;">&nbsp;</td>
    <td style="width:2.4cm;">{$order.region}</td>
  </tr>
</table>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td colspan="6" style="height:0.4cm;">&nbsp;</td>
        </tr>
      <tr>
        <td style="width:1.6cm;">{$province}</td>
        <td style="width:0.8cm; height:0.6cm;"></td>
        <td style="width:1.6cm;">{$city}</td>
        <td style="width:0.8cm;"></td>
        <td style="width:1.6cm;"></td>
        <td style="width:0.8cm;"></td>
      </tr>
      <tr>
        <td colspan="6" style="height:1cm;">{$order.address}</td>
        </tr>
    </table>
    <table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td style="height:0.4cm;"></td>
      </tr>
      <tr>
        <td style="height:1cm;">{$order.consignee}</td>
      </tr>
    </table>
    <table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td style="height:0.8cm; width:0.8cm;">&nbsp;</td>
        <td style="width:2.8cm;"></td>
        <td style="height:0.8cm; width:0.8cm;">&nbsp;</td>
        <td style="width:2.8cm;">{$order.mobile}</td>
      </tr>
    </table>

    </td>
    <td valign="top" style="width:4.2cm;">&nbsp;

    </td>
  </tr>
</table>';

?>
