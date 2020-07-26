<?php
require('db.php');
$data = $_POST;
if (isset($data['do_login'])) {
    $error = array();
    $user = R::findOne('users', 'login = ?', array($data['login']));
    if ($user) {

        if (password_verify($data['password'], $user->password)) {
            $_SESSION['logged_user'] = $user;
            echo '<div class="text-center text-success">Successfully </div>';
        } else {
            $error[] = 'Password is not correct:(';
        }
    } else {
        $error[] = 'User not found:(';
    }

    if (!empty($error)) {
        echo '<div style="color: #a52a2a;" class="text-center text-"> ' . array_shift($error) . ' </div>';
    }

}

?>
<div class="container-fluid">
    <div class="row">
        <div class="col d-flex justify-content-center">
            <form action="?pages=login" method="post">
                <div class="form-group">
                    <div class="form-group">
                        <h1>Login In System</h1>
                        <label for="">Write yours Login</label>
                        <input type="text" name="login" class="form-control" placeholder="Login"
                               value="<?php echo @$data['login']; ?>">
                    </div>
                </div>
                <div class="form-group">
                    <label for="">Password</label>
                    <input type="password" name="password" class="form-control" placeholder="Password"
                           value="<?php echo @$data['password']; ?>">
                </div>
                <button type="submit" class="btn btn-primary" name="do_login">Login In</button>
            </form>
        </div>
    </div>
</div>
