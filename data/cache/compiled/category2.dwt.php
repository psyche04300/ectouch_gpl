<?php echo $this->fetch('library/page_header2.lbi'); ?>

<style>
    .classify_body_list ul li p a {
        color: black;
    }
</style>

<div class="classify_body">
    <div class="classify_body_banner">
        <?php 
$k = array (
  'name' => 'ads',
  'id' => '1',
  'num' => '1',
);
echo $this->_echash . $k['name'] . '|' . serialize($k) . $this->_echash;
?>
    </div>
    <div class="classify_body_list">
        <div class="classify_body_list_left">
            <ul class="J_LsitName">

                <li   id="group_buy" class="select">
                    <a href="javascript:void(0)">

                        <img src="__TPL__/images/20180602/1-14.png" alt="">
                        <p>会员日</p>
                    </a>
                </li>

                <?php $_from = $this->_var['categories']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'cat');if (count($_from)):
    foreach ($_from AS $this->_var['cat']):
?>

                <li <?php if (($this->_foreach['no']['iteration'] - 1) == 0): ?>class="tab"<?php endif; ?> id="<?php echo $this->_var['cat']['id']; ?>">
                <a href="javascript:void(0)">

                    <img src="<?php echo $this->_var['cat']['cat_image']; ?>" alt="">
                    <p><?php echo sub_str(htmlspecialchars($this->_var['cat']['name']),10,false); ?></p>
                </a>
                </li>

                <?php $_from = $this->_var['cat']['cat_id']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'child');if (count($_from)):
    foreach ($_from AS $this->_var['child']):
?>
                <li  id="<?php echo $this->_var['child']['id']; ?>">
                    <a href="javascript:void(0)">

                        <img src="<?php echo $this->_var['child']['cat_image']; ?>" alt="">
                        <p><?php echo sub_str(htmlspecialchars($this->_var['child']['name']),10,false); ?></p>
                    </a>
                </li>
                <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>

                <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>


            </ul>

            <!--
            <ul>
                <li>
                    <a href="/mobile/index.php?m=default&c=exchange&a=index">
                        <img src="__TPL__/images/index/pink/index_cfqj.png" alt="">
                        <p>积分兑换</p>
                    </a>
                </li>
            </ul>
            -->

        </div>

        <div class="classify_body_list_right">
            <div id="more" class="J_ItemRight" style="text-align: center">
                <img src="__TPL__/images/loader.gif" />
            </div>
        </div>


    </div>


</div>

<footer>
    <nav class="ect-nav index_wrap_footer">
        <?php echo $this->fetch('library/page_menu2.lbi'); ?>
    </nav>
</footer>

<div style="padding-bottom:4.2em;"></div>

<?php echo $this->fetch('library/page_footer2.lbi'); ?>

<script type="text/javascript">
  function get(id) {
    if (!id) {
      id = $(this).attr('id');
    }
    $.ajax({
      type: "GET",
      url: "/mobile/index.php?m=default&c=index&a=ajax_index_goods" + "&id=" + id,
      beforeSend: function () {
        $("#more").html("<img src='/mobile/themes/default/images/loader.gif' />");
      },
      success: function (msg) {
        $('#more').html(msg);
      }
    });
  }
  function get2() {
    $.ajax({
      type: "GET",
      url: "/mobile/index.php?m=default&c=index&a=ajax_index_group_buy_goods",
      beforeSend: function () {
        $("#more").html("<img src='/mobile/themes/default/images/loader.gif' />");
      },
      success: function (msg) {
        $('#more').html(msg);
      }
    });
  }
  $(function () {

    get2();
    $(".J_LsitName li").click(function () {
      $(this).addClass('tab').siblings().removeClass('tab');
      if($(this).attr('id')=='group_buy'){
        get2();
      }else{
        get($(this).attr('id'));
      }
    });
  });
</script>
<!--<script>
    $(function(){
        $(".classify_body_list_left li").click(function(){
            var i=$(this).index();
            $(this).addClass("tab").siblings().removeClass("tab");
            $(".classify_body_list_right ul").eq(i).addClass("show").siblings().removeClass("show")
        })
    })
</script>-->
</body></html>
