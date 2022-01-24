<?php

/**
 * ECTouch_gpl Open Source Project
 * ============================================================================
 * Copyright (c) 2012-2014 http://ectouch_gpl.cn All rights reserved.
 * ----------------------------------------------------------------------------
 * 文件名称：IndexController.class.php
 * ----------------------------------------------------------------------------
 * 功能描述：ECTouch_gpl首页控制器
 * ----------------------------------------------------------------------------
 * Licensed ( http://www.ectouch_gpl.cn/docs/license.txt )
 * ----------------------------------------------------------------------------
 */
/* 访问控制 */
defined('IN_ECTOUCH_GPL') or die('Deny Access');

class GroupsController extends CommonController
{
    public function index()
    {

        //幻灯片
        $advs =  model('Groups')->getGroupsAdv();
        $this->assign('advs', $advs);

        //分类
        $categories = model('Groups')->getCategories();
        $this->assign('categories', $categories);

        //推荐商品
        $recgoods = model('Groups')->getRecgoods();

        foreach($recgoods as $k=>&$item) {
            if (!empty($item['discount'])) {
                if($item['headstype']==0){
                    $item['mygroupsprice'] =  '¥'.round($item['groupsprice']-$item['headsmoney'],2);
                }elseif($item['headstype']==1){
                    if($item['headsdiscount']>=100){
                        $item['mygroupsprice'] =  '免费';
                    } else {
                        $item['mygroupsprice'] =  '¥<em>'.round($item['groupsprice'] -($item['groupsprice'] * $item['headsdiscount']) / 100).'</em>';
                    }
                }
            } else {
                $item['mygroupsprice'] =  '¥<em>'.$item['groupsprice'].'</em>';
            }
        }



        $this->assign('recgoods', $recgoods);



        $this->display('groups.dwt');
    }

    public function goods() {

        $id = $_GET['id'];
        $goods = model('Groups')->getGoods($id);
        $goods['thumb_url'] = unserialize($goods['thumb_url']);
        $goods['yaonum'] = $goods['groupnum'] - 1;

        $groupsset = array();

        $teams = model('Groups')->getTeams();

        $this->assign('goods', $goods);
        $this->assign('groupsset', $groupsset);
        $this->assign('teams', $teams);


        $this->display('groups_goods.dwt');

    }

    public function category() {

        $id = intval($_GET['id']);
        $list = array();
        $pindex = max(1, intval($_GET['page']));
        $psize = 10;
        $condition = ' and status=1 and deleted=0';

        if (!empty($id)) {
            $condition .= ' and category = ' . $id;
        }

        $keyword = trim($_GET['keyword']);

        if (!empty($keyword)) {
            $condition .= ' AND title like \'%' . $keyword . '%\' ';
        }

        $total = model('Groups')->getGoodsTotalByCondition($condition);
        if (!empty($total)) {
            $list = model('Groups')->getGoodsByCondition($condition,$pindex,$psize);
        }

        $category = model('Groups')->getCategory($id);
        $categories = model('Groups')->getCategories();
        $this->assign('categories', $categories);
        $this->assign('category', $category);
        $this->assign('list', $list);

        $this->display('groups_category.dwt');

    }

