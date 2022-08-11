<div class="admin-left-menu">
    <ul class="ps-0 pe-1">
        <li class="my-0 btn btn-secondary rounded-0 btn-lg  shadow p-3 d-block">
            <a  class="w-100 d-block" href="<?=@url('admin'); ?>">
                <i class="fa fa-tachometer"></i>
                <span>Dashboard</span>
            </a>
        </li>
        <li class="my-0">
            <button class="w-100 dropdown-toggle btn btn-secondary rounded-0 btn-lg  shadow p-3 d-block" data-bs-toggle="dropdown" aria-expanded="false">
                <i class="fa fa-users"></i>
                <span>Users</span>
            </button>
            <ul class="dropdown-menu">
                <li class="dropdown-item">
                    <a  class="w-100 d-block" href="<?=@url('admin/users'); ?>">
                        <i class="fa fa-list"></i>
                        <span>List</span>
                    </a>
                </li>
                <li class="dropdown-item">
                    <a  class="w-100 d-block" href="<?=@url('admin/users/add'); ?>">
                        <i class="fa fa-plus"></i>
                        <span>Add</span>
                    </a>
                </li>
            </ul>
        </li>
        <li class="my-0">
            <button class="w-100 dropdown-toggle btn btn-secondary rounded-0 btn-lg  shadow p-3 d-block" data-bs-toggle="dropdown" aria-expanded="false">
                <i class="fa fa-list"></i>
                <span>Categories</span>
            </button>
            <ul class="dropdown-menu">
                <li class="dropdown-item">
                    <a  class="w-100 d-block" href="<?=@url('admin/categories'); ?>">
                        <i class="fa fa-list"></i>
                        <span>List</span>
                    </a>
                </li>
                <li class="dropdown-item">
                    <a  class="w-100 d-block" href="<?=@url('admin/categories/add'); ?>">
                        <i class="fa fa-plus"></i>
                        <span>Add</span>
                    </a>
                </li>
            </ul>
        </li>
        <li class="my-0">
            <button class="w-100 dropdown-toggle btn btn-secondary rounded-0 btn-lg  shadow p-3 d-block" data-bs-toggle="dropdown" aria-expanded="false">
                <i class="fa fa-list"></i>
                <span>Products</span>
            </button>
            <ul class="dropdown-menu ">
                <li class="dropdown-item">
                    <a  class="w-100 d-block" href="<?=@url('admin/products'); ?>">
                        <i class="fa fa-list"></i>
                        <span>List</span>
                    </a>
                </li>
                <li class="dropdown-item">
                    <a  class="w-100 d-block" href="<?=@url('admin/products/add'); ?>">
                        <i class="fa fa-plus"></i>
                        <span>Add</span>
                    </a>
                </li>
            </ul>
        </li>
        <li class="my-0">
            <button class="w-100 dropdown-toggle btn btn-secondary rounded-0 btn-lg  shadow p-3 d-block" data-bs-toggle="dropdown" aria-expanded="false">
                <i class="fa fa-list"></i>
                <span>Orders</span>
            </button>
            <ul class="dropdown-menu">
                <li class="dropdown-item">
                    <a  class="w-100 d-block" href="<?=@url('admin/orders'); ?>">
                        <i class="fa fa-list"></i>
                        <span>List</span>
                    </a>
                </li>
                <li class="dropdown-item">
                    <a  class="w-100 d-block" href="<?=@url('admin/orders/add'); ?>">
                        <i class="fa fa-plus"></i>
                        <span>Add</span>
                    </a>
                </li>
            </ul>
        </li>
        <li class="my-0">
            <button class="w-100 dropdown-toggle btn btn-secondary rounded-0 btn-lg  shadow p-3 d-block" data-bs-toggle="dropdown" aria-expanded="false">
                <i class="fa fa-list"></i>
                <span>Pages</span>
            </button>
            <ul class="dropdown-menu">
                <li class="dropdown-item">
                    <a  class="w-100 d-block" href="<?=@url('admin/pages'); ?>">
                        <i class="fa fa-list"></i>
                        <span>List</span>
                    </a>
                </li>
                <li class="dropdown-item">
                    <a  class="w-100 d-block" href="<?=@url('admin/pages/add'); ?>">
                        <i class="fa fa-plus"></i>
                        <span>Add</span>
                    </a>
                </li>
            </ul>
        </li>
        <li class="my-0">
            <button class="w-100 dropdown-toggle btn btn-secondary rounded-0 btn-lg  shadow p-3 d-block" data-bs-toggle="dropdown" aria-expanded="false">
                <i class="fa fa-list"></i>
                <span>Settings</span>
            </button>
            <ul class="dropdown-menu">
                <li class="dropdown-item">
                    <a  class="w-100 d-block" href="<?=@url('admin/settings'); ?>">
                        <i class="fa fa-cogs"></i>
                        <span>Site manager</span>
                    </a>
                </li>
                <li class="dropdown-item">
                    <a  class="w-100 d-block" href="<?=@url('admin/settings/navs'); ?>">
                        <i class="fa fa-list"></i>
                        <span>Navs manager</span>
                    </a>
                </li>
                <li class="dropdown-item">
                    <a class="w-100 d-block" href="<?=@url('admin/settings/footer'); ?>">
                        <i class="fa fa-list"></i>
                        <span>Footer manager</span>
                    </a>
            </ul>
        </li>
    </ul>
</div>
