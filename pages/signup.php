<?php
require('db.php');
$data = $_POST;

if (isset($data['do_singup'])) {
    // registration;
    $error = Array();
    if (trim($data['login']) == ''){
        $error[] = 'Enter login!';
    }
    if (trim($data['email']) == ''){
        $error[] = 'Enter e-mail!';
    }
    if (trim($data['password']) == ''){
        $error[] = 'Enter password!';
    }
    if (R::count('users', 'login = ?', array($data['login'])) > 0){
        $error[] = 'This login is busy';
    }
    if (R::count('users', 'email = ?', array($data['email'])) > 0){
        $error[] = 'This email is busy';
    }
    if (empty($error)){

        $user = R::dispense('users');
        $user->login = $data['login'];
        $user->email = $data['email'];
        $user->password = password_hash($data['password'], PASSWORD_DEFAULT);
        $user->admin = 0;
        R::store($user);
        echo '<div class="text-center text-success">Successfully </div>';
        //reg
    }else{
        echo '<div style="color: #a52a2a;" class="text-center text-"> '.array_shift($error).' </div>';
    }
}

?>
<div class="container-fluid">
    <div class="row">
        <div class="col d-flex justify-content-center">
            <form action="?pages=signup" method="post">
                <div class="form-group">
                    <div class="form-group">
                        <h1>Regestration form</h1>
                        <label for="">Write yours Login</label>
                        <input type="text" name="login" class="form-control" placeholder="Login" value="<?php echo @$data['login']; ?>">
                    </div>
                    <label for="">Write yours E-maill</label>
                    <input type="email" name="email" class="form-control" placeholder="E-mail:" value="<?php echo @$data['email']; ?>">
                </div>
                <div class="form-group">
                    <label for="">Password</label>
                    <input type="password" name="password" class="form-control" placeholder="Password" value="<?php echo @$data['password']; ?>">
                    <a href="?pages=login">Have an account? Login In</a>
                </div>
                <button type="submit" class="btn btn-primary" name="do_singup">Sign up</button>
            </form>
        </div>
    </div>
</div>