    public function orders() {

        $url =  'http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];

        if (empty($_SESSION ['direct_shopping']) && $_SESSION['user_id'] == 0) {
            /* 用户没有登录且没有选定匿名购物，转向到登录页面 */
            $this->redirect(url('user/login', array('referer' => $url)));
            exit;
        }

        $uid = $_SESSION['user_id'];
        $list = array();
        $pindex = max(1, intval($_GET['page']));
        $psize = 10;
        $status = intval($_GET['status']);

        if ($status == 0) {
            $tab_all = true;
            $condition = " and o.uid=$uid and o.deleted = 0";
        } else {


            if ($status == 1) {
                $tab0 = true;
                $pstatus = 0;
                $condition = " and o.uid=$uid  and o.status=$pstatus and o.deleted=0";
            } else if ($status == 2) {
                $tab1 = true;
                $pstatus = 1;
                $condition = " and o.uid=$uid and o.deleted = 0 and o.status = $pstatus and (o.is_team = 0 or o.success = 1)";
            } else if ($status == 3) {
                $tab2 = true;
                $pstatus = 2;
                $condition = " and o.uid=$uid  and o.status=$pstatus and o.deleted=0";
            } else {
                if ($status == 4) {
                    $tab3 = true;
                    $pstatus = 3;
                    $condition = " and o.uid=$uid  and o.status=$pstatus and o.deleted=0";
                }
            }
        }
        $sql = "select o.id,o.uid,o.orderno,o.createtime,o.price,o.freight,o.creditmoney,o.goodid,o.teamid,o.status,o.is_team,o.success,o.teamid,g.title,g.thumb,g.units,g.goodsnum,g.groupsprice,g.singleprice,o.verifynum,o.verifytype,o.isverify,o.verifycode from " . $this->model->pre . "groups_order as o left join "  . $this->model->pre . "groups_goods as g on g.id = o.goodid where 1 " . $condition . " order by o.createtime desc LIMIT " . (($pindex - 1) * $psize) . "," . $psize;
        $orders =  M()->query($sql);
        $totalRow = M()->getRow("select count(1) total from " . $this->model->pre . "groups_order as o where 1 " . $condition);
        $total = $totalRow['total'];

        foreach ($orders as $key => $value) {
            $verifytotalRow = M()->getRow("select count(1) total from " . $this->model->pre . "groups_verify where orderid = ".$value['id']." and uid= ".$value['uid']." and verifycode = ".$value['verifycode']);

            $verifytotal = $verifytotalRow['total'];

            if (!$verifytotal) {
                $verifytotal = 0;
            }

            $orders[$key]['vnum'] = $value['verifynum'] - intval($verifytotal);
            $orders[$key]['amount'] = ($value['price'] + $value['freight']) - $value['creditmoney'];
            $statuscss = 'text-cancel';

            switch ($value['status']) {
                case '-1':
                    $statustext = '已取消';
                    break;

                case '0':
                    $statustext = '待付款';
                    $statuscss = 'text-cancel';
                    break;

                case '1':
                    if (($value['is_team'] == 0) || ($value['success'] == 1)) {
                        $statustext = '待发货';
                        $statuscss = 'text-warning';
                    } else {
                        $statustext = '已付款';
                        $statuscss = 'text-success';
                    }

                    break;

                case '2':
                    $statustext = '待收货';
                    $statuscss = 'text-danger';
                    break;

                case '3':
                    $statustext = '已完成';
                    $statuscss = 'text-success';
                    break;
            }

            $orders[$key]['statusstr'] = $statustext;
            $orders[$key]['statuscss'] = $statuscss;
        }
//
//        $orders = set_medias($orders, 'thumb');
        //show_json(1, array('list' => $orders, 'pagesize' => $psize, 'total' => $total));

        $this->assign('status', $status);
        $this->assign('total', $total);
        $this->assign('orders', $orders);

        $this->display('groups_orders.dwt');

    }

    public function openGroups() {
        $id = $_GET['id'];
        $goods = model('Groups')->getGoods($id);
        $goods['thumb_url'] = unserialize($goods['thumb_url']);
        $goods['yaonum'] = $goods['groupnum'] - 1;

        $groupsset = array();

        $teams = model('Groups')->getTeams();

        $this->assign('goods', $goods);
        $this->assign('groupsset', $groupsset);
        $this->assign('teams', $teams);

        $this->display('groups_open_groups.dwt');

    }

    public function goodsCheck() {

        $resp = array();

        $id = intval($_POST['id']);
        $type = $_POST['type'];

        if (empty($id)) {
            $resp['status'] = 0;
            $resp['msg'] = '商品不存在！';
            exit(json_encode($resp));
        }

        $goods = model('Groups')->getGoods($id);

        if (empty($goods)) {
            $resp['status'] = 0;
            $resp['msg'] = '商品不存在！';
            exit(json_encode($resp));
        }

        if ($type == 'single') {
            if (empty($goods['single'])) {
                $resp['status'] = 0;
                $resp['msg'] = '商品不允许单购，请重新选择！';
                exit(json_encode($resp));
            }
        }
        if (empty($goods['stock'])) {
            $resp['status'] = 0;
            $resp['msg'] = '商品库存为0，暂时无法购买，请浏览其他商品！';
            exit(json_encode($resp));
        }
        $resp['status'] = 1;
        $resp['msg'] = 'ok';
        exit(json_encode($resp));
    }



    public function rules() {
        $this->display('groups_rules.dwt');
    }

