<?php echo $this->fetch('library/user_header2.lbi'); ?>


<style>
    input::-webkit-input-placeholder, textarea::-webkit-input-placeholder {
        color: white;
        font-size:15px;
        font-weight: lighter;
    }

    input:-moz-placeholder, textarea:-moz-placeholder {
        color:white;
        font-size:15px;
        font-weight: lighter;
    }

    input::-moz-placeholder, textarea::-moz-placeholder {
        color:white;
        font-size:15px;
        font-weight: lighter;
    }

    input:-ms-input-placeholder, textarea:-ms-input-placeholder {
        color:white;
        font-size:15px;
        font-weight: lighter;
    }
</style>

<div class="register_wrap">

    <div class="register_title">

        <button class="register_title_back_btn" onclick="back()">
            <span><i class="fa fa-angle-left fa-2x"></i>返回</span>
        </button>

        <div class="register_title_h">用户登录</div>

    </div>
    <div class="register_body">
        <div class="register_body_banner">
            <img src="__TPL__/images/20180611/register/register_banner.png" alt="">
        </div>
        <div class="register_body_footer">
            <form id="contestForm" name="formLogin" action="<?php echo url('user/login');?>" method="post" class="validforms">
                <input type="hidden" name="back_act" value="<?php echo $this->_var['back_act']; ?>" >

                <div class="tb-user"><p></p><input id="account_number"
                                                   placeholder="<?php echo $this->_var['lang']['username']; ?>/<?php echo $this->_var['lang']['mobile']; ?>/<?php echo $this->_var['lang']['email']; ?>"
                                                   name="username" type="text"
                                                   class="inputBg" id="username" datatype="*"></div>

                <div class="tb-ps"><p></p><input id="login_password"
                                                 placeholder="<?php echo $this->_var['lang']['label_password']; ?>" name="password" type="password"
                                                 class="inputBg"
                                                 datatype="*6-16"/></div>

                <?php if ($this->_var['enabled_captcha']): ?>

                <div class="input-text code"><b><?php echo $this->_var['lang']['comment_captcha']; ?></b><span>
             <input name="captcha" type="text" placeholder="<?php echo $this->_var['lang']['comment_captcha']; ?>">
             </span><img src="<?php echo url('Public/captcha', array('rand'=>$this->_var['rand']));?>" alt="captcha"
                         class="img-yzm pull-right" onClick="this.src='<?php echo url('public/captcha');?>&t='+Math.random()"/>
                </div>

                <?php endif; ?>
                <div class="tb-submit">
                    <input type="submit" value="登录" id="log_in">
                </div>
            </form>
            <div class="register_body_login">
                <span><a href="<?php echo url('user/get_password_phone');?>" style="color: white"><?php echo $this->_var['lang']['forgot_password']; ?></a></span>
                <span><a href="<?php echo url('user/register');?>" style="color: white"><?php echo $this->_var['lang']['free_registered']; ?></a></span>
            </div>
            <div class="register_body_footer_list">
                <?php echo $this->_var['lang']['third_login']; ?>
                <ul class="register_body_disanfang">
                    <li><a href="<?php echo url('user/third_login',array('type'=>'wx'));?>"><img
                            src="__TPL__/images/register/weixin_logo.png"></a></li>
                    <li><a href="<?php echo url('user/third_login',array('type'=>'qq'));?>"><img
                            src="__TPL__/images/register/QQ_logo.png"></a></li>
                    <li><a href="<?php echo url('user/third_login',array('type'=>'sina'));?>"><img
                            src="__TPL__/images/register/wbo_logo.png"></a></li>
                </ul>
            </div>
        </div>
    </div>

    <script>
        function back() {

          // alert('返回');
          window.history.go(-1);
        }
    </script>
</div>
<?php echo $this->fetch('library/search.lbi'); ?>
<?php echo $this->fetch('library/page_footer2.lbi'); ?>

