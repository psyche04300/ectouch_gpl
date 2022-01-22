<ul class="ect-diaplay-box text-center">
  <li class="ect-box-flex">
      <a href="<?php echo url('index/index');?>">

          <!--<i class="ect-icon ect-icon-home"></i>-->

          <img src="__TPL__/images/20180602/1-2.png" alt="" />
          <p><?php echo $this->_var['lang']['home']; ?></p>

      </a>
  </li>
  <li class="ect-box-flex">
      <a href="<?php echo url('category2/index');?>">

          <!--<i class="ect-icon ect-icon-cate"></i>-->

          <img src="__TPL__/images/20180602/1-5.png" alt="" />
          <p><?php echo $this->_var['lang']['category']; ?></p>

      </a>
  </li>
  <li class="ect-box-flex">
      <a href="/mobile/index.php?m=default&c=category&a=index&id=0&display=grid&brand=0&price_min=0&price_max=0&filter_attr=0&sort=goods_id&order=DESC#goods_list">

          <!--<i class="ect-icon ect-icon-search"></i>-->

          <img src="__TPL__/images/20180602/1-10<?php if (CONTROLLER_NAME == 'Category' && ACTION_NAME == 'index'): ?>_sel<?php endif; ?>.png" alt="" />
          <p <?php if (CONTROLLER_NAME == 'Category' && ACTION_NAME == 'index'): ?>style="color: #14b27c"<?php endif; ?>>新品上市</p>

      </a>
  </li>
  <li class="ect-box-flex">
      <a href="<?php echo url('flow/cart');?>">

          <!--<i class="ect-icon ect-icon-flow"></i>-->

          <img src="__TPL__/images/20180602/1-7.png" alt="" />
          <p><?php echo $this->_var['lang']['shopping_cart']; ?></p>

      </a>
  </li>
  <li class="ect-box-flex">
      <a href="<?php echo url('user/index');?>">

          <!--<i class="ect-icon ect-icon-user"></i>-->

          <img src="__TPL__/images/20180602/1-3.png" alt="" />
          <p><?php echo $this->_var['lang']['user_center']; ?></p>

      </a>
  </li>
</ul>