    public function ordersConfirm() {

        $flow_type = isset($_SESSION ['flow_type']) ? intval($_SESSION ['flow_type']) : CART_GENERAL_GOODS;

        $url =  'http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];

        if (empty($_SESSION ['direct_shopping']) && $_SESSION['user_id'] == 0) {
            /* 用户没有登录且没有选定匿名购物，转向到登录页面 */
            $this->redirect(url('user/login', array('referer' => $url)));
            exit;
        }

        $_SESSION ['groups_consignee_backurl'] = $url;



        // 获取收货人信息
        $consignee = model('Order')->get_consignee($_SESSION ['user_id']);
        /* 检查收货人信息是否完整 */
        if (!model('Order')->check_consignee_info($consignee, $flow_type)) {
            /* 如果不完整则转向到收货人信息填写界面 */
            ecs_header("Location: " . url('groups/consignee_list') . "\n");
        }

        // 获取配送地址
        $consignee_list = model('Users')->get_consignee_list($_SESSION ['user_id']);
        $this->assign('consignee_list', $consignee_list);
        //获取默认配送地址
        $address_id = $this->model->table('users')->field('address_id')->where("user_id = '" . $_SESSION['user_id'] . "' ")->getOne();
        $this->assign('address_id', $address_id);
        $_SESSION ['flow_consignee'] = $consignee;
        $this->assign('consignee', $consignee);

        $isverify = false;
        $id = intval($_GET['id']);
        $type = $_GET['type'];
        $heads = intval($_GET['heads']);
        $teamid = intval($_GET['teamid']);

        $goods = model('Groups')->getGoods($id);
        if ($goods['stock'] <= 0) {
            show_message('您选择的商品已经下架，请浏览其他商品或联系商家！');
        }

        $goods['freight'] = number_format($goods['freight'],2);

        $uid = $_SESSION['user_id'];
        $myorder =  model('Groups')->getMyOrder(" uid = $uid and status >= 0 and goodid = $id");

        $ordernum = count($myorder);
        if(!$myorder) {
            $ordernum = 0;
        }

        if (!empty($goods['purchaselimit']) && ($goods['purchaselimit'] <= $ordernum)) {
            show_message('您已到达此商品购买上限，请浏览其他商品或联系商家！');
        }

        $order =  model('Groups')->getMyOrder(" goodid = $id and status >= 0 and is_team = 1 and uid = $uid and success = 0 and deleted = 0");
        if ($order && ($order['status'] == 0)) {
            show_message('您的订单已存在，请尽快完成支付！');
        }

        if ($order && ($order['status'] == 1)) {
            show_message('您已经参与了该团，请等待拼团结束后再进行购买！');
        }

        if ($order && ($order['groupnum'] <= $ordernum)) {
            show_message('该团人数已达上限，请浏览其他商品或联系商家！');
        }

        if (!empty($teamid)) {
//            $orders = pdo_fetchall('select * from ' . tablename('ewei_shop_groups_order') . "\r\n\t\t\t\t\twhere teamid = :teamid and uniacid = :uniacid ", array(':teamid' => $teamid, ':uniacid' => $uniacid));
//
//            foreach ($orders as $key => $value) {
//                if ($orders && ($value['success'] == -1)) {
//                    $this->message('该活动已过期，请浏览其他商品或联系商家！');
//                }
//
//                if ($orders && ($value['success'] == 1)) {
//                    $this->message('该活动已结束，请浏览其他商品或联系商家！');
//                }
//            }
//
//            $num = pdo_fetchcolumn('select count(1) from ' . tablename('ewei_shop_groups_order') . ' as o where teamid = :teamid and status > :status and goodid = :goodid and uniacid = :uniacid ', array(':teamid' => $teamid, ':status' => 0, ':goodid' => $goods['id'], ':uniacid' => $uniacid));
//
//            if ($num == $goods['groupnum']) {
//                $this->message('该活动已成功组团，请浏览其他商品或联系商家！');
//            }
        }

        if ($type == 'groups') {
            $goodsprice = $goods['groupsprice'];
            $price = $goods['groupsprice'];
            $groupnum = intval($goods['groupnum']);
            $is_team = 1;
        } else {
            if ($type == 'single') {
                $goodsprice = $goods['singleprice'];
                $price = $goods['singleprice'];
                $groupnum = 1;
                $is_team = 0;
                $teamid = 0;
            }
        }

        $set = model('Groups')->getSet();

        if (($heads == 1)) {
            if ($goods['discount']) {
                if (!empty($goods['headstype'])) {
                    if (0 < $goods['headsdiscount']) {
                        $goods['headsmoney'] = $goods['groupsprice'] - price_format(($goods['groupsprice'] * $goods['headsdiscount']) / 100, 2);
                    }
                }
            } else {
                if (empty($set['headstype'])) {
                    $goods['headsmoney'] = $set['headsmoney'];
                } else {
                    if ($set['headsdiscount']>=100) {
                        $goods['headsmoney'] = $price;
                    } elseif (0 < $set['headsdiscount']) {
                        $goods['headsmoney'] = $goods['groupsprice'] - price_format(($goods['groupsprice'] * $set['headsdiscount']) / 100, 2);
                    }
                }
                $goods['headstype'] = $set['headstype'];
                $goods['headsdiscount'] = $set['headsdiscount'];
            }
            if ($goods['groupsprice'] < $goods['headsmoney']) {
                $goods['headsmoney'] = $goods['groupsprice'];
            }

            $price = $price - $goods['headsmoney'];
            if ($price < 0) {
                $price = 0;
            }
        } else {
            $goods['headsmoney'] = 0;
        }

        if (!empty($goods['isverify'])) {
//            $isverify = true;
//            $goods['freight'] = 0;
//            $storeids = array();
//            $merchid = 0;
//
//            if (!empty($goods['storeids'])) {
//                $merchid = $goods['merchid'];
//                $storeids = array_merge(explode(',', $goods['storeids']), $storeids);
//            }
//
//            if (empty($storeids)) {
//                if (0 < $merchid) {
//                    $stores = pdo_fetchall('select * from ' . tablename('ewei_shop_merch_store') . ' where  uniacid=:uniacid and merchid=:merchid and status=1 and type in(2,3)', array(':uniacid' => $_W['uniacid'], ':merchid' => $merchid));
//                } else {
//                    $stores = pdo_fetchall('select * from ' . tablename('ewei_shop_store') . ' where  uniacid=:uniacid and status=1 and type in(2,3)', array(':uniacid' => $_W['uniacid']));
//                }
//            } else if (0 < $merchid) {
//                $stores = pdo_fetchall('select * from ' . tablename('ewei_shop_merch_store') . ' where id in (' . implode(',', $storeids) . ') and uniacid=:uniacid and merchid=:merchid and status=1 and type in(2,3)', array(':uniacid' => $_W['uniacid'], ':merchid' => $merchid));
//            } else {
//                $stores = pdo_fetchall('select * from ' . tablename('ewei_shop_store') . ' where id in (' . implode(',', $storeids) . ') and uniacid=:uniacid and status=1 and type in(2,3)', array(':uniacid' => $_W['uniacid']));
//            }
//
//            $verifycode = 'PT' . random(8, true);
//
//            while (1) {
//                $count = pdo_fetchcolumn('select count(*) from ' . tablename('ewei_shop_groups_order') . ' where verifycode=:verifycode and uniacid=:uniacid limit 1', array(':verifycode' => $verifycode, ':uniacid' => $_W['uniacid']));
//
//                if ($count <= 0) {
//                    break;
//                }
//
//                $verifycode = 'PT' . random(8, true);
//            }
//
//            $verifynum = (!empty($goods['verifytype']) ? $verifynum = $goods['verifynum'] : 1);
        } else {
            //$address = pdo_fetch('select * from ' . tablename('ewei_shop_member_address') . "\r\n\t\t\t\twhere openid=:openid and deleted=0 and isdefault=1  and uniacid=:uniacid limit 1", array(':uniacid' => $uniacid, ':openid' => $openid));
        }

        /*
        $creditdeduct = pdo_fetch('SELECT creditdeduct,groupsdeduct,credit,groupsmoney FROM' . tablename('ewei_shop_groups_set') . 'WHERE uniacid = :uniacid ', array(':uniacid' => $uniacid));

        if (intval($creditdeduct['creditdeduct'])) {
            if (intval($creditdeduct['groupsdeduct'])) {
                if (0 < $goods['deduct']) {
                    $credit['deductprice'] = round(intval($member['credit1']) * $creditdeduct['groupsmoney'], 2);

                    if ($price <= $credit['deductprice']) {
                        $credit['deductprice'] = $price;
                    }

                    if ($goods['deduct'] <= $credit['deductprice']) {
                        $credit['deductprice'] = $goods['deduct'];
                    }

                    $credit['credit'] = floor($credit['deductprice'] / $creditdeduct['groupsmoney']);

                    if ($credit['credit'] < 1) {
                        $credit['credit'] = 0;
                        $credit['deductprice'] = 0;
                    }

                    $credit['deductprice'] = $credit['credit'] * $creditdeduct['groupsmoney'];
                } else {
                    $credit['deductprice'] = 0;
                }
            } else {
                $sys_data = m('common')->getPluginset('sale');

                if (0 < $goods['deduct']) {
                    $credit['deductprice'] = round(intval($member['credit1']) * $sys_data['money'], 2);

                    if ($price <= $credit['deductprice']) {
                        $credit['deductprice'] = $price;
                    }

                    if ($goods['deduct'] <= $credit['deductprice']) {
                        $credit['deductprice'] = $goods['deduct'];
                    }

                    $credit['credit'] = floor($credit['deductprice'] / $sys_data['money']);

                    if ($credit['credit'] < 1) {
                        $credit['credit'] = 0;
                        $credit['deductprice'] = 0;
                    }

                    $credit['deductprice'] = $credit['credit'] * $sys_data['money'];
                } else {
                    $credit['deductprice'] = 0;
                }
            }
        }
        */

        if ($_REQUEST['act'] == 'ispost') {




//            if (empty($_GPC['aid']) && !$isverify) {
//                header('location: ' . mobileUrl('groups/address/post'));
//                exit();
//            }

            if ($isverify) {
                if (empty($_GPC['realname']) || empty($_GPC['mobile'])) {
                    show_message('联系人或联系电话不能为空！');
                }
            }

//            if ((0 < intval($_GPC['aid'])) && !$isverify) {
//                $order_address = pdo_fetch('select * from ' . tablename('ewei_shop_member_address') . ' where id=:id and openid=:openid and uniacid=:uniacid   limit 1', array(':uniacid' => $uniacid, ':openid' => $openid, ':id' => intval($_GPC['aid'])));
//
//                if (empty($order_address)) {
//                    $this->message('未找到地址');
//                    header('location: ' . mobileUrl('groups/address/post'));
//                    exit();
//                } else {
//                    if (empty($order_address['province']) || empty($order_address['city'])) {
//                        $this->message('地址请选择省市信息');
//                        header('location: ' . mobileUrl('groups/address/post'));
//                        exit();
//                    }
//                }
//            }

            $data = array(
                'groupnum' => $groupnum,
                'uid' => $uid,
                'paytime' => '',
                'orderno' => get_order_sn(),
                'credit' => intval($_POST['isdeduct']) ? $_POST['credit'] : 0,
                'creditmoney' => intval($_POST['isdeduct']) ? $_POST['creditmoney'] : 0,
                'price' => $price,
                'freight' => $goods['freight'],
                'status' => 0,
                'goodid' => $id,
                'teamid' => $teamid,
                'is_team' => $is_team,
                'heads' => $heads,
                'discount' => !empty($heads) ? $goods['headsmoney'] : 0,
                'addressid' => $address_id,
                'address' => serialize($consignee),
                'message' => trim($_POST['message']),
                'realname' => $isverify ? trim($_POST['realname']) : '',
                'mobile' => $isverify ? trim($_POST['mobile']) : '',
                'endtime' => $goods['endtime'],
                'isverify' => intval($goods['isverify']),
                'verifytype' => intval($goods['verifytype']),
                'verifycode' => !empty($verifycode) ? $verifycode : 0,
                'verifynum' => !empty($verifynum) ? $verifynum : 1,
                'createtime' => gmtime()
            );
            $this->model->table('groups_order')->data($data)->insert();
            $error_no = M()->errno();
            if ($error_no > 0) {
                show_message('生成订单失败！');
            }
            $orderid = M()->insert_id();

            if (empty($teamid) && ($type == 'groups')) {
                $sql = "UPDATE " . $this->model->pre . "groups_order SET teamid=$orderid WHERE id=" . $orderid;
                $this->model->table('groups_order')->query($sql);
            }

            $order = M()->getRow("select * from "  . $this->model->pre . "groups_order where id=$orderid");

            $p1 =  empty($teamid) ? $order['teamid'] : $teamid;
            $payurl = "/mobile/index.php?m=default&c=groups&a=pay&teamid=$p1&orderid=$orderid";
            header('location: ' . $payurl);
        }



        $allprice = number_format($price+$goods['freight'],2);
        $this->assign('allprice', $allprice);
        $this->assign('goods', $goods);
        $this->assign('is_team', $is_team);

        $this->display('groups_order_confirm.dwt');


    }

