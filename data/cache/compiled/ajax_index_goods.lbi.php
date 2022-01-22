
<?php if ($this->_var['goods']): ?>
<ul id="J_ItemList" class="show">
<?php $_from = $this->_var['goods']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'goods_0_42947200_1642775727');if (count($_from)):
    foreach ($_from AS $this->_var['goods_0_42947200_1642775727']):
?>
<li>
    <a href="<?php echo $this->_var['goods_0_42947200_1642775727']['url']; ?>" title="<?php echo $this->_var['goods_0_42947200_1642775727']['name']; ?>" style="color:#060606">
<img src="<?php echo $this->_var['goods_0_42947200_1642775727']['thumb']; ?>" alt="">

    <p><?php echo $this->_var['goods_0_42947200_1642775727']['name']; ?></p>
    <p><i></i> <span><?php echo $this->_var['goods_0_42947200_1642775727']['shop_price']; ?></span> <span>/</span> <span>箱</span></p>
    </a>
</li>

<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
</ul>
<?php endif; ?>
