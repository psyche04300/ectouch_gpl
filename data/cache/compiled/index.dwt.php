<?php echo $this->fetch('library/page_header2.lbi'); ?>



    <div class="index_wrap_body">
        <div class="index_wrap_banner">

            
            <?php 
$k = array (
  'name' => 'ads',
  'id' => '1',
  'num' => '1',
);
echo $this->_echash . $k['name'] . '|' . serialize($k) . $this->_echash;
?>
            <!--<img src="__TPL__/images/index/index_banner.png">-->

            

        </div>

        <div class="index_body_ads_img_one" style="width: 93%;margin: 0.2rem auto 0 auto;">
            
            <?php 
$k = array (
  'name' => 'ads',
  'id' => '2',
  'num' => '1',
);
echo $this->_echash . $k['name'] . '|' . serialize($k) . $this->_echash;
?>
        </div>


        <div class="index_body_list">

            <ul class="row ect-row-nav">
                <?php $_from = $this->_var['categories']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'cat');$this->_foreach['cate'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['cate']['total'] > 0):
    foreach ($_from AS $this->_var['cat']):
        $this->_foreach['cate']['iteration']++;
?>
                <a href="<?php echo $this->_var['cat']['url']; ?>">

                    <li class="col-sm-3 col-xs-3"><i>

                        <img src="<?php echo $this->_var['cat']['cat_image']; ?>">
                    </i>
                        <?php if ($this->_foreach['cate']['iteration'] == 1): ?>
                        <p class="text-center" style="color:red;font-weight: bold"><?php echo $this->_var['cat']['cat_name']; ?></p>
                        <?php else: ?>
                        <p class="text-center"><?php echo $this->_var['cat']['cat_name']; ?></p>
                        <?php endif; ?>
                    </li>
                </a>
                <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
            </ul>

        </div>

        <style>
            .fui-picturew {
                height: auto;
                overflow: hidden;
                width: 100%;
                padding: 0 2px;
                margin-bottom: -1px;
            }
            .fui-picturew .item {
                height: auto;
                display: block;
                float: left;
                margin-bottom: -1px;
                width: 48.5% !important;
            }
            .fui-picturew .item img {
                display: block;
                max-width: 100%;
                max-height: 100%;
                width: 100%;
                border: 0;
                padding: 0;
                outline: none;
            }
        </style>
        
        <!--
        <div class="back_gonggao">
            <img src="__TPL__/images/index/gg.png" alt=""><span>公告：</span>
        </div>
        -->
        <div class="fui-picturew row-2" style="padding: 0px 2px 0 2px; ">


            <div class="item" style="padding: 0px 2px;">

                <a href="http://shop.jigongbao.com/new/app/index.php?i=1&c=entry&m=ewei_shopv2&do=mobile&r=groups" data-nocache="true"><img src="http://shop.jigongbao.com/new/attachment/images/1/2018/10/Oc62Cz3zFcfRrxJ54zjfVl2JX33Kr4.jpg"></a>

            </div>


            <div class="item" style="padding: 0px 2px;">

                <a href="http://shop.jigongbao.com/new/app/index.php?i=1&c=entry&m=ewei_shopv2&do=mobile&r=bargain" data-nocache="true"><img src="http://shop.jigongbao.com/new/attachment/images/1/2018/10/mPhjMhwTVPTh5x2XTpTXGj41GGT0t1.png"></a>

            </div>


        </div>
        <div class="index_body_img_one">
            
            <?php 
$k = array (
  'name' => 'ads',
  'id' => '3',
  'num' => '1',
);
echo $this->_echash . $k['name'] . '|' . serialize($k) . $this->_echash;
?>
            <!--<img src="__TPL__/images/index/index_first_img.png" alt="">-->
        </div>

        <!--
        <div class="index_kbbk">口碑爆款</div>
        -->


        <div class="index_body_scroll_img_two">

            <?php $_from = $this->_var['best_goods']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'hot');if (count($_from)):
    foreach ($_from AS $this->_var['hot']):
?>

            <div class="index_body_img_two">
                <div class="index_body_img_two_left">
                    <img src="<?php echo $this->_var['hot']['goods_img']; ?>" alt="">
                </div>
                <div class="index_body_img_two_right">
                    <dl>
                        <dt>
                            <div class="hot_name"><?php echo $this->_var['hot']['name']; ?></div>
                        </dt>
                        <dd>
                            <p><i></i> <span><?php echo $this->_var['hot']['shop_price']; ?></span> <span>/</span> <span>箱</span></p>
                            <div class="btn"><a href="javascript:addToCart_quick(<?php echo $this->_var['hot']['id']; ?>);"><input class="cart" type="button" value="加入购物车"></a></div>
                        </dd>
                    </dl>
                </div>
            </div>

            <script type="text/javascript">
              $(function(){
                $cart_count=0;
                $('.cart').shoping({
                  endElement:"#position_p",
                  iconCSS:"",
                  iconImg:"__TPL__/images/index/shopping_card.png",
                  endFunction:function(element){
                        // alert("加入购物车成功！");
                    console.log($cart_count);
                    return false;
                  }
                })
              });
            </script>

            <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>

        </div>


        <div class="index_body_img_one">
            
            <?php 
$k = array (
  'name' => 'ads',
  'id' => '4',
  'num' => '1',
);
echo $this->_echash . $k['name'] . '|' . serialize($k) . $this->_echash;
?>
        </div>

        <div class="index_body_scroll_img_two">

            <?php $_from = $this->_var['list01']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'it');if (count($_from)):
    foreach ($_from AS $this->_var['it']):
?>

            <div class="index_body_img_two">
                <div class="index_body_img_two_left">
                    <img src="<?php echo $this->_var['it']['goods_img']; ?>" alt="">
                </div>
                <div class="index_body_img_two_right">
                    <dl>
                        <dt>
                            <div class="hot_name"><?php echo $this->_var['it']['name']; ?></div>
                        </dt>
                        <dd>
                            <p><i></i> <span><?php echo $this->_var['it']['shop_price']; ?></span> <span>/</span> <span>箱</span></p>
                            <div class="btn"><a href="javascript:addToCart_quick(<?php echo $this->_var['hot']['id']; ?>);"><input class="cart" type="button" value="加入购物车"></a></div>
                        </dd>
                    </dl>
                </div>
            </div>

            <script type="text/javascript">
              $(function(){
                $cart_count=0;
                $('.cart').shoping({
                  endElement:"#position_p",
                  iconCSS:"",
                  iconImg:"__TPL__/images/index/shopping_card.png",
                  endFunction:function(element){
                    // alert("加入购物车成功！");
                    console.log($cart_count);
                    return false;
                  }
                })
              });
            </script>

            <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>

        </div>


    </div>

    <footer>

        <nav class="ect-nav index_wrap_footer">
            <?php echo $this->fetch('library/page_menu2.lbi'); ?>
        </nav>

    </footer>

    <div style="padding-bottom:4.2em;"></div>

</div>
<?php echo $this->fetch('library/search.lbi'); ?>
<?php echo $this->fetch('library/page_footer2.lbi'); ?>
<script type="text/javascript" src="__PUBLIC__/js/jquery.json.js" ></script>
<script type="text/javascript" src="__PUBLIC__/js/common.js?333"></script>
</body></html>