    public function pay() {


        $orderid = intval($_GET['orderid']);
        $teamid = intval($_GET['teamid']);
        $order = M()-getRow('select o.*,g.title,g.status as gstatus,g.deleted as gdeleted,g.stock from ' . $this->model->pre . "groups_order as o left join " . $this->model->pre . "groups_goods as g on g.id = o.goodid where o.id = $orderid order by o.createtime desc");

        if (empty($order)) {
            $this->message('订单未找到！', mobileUrl('groups/index'), 'error');
        }

        if (!empty($isteam) && ($order['success'] == -1)) {
            $this->message('该活动已失效，请浏览其他商品或联系商家！', mobileUrl('groups/index'), 'error');
        }

        if (empty($order['gstatus']) || !empty($order['gdeleted'])) {
            $this->message($order['title'] . '<br/> 已下架!', mobileUrl('groups/index'), 'error');
        }

        if ($order['stock'] <= 0) {
            $this->message($order['title'] . '<br/>库存不足!', mobileUrl('groups/index'), 'error');
        }

        if (!empty($teamid)) {
            $team_orders = pdo_fetchall('select * from ' . tablename('ewei_shop_groups_order') . "\r\n\t\t\t\t\twhere teamid = :teamid and uniacid = :uniacid ", array(':teamid' => $teamid, ':uniacid' => $uniacid));

            foreach ($team_orders as $key => $value) {
                if ($team_orders && ($value['success'] == -1)) {
                    $this->message('该活动已过期，请浏览其他商品或联系商家！', mobileUrl('groups/index'), 'error');
                }

                if ($team_orders && ($value['success'] == 1)) {
                    $this->message('该活动已结束，请浏览其他商品或联系商家！', mobileUrl('groups/index'), 'error');
                }
            }

            $num = pdo_fetchcolumn('select count(1) from ' . tablename('ewei_shop_groups_order') . ' as o where teamid = :teamid and status > :status and uniacid = :uniacid ', array(':teamid' => $teamid, ':status' => 0, ':uniacid' => $uniacid));

            if ($order['groupnum'] <= $num) {
                $this->message('该活动已成功组团，请浏览其他商品或联系商家！', mobileUrl('groups/index'), 'error');
            }
        }

        if (empty($order)) {
            header('location: ' . mobileUrl('groups'));
            exit();
        }

        if ($order['status'] == -1) {
            header('location: ' . mobileUrl('groups/goods', array('id' => $order['goodid'])));
            exit();
        }
        else {
            if (1 <= $order['status']) {
                header('location: ' . mobileUrl('groups/goods', array('id' => $order['goodid'])));
                exit();
            }
        }











        $this->display('groups_pay.dwt');
    }



