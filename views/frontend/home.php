<?php include_once './views/frontend/products/renderItem.php'; ?>
<div class="container">
    <div class="row">
        <?php include_once './views/frontend/slide.php'; ?>
        <div class="col-md-12 my-3">
            <h1>Welcome to Pipe Tobacco</h1>
        </div>
        <div class="col-md-12 my-3">
            <h2 class="text-center">Sản phẩm nổi bật</h2>
            <div class="list-product list-product-hot swiper">
                <div class="swiper-wrapper">
                    <?php foreach ($productsHot as $item): ?>
                    <div class="swiper-slide">
                        <?= renderProductItem($item) ?>
                    </div>
                    <?php endforeach; ?>
                </div>
                <div class="swiper-button-prev"></div>
                <div class="swiper-button-next"></div>
                <div class="swiper-pagination"></div>
            </div>
        </div>
        <?php include_once './views/frontend/products/list.php'; ?>
        <?php include_once './views/frontend/brand.php'; ?>
    </div>
</div>
<script>
    const swiperOption = {
            slidesPerView: 5,
            spaceBetween: 10,
            lazy: true,
            loop: true,
            autoplay: {
                delay: 2500,
                disableOnInteraction: false,
            },
            loopFillGroupWithBlank: true,
            pagination: {
                el: ".swiper-pagination",
                clickable: true,
            },
            navigation: {
                nextEl: ".swiper-button-next",
                prevEl: ".swiper-button-prev",
                clickable: true,
            },
            breakpoints: {
                640: {
                    slidesPerView: 2,
                    spaceBetween: 20,
                },
                768: {
                    slidesPerView: 4,
                    spaceBetween: 40,
                },
                1024: {
                    slidesPerView: 5,
                    spaceBetween: 50,
                },
            },
        };
    window.onload = function() {
        let mainSwiper = new Swiper(".list-product", swiperOption);
        let productSwiper = new Swiper(".main-slide", Object.assign({}, swiperOption, {
            slidesPerView: 1,
            spaceBetween: 20,
            breakpoints: {
            },
        }));
    }
</script>
