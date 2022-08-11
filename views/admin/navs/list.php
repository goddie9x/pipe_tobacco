<div class="navs-manager">
    <div class="navs-manager-header">
        <div class="navs-manager-header-title">
            <h1>Navigation</h1>
        </div>
        <div class="navs-manager-header-actions">
            <a href="<?= url('admin/settings/navs/create') ?>" class="btn btn-primary">
                <i class="fa fa-plus"></i>
                <span>Add</span>
            </a>
        </div>
    </div>
    <div class="navs-manager-body">
        <div class="navs-manager-body-list">
            <?php renderNavRecursive($navs); ?>
        </div>
    </div>
</div>
<?php function renderNavRecursive($navs){
    foreach($navs as $nav){
        echo '<div class="navbar-item px-3 py-1 d-flex text-white bg-secondary align-items-center my-2">';
        echo '<div class="navbar-item-title col-sm-9">';
        echo '<span>'.$nav['nav_name'].'</span>';
        echo '</div>';
        echo '<div class="navbar-item-actions d-flex justify-content-between col-sm-3">';
        echo '<a href="'.url('admin/settings/navs/edit/'.$nav['nav_id']).'" class="btn btn-primary">';
        echo '<i class="fa fa-pencil"></i>';
        echo '<span>Edit</span>';
        echo '</a>';
        echo '<a href="'.url('admin/settings/navs/delete/'.$nav['nav_id']).'" class="btn btn-danger">';
        echo '<i class="fa fa-trash"></i>';
        echo '<span>Delete</span>';
        echo '</a>';
        echo '</div>';
        echo '</div>';
        if(count($nav['children'])>0){
            echo '<div class="navbar-item-children">';
            renderNavRecursive($nav['children']);
            echo '</div>';
        }
    }
}?>
