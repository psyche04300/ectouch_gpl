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

class IndexController extends CommonController
{

    /**
     * 首页信息
     */
    public function index()
    {
        // 自定义导航栏
        $navigator = model('Common')->get_navigator();

        $this->assign('navigator', $navigator['middle']);
        $this->assign('best_goods', model('Index')->goods_list('best', C('page_size')));

        $this->assign('new_goods', model('Index')->goods_list('new', C('page_size')));
//        die(var_dump(model('Index')->goods_list('new', C('page_size'))));
        $this->assign('hot_goods', model('Index')->goods_list('hot', C('page_size')));

        // 显示米面粮油分类 TODO 2018年6月27日 14:31:25
        $this->assign('list01', model('Index')->goods_list_for_id( 39, C('page_size') ) );

        //首页推荐分类
        $cat_rec = model('Index')->get_recommend_res();
        //标题
        $this->assign('title', "一味妙");
        $this->assign('cat_best', $cat_rec[1]);
        $this->assign('cat_new', $cat_rec[2]);
        $this->assign('cat_hot', $cat_rec[3]);
        // 促销活动
        $this->assign('promotion_info', model('GoodsBase')->get_promotion_info());
        // 团购商品
        $this->assign('group_buy_goods', model('Groupbuy')->group_buy_list(C('page_size'), 1, 'goods_id', 'ASC'));

        // 获取分类
        $categories = model('Category')->get_touch_cat();
        $categories2 = array();
        foreach ($categories AS $row) {
            //if ($row['is_show']) {
                $categories2[$row['cat_id']]['cat_ico'] = $row['cat_ico'];
                $categories2[$row['cat_id']]['cat_image'] = $row['cat_image'];
                $categories2[$row['cat_id']]['cat_name'] = $row['cat_name'];

                // 新品推荐链接 -> 新品上市链接
                if ($row['cat_name'] == '新品推荐') {
                    $categories2[$row['cat_id']]['url'] = url('category/index', array('id' => 0));
                } else {
                    $categories2[$row['cat_id']]['url'] = url('category/index', array('id' => $row['cat_id']));
                }

           // }
        }

        $this->assign('categories', $categories2);
//        die(var_dump(model('CategoryBase')->get_cat_name()));
        // 获取品牌
        $this->assign('brand_list', model('Brand')->get_brands($app = 'brand', C('page_size'), 1));
//公告
        $noticelist=model('ArticleBase')->get_cat_articles(1);
        $this->assign('noticelist', $noticelist);
        $cart_num=insert_cart_info_number();
        $this->assign('cart_num', $cart_num);

        $this->display('index.dwt');
    }

    /**
     * ajax获取商品
     */
    public function ajax_goods()
    {
        if (IS_AJAX) {
            $type = I('get.type');
            $start = $_POST['last'];
            $limit = $_POST['amount'];
            $hot_goods = model('Index')->goods_list($type, $limit, $start);
            $list = array();
            // 热卖商品
            if ($hot_goods) {
                foreach ($hot_goods as $key => $value) {
                    $this->assign('hot_goods', $value);
                    $list [] = array(
                        'single_item' => ECTouch_gpl::view()->fetch('library/asynclist_index.lbi')
                    );
                }
            }
            echo json_encode($list);
            exit();
        } else {
            $this->redirect(url('index'));
        }
    }

    /**
     * ajax获取商品
     */
    public function ajax_index_goods()
    {
        $cat_id = I('get.id');
        $start = $_POST['last'] ? $_POST['last'] : 0;
        $limit = $_POST['amount'] ? $_POST['amount'] : 100;

        $goods = model('Index')->goods_list_for_id($cat_id, $limit, $start);
        $cat = model('Index')->getCat($cat_id);

        $this->assign('cat', $cat);
        $this->assign('goods', $goods);

        echo ECTouch_gpl::view()->fetch('library/ajax_index_goods.lbi');
        exit();
        $list = array();
        // 热卖商品
        if ($goods) {

            $list = array(
                'single_item' => ECTouch_gpl::view()->fetch('library/ajax_index_goods.lbi')
            );
        }
        echo json_encode($list);
        exit();

    }
    public function ajax_index_group_buy_goods()
    {

        $goods = model('Groupbuy')->group_buy_list(C('page_size'), 1, 'goods_id', 'ASC');
        // die(var_dump($goods));
        $this->assign('goods', $goods);

        echo ECTouch_gpl::view()->fetch('library/ajax_index_group_buy_goods.lbi');
        exit();


    }
}
