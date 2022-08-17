<div class="news-right">
    <div class="news-right-title">
        <h3>Tin tức</h3>
    </div>
    <ul class="new-list">
        <?php if(isset($news) && count($news) > 0): ?>
        <?php foreach($news as $item): ?>
        <li>
            <a href="<?= url('news/detail/' . $item['news_id']) ?>">
                <?= $item['news_title'] ?>
            </a>
        </li>
        <?php endforeach; ?>
        <?php endif; ?>
    </ul>
</div>
