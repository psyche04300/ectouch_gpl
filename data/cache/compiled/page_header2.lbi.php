<!DOCTYPE html>
<html lang="zh-CN">
<head>
<meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" >
<meta name="Keywords" content="<?php echo $this->_var['meta_keywords']; ?>" >
<meta name="Description" content="<?php echo $this->_var['meta_description']; ?>" >
<?php if ($this->_var['auto_redirect']): ?>
<meta http-equiv="refresh" content="3;URL=<?php echo $this->_var['message']['back_url']; ?>" />
<?php endif; ?>
<title><?php echo $this->_var['page_title']; ?></title>
    <link rel="stylesheet" type="text/css" href="__TPL__/css/ywm.css">
    <link rel="stylesheet" type="text/css" href="__TPL__/css/reset.css">
    <script src="__TPL__/js/rem.js"></script>
    <script src="__TPL__/js/jquery-1.8.3.min.js"></script>
    <script src="__TPL__/js/jquery-addShopping.js"></script>


</head><body>
<div class="index_wrap">

    <div id="" class="index_wrap_head">
        <ul>
            <li>
                <img src="__TPL__/images/20180602/1-13.png" alt="">

            </li>

            <li>
                <form action="/mobile/index.php?m=default&amp;c=category&amp;a=index" method="post" id="searchForm" name="searchForm">
                    <!--<img src="__TPL__/images/index/index_magnifying_glass.png" alt="">-->
                    <img src="__TPL__/images/20180602/1-12.png" alt="">
                    <!--<input type="text" name="keywords" placeholder="搜索商品" />-->
                    <input type="text" name="keywords" placeholder="" />
                </form>
            </li>

            
            <li>
                <a id="shop_cart" href="<?php echo url('flow/cart');?>">
                    <!--<img src="__TPL__/images/index/shopping_card.png" alt="">-->
                    <img src="__TPL__/images/20180602/1-11.png" alt="">
                </a>
            </li>

        </ul>
    </div>