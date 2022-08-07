<div class="container">
    <h1>Register</h1>
    <form action="<?php echo url('auth/register')?>" method="post">
        <div class="form-group my-3">
            <label for="user_name">Full name</label>
            <input type="text" class="form-control" id="user_name" name="user_name" placeholder="Name">
            <?php if(isset($errors) && isset($errors['user_name'])): ?>
                <small class="form-text text-danger"><?php echo $errors['user_name']; ?></small>
            <?php endif; ?>
        </div>
        <div class="form-group my-3">
            <label for="account">Account</label>
            <input type="text" class="form-control" id="account" name="account" placeholder="Account">
            <?php if(isset($errors) && isset($errors['account'])): ?>
                <small class="form-text text-danger"><?php echo $errors['account']; ?></small>
            <?php endif; ?>
        </div>
        <div class="form-group my-3">
            <label for="email">Email</label>
            <input type="email" class="form-control" id="email" name="email" placeholder="Email">
            <?php if(isset($errors) && isset($errors['email'])): ?>
                <small class="form-text text-danger"><?php echo $errors['email']; ?></small>
            <?php endif; ?>
        </div>
        <div class="form-group my-3">
            <label for="password">Password</label>
            <input type="password" class="form-control" id="password" name="password" placeholder="Password">
            <?php if(isset($errors) && isset($errors['password'])): ?>
                <small class="form-text text-danger"><?php echo $errors['password']; ?></small>
            <?php endif; ?>
        </div>
        <div class="form-group my-3">
            <label for="password_confirmation">Confirm Password</label>
            <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="Confirm Password">
            <?php if(isset($errors) && isset($errors['password_confirmation'])): ?>
                <small class="form-text text-danger"><?php echo $errors['password_confirmation']; ?></small>
            <?php endif; ?>
        </div>
        <button type="submit" class="btn btn-primary">Register</button>
    </form>
</div>