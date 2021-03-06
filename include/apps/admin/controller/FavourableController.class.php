<?php

/**
 * ECTouch_gpl Open Source Project
 * ============================================================================
 * Copyright (c) 2012-2014 http://ectouch_gpl.cn All rights reserved.
 * ----------------------------------------------------------------------------
 * 文件名称：FavourableControoller.class.php
 * ----------------------------------------------------------------------------
 * 功能描述：优惠活动控制器
 * ----------------------------------------------------------------------------
 * Licensed ( http://www.ectouch_gpl.cn/docs/license.txt )
 * ----------------------------------------------------------------------------
 */

/* 访问控制 */
defined('IN_ECTOUCH_GPL') or die('Deny Access');

class FavourableController extends AdminController {

    /**
     * 活动列表
     */
    public function index() {

        /* 分页 */
        $filter['page'] = '{page}';
        $offset = $this->pageLimit(url('index', $filter), 12);
        $total = $this->model->table('favourable_activity')->where()->count();
        $this->assign('page', $this->pageShow($total));
        /* 模板赋值 */
        $list = $this->favourable_list($offset);
        $this->assign('list', $list);
        $this->assign('ur_here', L('favourable_list'));
        $this->display();
    }

    /**
     * 编辑活动
     */
    public function edit() {
        $id = I('id');
        if (IS_POST) {
            $data = I('data');
            if ($_FILES['act_banner']['name']) {
                $result = $this->ectouch_gplUpload('act_banner', 'banner_image');
                if ($result['error'] > 0) {
                    $this->message($result['message'], NULL, 'error');
                }
                /* 生成banner链接 */
                $data2['act_banner'] = substr($result['message']['act_banner']['savepath'], 2) . $result['message']['act_banner']['savename'];
                $this->model->table('touch_activity')->data($data2)->where('act_id=' . $id)->update();
            }
            $this->message(L('edit_favourable_ok'), url('index'));
        }
        /* 查询附表信息 */
        $touch_result = $this->model->table('touch_activity')->where('act_id=' . $id)->find();
        $favourable = model('GoodsBase')->favourable_info($id);
        /* 附表信息不存在则生成 */
        if (empty($touch_result)) {
            $data['act_id'] = $id;
            $this->model->table('touch_activity')->data($data)->insert();
        } else {
            $favourable['act_banner'] = $touch_result['act_banner'];
            $favourable['act_content'] = html_out($touch_result['act_content']);
        }
        /* 模板赋值 */
        $this->assign('favourable', $favourable);
        $this->assign('ur_here', L('edit_favourable'));
        $this->assign('action_link', array('text' => L('06_goods_brand_list'), 'href' => url('index')));
        $this->display();
    }

    /*
     * 取得优惠活动列表
     * @return   array
     */

    private function favourable_list($offset = '0, 12') {
        /* 查询 */
        $sql = "SELECT * " .
                "FROM " . $this->model->pre .
                "favourable_activity WHERE 1" .
                " ORDER BY act_id  DESC  LIMIT $offset";
        $res = $this->model->query($sql);
        $list = array();
        foreach ($res as $row) {
            $row['start_time'] = local_date('Y-m-d H:i', $row['start_time']);
            $row['end_time'] = local_date('Y-m-d H:i', $row['end_time']);
            $list[] = $row;
        }
        return $list;
    }

}
