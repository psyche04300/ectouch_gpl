

<?php if ($this->_var['goods']): ?>
<ul id="J_ItemList" class="show">
    <?php $_from = $this->_var['goods']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'good');if (count($_from)):
    foreach ($_from AS $this->_var['good']):
?>
    <li>
        <a href="<?php echo $this->_var['good']['url']; ?>" title="<?php echo $this->_var['good']['act_name']; ?>" style="color:#060606">
        <img src="<?php echo $this->_var['good']['goods_thumb']; ?>" alt="">

        <p><?php echo $this->_var['good']['act_name']; ?></p>
        <p><i></i> <span><?php echo $this->_var['good']['market_price']; ?></span> <span>/</span> <span>箱</span></p>
        </a>
    </li>

    <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
</ul>
<?php endif; ?>

