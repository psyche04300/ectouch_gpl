<?php

/**
 * ECTouch_gpl Open Source Project
 * ============================================================================
 * Copyright (c) 2012-2014 http://ectouch_gpl.cn All rights reserved.
 * ----------------------------------------------------------------------------
 * 文件名称：IndexModel.class.php
 * ----------------------------------------------------------------------------
 * 功能描述：ECTOUCH_GPL 首页模型
 * ----------------------------------------------------------------------------
 * Licensed ( http://www.ectouch_gpl.cn/docs/license.txt )
 * ----------------------------------------------------------------------------
 */
/* 访问控制 */
defined('IN_ECTOUCH_GPL') or die('Deny Access');

class GroupsModel extends CommonModel {


    function getGroupsAdv(){
        $advs = $this->query("SELECT id,advname,link,thumb FROM " . $this->pre . "groups_adv WHERE enabled=1 order by displayorder desc");
        return $advs;
    }

    function getCategories() {
        $categories = $this->query("SELECT id,name,thumb FROM " . $this->pre . "groups_category WHERE enabled=1 order by displayorder desc");
        return $categories;
    }

    function getCategory($id) {
        $category = $this->row("SELECT id,name,thumb FROM " . $this->pre . "groups_category WHERE id=$id");
        return $category;
    }

    function getRecgoods() {
        $recgoods = $this->query("SELECT id,title,thumb,price,groupnum,groupsprice,isindex,goodsnum,units,sales,description,headstype,headsmoney,headsdiscount,discount FROM " . $this->pre . "groups_goods WHERE isindex = 1 and status=1 and deleted=0 order by displayorder desc,id DESC limit 20");
        return $recgoods;
    }

    function getGoods($id) {
        $goods = $this->row("select * from " . $this->pre . "groups_goods where id = $id and status = 1  and deleted = 0 order by displayorder desc");
        return $goods;
    }

    function getTeams() {
        $teams = $this->query("SELECT * FROM " . $this->pre . "groups_goods WHERE deleted = 0 and status = 1 order by sales desc limit 4");
        return $teams;
    }

    function getGoodsTotalByCondition($condition) {
        $total = $this->row("SELECT COUNT(1) total FROM " . $this->pre . "groups_goods where 1 " . $condition);
        return $total['total'];
    }

    function getGoodsByCondition($condition,$pindex,$psize) {
        $list = $this->query("SELECT id,title,thumb,price,groupnum,groupsprice,category,isindex,goodsnum,units,sales,description FROM " . $this->pre . "groups_goods where 1 " . $condition . " ORDER BY displayorder DESC,id DESC LIMIT " . (($pindex - 1) * $psize) . "," . $psize);
        return $list;
    }


    function getSet() {
        $set = $this->row("select * from " . $this->pre . "groups_set  where 1=1");
        return $set;
    }

    function getMyOrder($condition) {
        $order = $this->row("select * from " . $this->pre . "groups_order  where $condition");
        return $order;
    }



}
