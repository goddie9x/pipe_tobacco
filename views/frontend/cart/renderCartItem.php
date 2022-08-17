<?php
function renderCartItem($cartItem)
{
    return '<div class="cart-item row my-3">
                <a class="image-lg cart-item-image col-md-4 col-12" href="'.url('products/'.$cartItem['product_path']).'">
                    <img class="w-100" src="'.url('public/images/products/'.$cartItem['product_image']).'" alt="">
                </a>
                <div class="cart-item-info col-md-8 col-12">
                    <div class="cart-item-title">
                        <a href="'.url('products/'.$cartItem['product_path']).'">'.$cartItem['product_name'].'</a>
                    </div>
                    <div class="cart-item-price">
                        <span>'.$cartItem['quantity'].'</span>
                        <span>x</span>
                        <span>'.$cartItem['p_cost'].'</span>
                    </div>
                    <div class="cart-item-remove">
                        <a class="btn btn-danger" href="'.url('cart/remove/'.$cartItem['invoice_id']).'"><i class="fa fa-times"></i></a>
                    </div>
                </div>
            </div>';
}