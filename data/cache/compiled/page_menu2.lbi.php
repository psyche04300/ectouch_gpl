<ul class="ect-diaplay-box text-center index_wrap_footer">

  <li class="ect-box-flex">
      <a href="<?php echo url('index/index');?>">
          <!--<img src="__TPL__/images/index/index_home<?php if (CONTROLLER_NAME == 'Index' && ACTION_NAME == 'index'): ?>_sel<?php endif; ?>.png" alt=""></img>-->
          <img src="__TPL__/images/20180602/1-2<?php if (CONTROLLER_NAME == 'Index' && ACTION_NAME == 'index'): ?>_sel<?php endif; ?>.png" alt=""></img>
          <p <?php if (CONTROLLER_NAME == 'Index' && ACTION_NAME == 'index'): ?>style="color: #14b27c"<?php endif; ?>><?php echo $this->_var['lang']['home']; ?></p>
      </a>
  </li>

  <li class="ect-box-flex">
      <a href="<?php echo url('category2/index');?>">
          <!--<img src="__TPL__/images/index/index_fenlei<?php if (CONTROLLER_NAME == 'Category2' && ACTION_NAME == 'index'): ?>_sel<?php endif; ?>.png" alt=""></img>-->
          <img src="__TPL__/images/20180602/1-5<?php if (CONTROLLER_NAME == 'Category2' && ACTION_NAME == 'index'): ?>_sel<?php endif; ?>.png" alt=""></img>
          <p <?php if (CONTROLLER_NAME == 'Category2' && ACTION_NAME == 'index'): ?>style="color: #14b27c"<?php endif; ?>><?php echo $this->_var['lang']['category']; ?></p>
      </a>
  </li>
  <li class="ect-box-flex">
      <a href="/mobile/index.php?m=default&c=category&a=index&id=0&display=grid&brand=0&price_min=0&price_max=0&filter_attr=0&sort=goods_id&order=DESC#goods_list">
          <!--<img src="__TPL__/images/index/index_tuangou<?php if (CONTROLLER_NAME == 'Category' && ACTION_NAME == 'index'): ?>_sel<?php endif; ?>.png" alt=""></img>-->
          <img src="__TPL__/images/20180602/1-10<?php if (CONTROLLER_NAME == 'Category' && ACTION_NAME == 'index'): ?>_sel<?php endif; ?>.png" alt=""></img>
          <p <?php if (CONTROLLER_NAME == 'Category' && ACTION_NAME == 'index'): ?>style="color: #14b27c"<?php endif; ?>>新品上市</p>
      </a>
  </li>
  <li class="ect-box-flex">
      <a href="<?php echo url('flow/cart');?>">
          <!--<img src="__TPL__/images/index/index_gouwuche<?php if (CONTROLLER_NAME == 'Flow' && ACTION_NAME == 'cart'): ?>_sel<?php endif; ?>.png" alt=""></img>-->
          <img src="__TPL__/images/20180602/1-7<?php if (CONTROLLER_NAME == 'Flow' && ACTION_NAME == 'cart'): ?>_sel<?php endif; ?>.png" alt=""></img>
          <p <?php if (CONTROLLER_NAME == 'Flow' && ACTION_NAME == 'cart'): ?>style="color: #14b27c"<?php endif; ?>><?php echo $this->_var['lang']['shopping_cart']; ?></p><p id="position_p"><?php echo $this->_var['cart_num']; ?></p>
      </a>
  </li>
  <li class="ect-box-flex">
      <a href="<?php echo url('user/index');?>">
          <!--<img src="__TPL__/images/index/index_wode<?php if (CONTROLLER_NAME == 'User' && ACTION_NAME == 'index'): ?>_sel<?php endif; ?>.png" alt=""></img>-->
          <img src="__TPL__/images/20180602/1-3<?php if (CONTROLLER_NAME == 'User' && ACTION_NAME == 'index'): ?>_sel<?php endif; ?>.png" alt=""></img>
          <p <?php if (CONTROLLER_NAME == 'User' && ACTION_NAME == 'index'): ?>style="color: #14b27c"<?php endif; ?>>我的</p>
      </a>
  </li>
</ul>
