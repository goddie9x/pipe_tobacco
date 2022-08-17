<div class="new-detail container">
    <h2 class="new-title text-center">
        <?= $news['news_title'] ?>
    </h2>
    <div class="new-content">
        <?= $news['news_content'] ?>
    </div>
    <div class="news-relate">
        <div class="news-right-title">
            <h3>Tin tức liên quan</h3>
        </div>
        <?php if(isset($newsRelative) && count($newsRelative) > 0): ?>
        <?php foreach($newsRelative as $item): ?>
        <a class="row" href="<?= url('news/detail/' . $item['news_path']) ?>">
            <div class="new-list-img col-4">
                <img class="w-100" src="<?= url('public/images/news/' . $item['news_image']) ?>"
                    alt="<?= $item['news_title'] ?>">
            </div>
            <div class="new-list-content col-8">
                <?= $item['news_title'] ?>
            </div>
        </a>
        <?php endforeach; ?>
        <?php endif; ?>
    </div>
</div>