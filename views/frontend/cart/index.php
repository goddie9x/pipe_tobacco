<?php include_once 'views/frontend/cart/renderCartItem.php'; ?>
<div class="cart-list container my-3">
    <h1 class="my-3">
        <i class="fas fa-shopping-cart"></i>
        <span class="cart-count"><?=count($cart)?></span>
        Giỏ hàng
    </h1>
    <?php if(count($cart)>0): ?>
    <?php foreach($cart as $item): ?>
    <?=renderCartItem($item)?>
    <?php endforeach; ?>
    <?php else: ?>
    <div class="cart-empty">
        <p>Giỏ hàng của bạn đang trống</p>
        <a href="<?=url('')?>">Tiếp tục mua hàng</a>
    </div>
    <?php endif; ?>
</div>