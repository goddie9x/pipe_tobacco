<div class="container">
    <div class="row">
        <div class="col-4">
            <?php include_once './views/frontend/products/categories/left.php'; ?>
        </div>
        <div class="col-8">
            <?php 
            if($isCategories){
                include_once './views/frontend/products/list.php';
            }
            else{
                include_once './views/frontend/products/categories/list.php';
            } ?>
        </div>
    </div>
</div>