    /**
     * 获取配送地址列表
     */
    public function consignee_list()
    {
        if (IS_AJAX) {
            $start = $_POST ['last'];
            $limit = $_POST ['amount'];
            // 获得用户所有的收货人信息
            $consignee_list = model('Users')->get_consignee_list($_SESSION['user_id'], 0, $limit, $start);
            if ($consignee_list) {
                foreach ($consignee_list as $k => $v) {
                    $address = '';
                    if ($v['province']) {
                        $address .= model('RegionBase')->get_region_name($v['province']);
                    }
                    if ($v['city']) {
                        $address .= model('RegionBase')->get_region_name($v['city']);
                    }
                    if ($v['district']) {
                        $address .= model('RegionBase')->get_region_name($v['district']);
                    }
                    $v['address'] = $address . ' ' . $v['address'];
                    $v['url'] = url('groups/consignee', array('id' => $v ['address_id']));
                    $this->assign('consignee', $v);
                    $sayList [] = array(
                        'single_item' => ECTouch_gpl::view()->fetch('library/asynclist_info.lbi')
                    );
                }
            }
            die(json_encode($sayList));
            exit();
        }
        // 赋值于模板
        $this->assign('title', L('consignee_info'));
        // 加载user语言包
        require(APP_PATH . C('_APP_NAME') . '/language/' . C('LANG') . '/user.php');
        $_LANG = array_merge(L(), $_LANG);
        $this->assign('lang', $_LANG);
        $this->display('groups_consignee_list.dwt');
    }

