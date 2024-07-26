<?php
include 'inc/header.php';
Session::CheckLogin();
?>

<?php

// Create an instance of the Users class
$users = new Users(); // Ensure you have a proper instance of the Users class

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['login'])) {
    $userLog = $users->userLoginAuthotication($_POST); // Correct method name
}

if (isset($userLog)) {
    echo $userLog;
}

$logout = Session::get('logout');
if (isset($logout)) {
    echo $logout;
}
?>

<div class="card">
    <div class="card-header">
        <h3 class='text-center'><i class="fas fa-sign-in-alt mr-2"></i>User login</h3>
    </div>
    <div class="card-body">
        <div style="width:450px; margin:0px auto">
            <form action="" method="post">
                <div class="form-group">
                    <label for="email">Email address</label>
                    <input type="email" name="email" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" name="password" class="form-control" required>
                </div>
                <div class="form-group">
                    <button type="submit" name="login" class="btn btn-success">Login</button>
                </div>
            </form>
            <!-- Forgot Password Link -->
            <div class="form-group text-center mt-3">
                <a href="forgot_password.php">Forgot Password?</a>
            </div>
        </div>
    </div>
</div>

<?php
include 'inc/footer.php';
?>
