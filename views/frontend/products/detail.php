<?php include_once 'views/frontend/products/renderItem.php'; ?>
<div class="container-fruid product-detail-page">
    <div class="row">
        <div class="col-md-9 my-3 ps-5">
            <div class="product-detail d-flex flex-wrap">
                <div class="my-3 product-detail-img col-6 px-3">
                    <div class="product-detail-img-slide swiper">
                        <div class="swiper-wrapper">
                            <?php $imageSlide = explode(',', $product['product_image_slide']); ?>
                            <?php foreach ($imageSlide as $item): ?>
                            <div class="swiper-slide">
                                <img class="w-100" src="<?= url('public/images/products/' . $item) ?>"
                                    alt="<?= $product['product_name'] ?>">
                            </div>
                            <?php endforeach; ?>
                        </div>
                        <div class="swiper-button-prev"></div>
                        <div class="swiper-button-next"></div>
                        <div class="swiper-pagination"></div>
                    </div>
                    <div class="product-detail-thumb-img-slide swiper">
                        <div class="swiper-wrapper">
                            <?php foreach ($imageSlide as $item): ?>
                            <div class="swiper-slide">
                                <img class="w-100" src="<?= url('public/images/products/' . $item) ?>"
                                    alt="<?= $product['product_name'] ?>">
                            </div>
                            <?php endforeach; ?>
                        </div>
                        <div class="swiper-button-prev"></div>
                        <div class="swiper-button-next"></div>
                        <div class="swiper-pagination"></div>
                    </div>
                </div>
                <div class="my-3 product-detail-info col-6 px-3">
                    <h4 class="product-detail-info-title">
                        <?= $product['product_name'] ?>
                    </h1>
                    <div class="product-detail-info-price">
                        <span class="product-detail-info-price-old">
                            <?= number_format($product['unit_cost']*(1 - $product['discount']/100), 0, ',', '.') ?>
                        </span>
                        <span class="product-detail-info-price-new">
                            <?= number_format($product['unit_cost'], 0, ',', '.') ?>
                        </span>
                    </div>
                    <div class="product-detail-info-description">
                        <?= $product['product_description'] ?>
                    </div>
                    <div class="product-detail-info-button">
                        <button class="btn btn-primary">Thêm vào giỏ hàng</button>
                    </div>
                </div>
                <div class="my-3 col-12 product-content">
                    <?= $product['product_content'] ?>
                </div>
            </div>
        </div>
        <div class="col-md-3 my-3 pe-5 news-minimal">
            <?php include_once './views/frontend/news/index.php'; ?>
        </div>
        <?php if(count($productsRelative)>0):?>
        <div class="col-12 my-3 px-5">
            <div class="product-relative swiper">
                <h3 class="product-relative-title text-center">
                    Sản phẩm liên quan
                </h3>
                <div class="swiper-wrapper product-relative-content">
                    <?php foreach ($productsRelative as $productRelative): ?>
                    <div class="swiper-slide">
                        <?= renderProductItem($productRelative) ?>
                        <?php endforeach; ?>
                    </div>
                </div>
                <div class="swiper-button-prev"></div>
                <div class="swiper-button-next"></div>
                <div class="swiper-pagination"></div>
                <div class="view-more text-center">
                    <a href="<?= url($category['category_path']) ?>">Xem thêm <i
                            class="fa fa-angle-double-right"></i></a>
                </div>
            </div>
        </div>
        <?php endif;?>
    </div>
</div>
<script>
    window.onload = function () {
        let productDetailImgSlide = new Swiper('.product-detail-img-slide', {
            slidesPerView: 1,
            spaceBetween: 10,
            loop: true,
            autoplay: {
                delay: 3000,
                disableOnInteraction: false,
            },
            pagination: {
                el: '.product-detail-img-slide .swiper-pagination',
                clickable: true,
            },
            navigation: {
                nextEl: '.product-detail-img-slide .swiper-button-next',
                prevEl: '.product-detail-img-slide .swiper-button-prev',
            },
        });
        let productDetailThumbImgSlide = new Swiper('.product-detail-thumb-img-slide', {
            slidesPerView: 3,
            spaceBetween: 10,
            loop: true,
            autoplay: {
                delay: 3000,
                disableOnInteraction: false,
            },
            pagination: {
                el: '.product-detail-thumb-img-slide .swiper-pagination',
                clickable: true,
            },
            navigation: {
                nextEl: '.product-detail-thumb-img-slide .swiper-button-next',
                prevEl: '.product-detail-thumb-img-slide .swiper-button-prev',
            },
            thumbs: {
                swiper: productDetailImgSlide,
            },
        });
    }
</script>