    public function consignee()
    {
        if ($_SERVER ['REQUEST_METHOD'] == 'GET') {
            /* 取得购物类型 */
            $flow_type = isset($_SESSION ['flow_type']) ? intval($_SESSION ['flow_type']) : CART_GENERAL_GOODS;
            //收货人信息填写界面
            if (isset($_REQUEST ['direct_shopping'])) {
                $_SESSION ['direct_shopping'] = 1;
            }

            /* 取得国家列表、商店所在国家、商店所在国家的省列表 */
            $this->assign('country_list', model('RegionBase')->get_regions());
            $this->assign('shop_country', C('shop_country'));
            $this->assign('shop_province_list', model('RegionBase')->get_regions(1, C('shop_country')));

            /* 获得用户所有的收货人信息 */
            if ($_SESSION ['user_id'] > 0) {
                $addressId = I('get.id');
                if ($addressId > 0) {
                    $consignee_list[] = model('Users')->get_consignee_list($_SESSION ['user_id'], $addressId);
                } else {
                    $consignee_list [] = array(
                        'country' => C('shop_country')
                    );
                }
            } else {
                if (isset($_SESSION ['flow_consignee'])) {
                    $consignee_list = array(
                        $_SESSION ['flow_consignee']
                    );
                } else {
                    $consignee_list [] = array(
                        'country' => C('shop_country')
                    );
                }
            }
            $this->assign('name_of_region', array(
                C('name_of_region_1'),
                C('name_of_region_2'),
                C('name_of_region_3'),
                C('name_of_region_4')
            ));
            $this->assign('consignee_list', $consignee_list);

            /* 取得每个收货地址的省市区列表 */
            $city_list = array();
            $district_list = array();
            foreach ($consignee_list as $region_id => $consignee) {
                $consignee ['country'] = isset($consignee ['country']) ? intval($consignee ['country']) : 0;
                $consignee ['province'] = isset($consignee ['province']) ? intval($consignee ['province']) : 0;
                $consignee ['city'] = isset($consignee ['city']) ? intval($consignee ['city']) : 0;

                $city_list [$region_id] = model('RegionBase')->get_regions(2, $consignee ['province']);
                $district_list [$region_id] = model('RegionBase')->get_regions(3, $consignee ['city']);
            }
            $this->assign('province_list', model('RegionBase')->get_regions(1, 1));
            $this->assign('city_list', $city_list);
            $this->assign('district_list', $district_list);

            /* 返回收货人页面代码 */
            $this->assign('real_goods_count', 1);
        } else {
            /*  保存收货人信息 	 */
            $consignee = array(
                'address_id' => empty($_POST ['address_id']) ? 0 : intval($_POST ['address_id']),
                'consignee' => empty($_POST ['consignee']) ? '' : I('post.consignee'),
                'country' => empty($_POST ['country']) ? '' : intval($_POST ['country']),
                'province' => empty($_POST ['province']) ? '' : intval($_POST ['province']),
                'city' => empty($_POST ['city']) ? '' : intval($_POST ['city']),
                'district' => empty($_POST ['district']) ? '' : intval($_POST ['district']),
                'address' => empty($_POST ['address']) ? '' : I('post.address'),
                'mobile' => empty($_POST ['mobile']) ? '' : make_semiangle(I('post.mobile'))
            );

            if ($_SESSION ['user_id'] > 0) {
                /* 如果用户已经登录，则保存收货人信息 */
                $consignee ['user_id'] = $_SESSION ['user_id'];
                model('Users')->save_consignee($consignee, true);
            }

            /* 保存到session */
            $_SESSION ['flow_consignee'] = stripslashes_deep($consignee);
            ecs_header("Location: " . $_SESSION ['groups_consignee_backurl'] . "\n");
        }

        $this->assign('currency_format', C('currency_format'));
        $this->assign('integral_scale', C('integral_scale'));
        $this->assign('step', ACTION_NAME);
        $this->assign('title', L('consignee_info'));
        $this->display('groups_consignee.dwt');

    }

