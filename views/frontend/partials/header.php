<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="header d-flex justify-content-between align-items-center">
                <div class="header-top col-md-8 d-flex justify-content-between align-items-center">
                    <div class="header-top-left col-7">
                        <ul class=" d-flex justify-content-evenly align-items-center">
                            <li><a href="<?php echo url('');?>">Home</a></li>
                            <li><a href="<?php echo url('about');?>">About</a></li>
                            <li><a href="<?php echo url('contact');?>">Contact</a></li>
                        </ul>
                    </div>
                    <?php if(!$currenUser): ?>
                    <div class="header-top-right col-5">
                        <ul class=" d-flex justify-content-evenly align-items-center">
                            <li><a href="<?php echo url('auth/login');?>">Login</a></li>
                            <li><a href="<?php echo url('auth/register');?>">Register</a></li>
                        </ul>
                    </div>
                    <?php else : ?>
                    <div class="header-top-right col-5">
                        <ul class=" d-flex justify-content-evenly align-items-center">
                            <li><a href="<?php echo url('auth/logout');?>">Logout</a></li>
                        </ul>
                    </div>
                    <?php endif; ?>
                </div>
                <div class="header-bottom col-md-4">
                    <div class="logo">
                        <a href="{{ url('/') }}"><img src="{{ asset('images/logo.png') }}" alt=""></a>
                    </div>
                    <div class="search">
                        <form action="{{ url('/search') }}" method="get">
                            <input type="text" name="search" placeholder="Search...">
                            <button type="submit"><i class="fa fa-search"></i></button>
                        </form>
                    </div>
                    <div class="cart">
                        <a href="{{ url('/cart') }}"><i class="fa fa-shopping-cart"></i> Cart <span class="cart-count">{{ Cart::count() }}</span></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>