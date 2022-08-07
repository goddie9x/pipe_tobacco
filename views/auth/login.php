<div class="container login my-5">
    <div class="row justify-content-center">
        <div class="col-md-6 col-md-offset-3">
            <div class="panel panel-dark">
                <div class="panel-heading">
                    <h3 class="panel-title">Please sign in</h3>
                </div>
                <div class="panel-body">
                    <form action="<?php echo url('auth/login');?>" method="post">
                        <div class="form-group my-3">
                            <label for="account">Account</label>
                            <input type="text" class="form-control" id="account" name="account" placeholder="Account">
                            <?php if(isset($errors)&&isset($errors['account'])):?>
                                <small class="form-text text-danger"><?php echo $errors['account'];?></small>
                            <?php endif;?>
                        </div>
                        <div class="form-group my-3">
                            <label for="password">Password</label>
                            <input type="password" class="form-control" id="password" name="password" placeholder="Password">
                            <?php if(isset($errors)&&isset($errors['password'])):?>
                                <small class="form-text text-danger"><?php echo $errors['password'];?></small>
                            <?php endif;?>
                        </div>
                        <button type="submit" class="btn btn-primary">Sign in</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>