    public function ordersDetail() {

        $url =  'http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];

        if (empty($_SESSION ['direct_shopping']) && $_SESSION['user_id'] == 0) {
            /* 用户没有登录且没有选定匿名购物，转向到登录页面 */
            $this->redirect(url('user/login', array('referer' => $url)));
            exit;
        }

        $uid = $_SESSION['user_id'];

        $orderid = intval($_GET['orderid']);
        $teamid = intval($_GET['teamid']);
        $condition = " and uid=$uid and id = $orderid and teamid = $teamid";

        $order = M()->getRow("select * from " . $this->model->pre ."groups_order where uid=$uid  and  id = $orderid and teamid = $teamid order by createtime desc");

        $good = M()->getRow("select * from " . $this->model->pre ."groups_goods where id = ".$order['goodid']." and status = 1 and deleted = 0 order by displayorder desc");

        if (!empty($order['isverify'])) {
            $storeids = array();
            $merchid = 0;
//核销
//            if (!empty($good['storeids'])) {
//                $merchid = $good['merchid'];
//                $storeids = array_merge(explode(',', $good['storeids']), $storeids);
//            }
//
//            if (empty($storeids)) {
//                if (0 < $merchid) {
//                    $stores = pdo_fetchall('select * from ' . tablename('ewei_shop_merch_store') . ' where  uniacid=:uniacid and merchid=:merchid and status=1 and type in(2,3)', array(':uniacid' => $_W['uniacid'], ':merchid' => $merchid));
//                } else {
//                    $stores = pdo_fetchall('select * from ' . tablename('ewei_shop_store') . ' where  uniacid=:uniacid and status=1 and type in(2,3)', array(':uniacid' => $_W['uniacid']));
//                }
//            } else if (0 < $merchid) {
//                $stores = pdo_fetchall('select * from ' . tablename('ewei_shop_merch_store') . ' where id in (' . implode(',', $storeids) . ') and uniacid=:uniacid and merchid=:merchid and status=1 and type in(2,3)', array(':uniacid' => $_W['uniacid'], ':merchid' => $merchid));
//            } else {
//                $stores = pdo_fetchall('select * from ' . tablename('ewei_shop_store') . ' where id in (' . implode(',', $storeids) . ') and uniacid=:uniacid and status=1 and type in(2,3)', array(':uniacid' => $_W['uniacid']));
//            }

//            $verifytotal = pdo_fetchcolumn('select count(1) from ' . tablename('ewei_shop_groups_verify') . ' where orderid = :orderid and openid = :openid and uniacid = :uniacid and verifycode = :verifycode ', array(':orderid' => $order['id'], ':openid' => $order['openid'], ':uniacid' => $order['uniacid'], ':verifycode' => $order['verifycode']));
//
//            if ($order['verifytype'] == 0) {
//                $verify = pdo_fetch('select isverify from ' . tablename('ewei_shop_groups_verify') . ' where orderid = :orderid and openid = :openid and uniacid = :uniacid and verifycode = :verifycode ', array(':orderid' => $order['id'], ':openid' => $order['openid'], ':uniacid' => $order['uniacid'], ':verifycode' => $order['verifycode']));
//            }
//
//            $verifynum = $order['verifynum'] - $verifytotal;
//
//            if ($verifynum < 0) {
//                $verifynum = 0;
//            }
        } else {
            $address = false;

            if (!empty($order['addressid'])) {
                $address = unserialize($order['address']);

//                if (!is_array($address)) {
//                    $address = pdo_fetch('select * from  ' . tablename('ewei_shop_member_address') . ' where id=:id limit 1', array(':id' => $order['addressid']));
//                }
            }
        }

        $carrier = @unserialize($order['carrier']);
        if (!is_array($carrier) || empty($carrier)) {
            $carrier = false;
        }

        $allprice = $order['price'] - $order['creditmoney'] + $order['freight'];
        $this->assign('allprice', $allprice);


        $this->assign('address', $address);
        $this->assign('order', $order);
        $this->assign('good', $good);



        $this->display('groups_order_detail.dwt');

    }

