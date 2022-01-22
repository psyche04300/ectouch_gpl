<?php echo $this->fetch('library/user_header2.lbi'); ?>

<div class="member_wrap">
    <div class="member_body">
        <div class="member_head">


            <dl class="member_body_message">

                <dt class="member_body_head_title">
                    个人中心
                </dt>

                <a href="<?php echo url('user/msg_list');?>" class="ect-colorf">
                <dt class="member_body_head_message_img">
                    <img src="__TPL__/images/member/member_message.png" alt="">
                </dt>

                <dd class="member_body_head_message_text">
                    信息
                </dd>

                </a>
            </dl>

            <dl class="member_body_head_portrait">
                <dt><img src="themes/new/images/20180612/1-7.png" alt=""></dt>
                <dd>
                    <p><h4><?php echo $this->_var['info']['username']; ?> | <a href="<?php echo url('user/logout');?>"
                                                 class="ect-colorf"><?php echo $this->_var['lang']['label_logout']; ?></a></h4></p>
                    <p><?php echo $this->_var['rank_name']; ?></p>
                    <p><?php echo $this->_var['info']['integral']; ?></p>
                </dd>
            </dl>


        </div>
        <div class="member_body_list">
            <dl>
                <a href="<?php echo url('user/order_list');?>">
                    <dt><img src="themes/new/images/20180612/1-1.png" alt=""></dt>
                    <dd>我的订单</dd>
                </a>
            </dl>
            <dl>
                <a href="<?php echo url('user/address_list');?>">
                    <dt><img src="themes/new/images/20180612/1-2.png" alt=""></dt>
                    <dd>收货地址</dd>
                </a>
            </dl>
            <dl>
                <a href="<?php echo url('user/account_detail');?>">
                <dt><img src="themes/new/images/20180612/1-3.png" alt=""></dt>
                <dd>资金管理</dd>
                </a>
            </dl>
            <dl>
                <a href="<?php echo url('collection_list');?>" class="more">
                <dt><img src="themes/new/images/20180612/1-4.png" alt=""></dt>
                <dd>我的收藏 <img src="themes/new/images/member/left.png" alt=""></dd>
                </a>
            </dl>
            <dl>
                <a href="<?php echo url('user/service');?>">
                <dt><img src="themes/new/images/20180612/1-5.png" alt=""></dt>
                <dd>联系客服</dd>
                </a>
            </dl>
            <dl>
                <a href="<?php echo url('user/profile');?>">
                <dt><img src="themes/new/images/20180612/1-6.png" alt=""></dt>
                <dd>个人资料</dd>
                </a>
            </dl>

        </div>
    </div>

    <footer>
        <nav class="ect-nav index_wrap_footer"><?php echo $this->fetch('library/page_menu2.lbi'); ?></nav>
    </footer>
    <div style="padding-bottom:4.2em;"></div>
</div>
<?php echo $this->fetch('library/page_footer2.lbi'); ?>


</body>
</html>
