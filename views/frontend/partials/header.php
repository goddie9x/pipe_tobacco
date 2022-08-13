<div class="text-white bg-secondary container-fluid header shadow rounded">
    <div class="row mx-0">
        <div class="col-md-12">
            <div class="d-flex justify-content-between align-items-center">
                <div class="header-top col-md-10 d-flex justify-content-between align-items-center">
                    <div class="header-logo col-1 p-2">
                        <a href="<?= url('/') ?>">
                            <img class="w-100" src="<?= url('public/images/' . @$site['site_logo']) ?>" alt="">
                        </a>
                    </div>
                    <div class="header-top-left col-8">
                        <ul class=" d-flex justify-content-evenly align-items-center">
                            <?php if(count($headerNav)>0){
                                renderNav($headerNav);
                            }?>
                        </ul>
                    </div>
                    <?php if(!$currenUser): ?>
                    <div class="header-top-right col-3">
                        <ul class=" d-flex justify-content-evenly align-items-center">
                            <li><a href="<?=@url('auth/login');?>">Login</a></li>
                            <li><a href="<?=@url('auth/register');?>">Register</a></li>
                        </ul>
                    </div>
                    <?php else : ?>
                    <div class="header-top-right col-3">
                        <ul class=" d-flex justify-content-evenly align-items-center">
                            <li class="hearder-nav-item">
                                <a class="dropdown-toggle" href="<?=@url('account');?>" >
                                    <?php if($currenUser['user_image']): ?>
                                    <img width="50" height="50" src="<?=url('public/images/users/'.$currenUser['user_image'])?>" alt="<?=@$currenUser['user_name']?>"data-bs-toggle="tooltip" data-bs-placement="top" title="<?=@$currenUser['user_name']?>">
                                    <?php else: ?>
                                    <?=@$currenUser['user_name']?>
                                    <?php endif; ?>
                                </a>
                                <ul class="dropdown-menu bg-secondary shadow rounded">
                                    <li><a href="<?=@url('account');?>">My Account</a></li>
                                    <li><a href="<?=@url('auth/logout');?>">Logout</a></li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                    <?php endif; ?>
                </div>
                <div class="header-bottom col-md-2">
                    <ul class=" d-flex justify-content-evenly align-items-center">
                        <li class="hearder-nav-item">
                            <a href="<?=@url('cart');?>" class="dropdown-toggle"><i class="fas fa-shopping-cart"></i></a>
                            <?php if(isset($cart)&&count($cart)>0): ?>
                            <ul class="cart-list dropdown-menu bg-secondary shadow rounded">
                                <?php foreach($cart as $item): ?>
                                <li class="cart-item">
                                    <div class="cart-item-img">
                                        <img src="<?=@url('public/uploads/'.$item['image']);?>" alt="">
                                    </div>
                                    <div class="cart-item-info">
                                        <div class="cart-item-name"><?=$item['name']?></div>
                                        <div class="cart-item-price"><?=$item['price']?></div>
                                    </div>
                                </li>
                                <?php endforeach; ?>
                            </li>
                            <?php endif; ?>
                        <li class="hearder-nav-item position-relative">
                            <a href="<?=@url('search');?>" class="dropdown-toggle"><i class="fas fa-search"></i></a>
                            <form class="dropdown-menu bg-secondary shadow rounded header-search-bar" action="<?=@url('search');?>" method="get">
                                <input type="text" name="q" class="form-control" placeholder="Search">
                            </form>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
 function renderNav($navs){
    while($nav = array_shift($navs)){
        if(isset($nav['children']) && count($nav['children'])>0){
            echo '<li class="dropdown hearder-nav-item btn px-1">';
            echo '<a href="'.@url($nav['nav_path']).'" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">'.$nav['nav_name'].'<span class="caret"></span></a>';
            echo '<ul class="dropdown-menu bg-secondary shadow rounded">';
            renderNav($nav['children']);
            echo '</ul>';
            echo '</li>';
        }else{
            echo '<li class="hearder-nav-item btn px-1"><a  href="'.@url($nav['nav_path']).'">'.$nav['nav_name'].'</a></li>';
        }
    }
}?>