    public function ordersCancel() {

        $resp = array();


        $url =  "/mobile/index.php?m=default&c=groups&a=orders";

        if (empty($_SESSION ['direct_shopping']) && $_SESSION['user_id'] == 0) {
            /* 用户没有登录且没有选定匿名购物，转向到登录页面 */
            $this->redirect(url('user/login', array('referer' => $url)));
            exit;
        }

        $uid = $_SESSION['user_id'];

        $orderid = intval($_POST['id']);
        $remark = $_POST['remark'];
        $order = M()->getRow("select id,orderno,uid,status,credit,teamid,groupnum,creditmoney,price,freight,pay_type,discount,success from " . $this->model->pre ."groups_order where id=$orderid and uid=$uid limit 1");

        if (empty($order)) {
            $resp['status'] = 0;
            $resp['msg'] = "订单未找到";
            exit(json_encode($resp));
        }

        if ($order['status'] != 0) {
            $resp['status'] = 0;
            $resp['msg'] = "订单不能取消";
            exit(json_encode($resp));
        }

        $canceltime = gmtime();
        M()->query("update " . $this->model->pre ."groups_order set status=-1 ,canceltime=$canceltime , remark='$remark' where id=$orderid");

        //TODO
        //p('groups')->sendTeamMessage($orderid);


        $resp['status'] = 1;
        $resp['msg'] = "ok";

        exit(json_encode($resp));
    }

    public function ordersDelete() {

        $resp = array();


        $url =  "/mobile/index.php?m=default&c=groups&a=orders";

        if (empty($_SESSION ['direct_shopping']) && $_SESSION['user_id'] == 0) {
            /* 用户没有登录且没有选定匿名购物，转向到登录页面 */
            $this->redirect(url('user/login', array('referer' => $url)));
            exit;
        }

        $uid = $_SESSION['user_id'];
        $orderid = intval($_POST['id']);
        $order = M()->getRow("select id,status from " . $this->model->pre ."groups_order where id=$orderid and uid=$uid limit 1");

        if (empty($order)) {
            $resp['status'] = 0;
            $resp['msg'] = "订单未找到!";
            exit(json_encode($resp));
        }

        if (($order['status'] != 3) && ($order['status'] != -1)) {
            $resp['status'] = 0;
            $resp['msg'] = "无法删除";
            exit(json_encode($resp));
        }

        M()->query("update " . $this->model->pre ."groups_order set deleted=1 where id=$orderid");

        $resp['status'] = 1;
        $resp['msg'] = "ok";
        exit(json_encode($resp));
    }






}
