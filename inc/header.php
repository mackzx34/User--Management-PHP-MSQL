<?php
$filepath = realpath(dirname(__FILE__));
include_once $filepath."/../lib/Session.php";
Session::init();

spl_autoload_register(function($classes){
  include 'classes/'.$classes.".php";
});

$users = new Users();
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>User Management</title>
    <link rel="stylesheet" href="assets/bootstrap.min.css">
    <link href="https://use.fontawesome.com/releases/v5.0.4/css/all.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="assets/style.css">
    <style>
  /* Custom CSS for the navigation bar with background image and transparency */
  .navbar {
    position: relative; /* Needed for positioning the pseudo-element */
    background-color: rgba(0, 0, 0, 0.5); /* Fallback color with transparency */
    color: white; /* Adjust text color for readability */
  }

  .navbar::before {
    content: ""; /* Create an empty pseudo-element */
    position: absolute; /* Position it absolutely within the navbar */
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-image: url('madini2.jpg'); /* Set background image */
    background-size: cover; /* Ensure the image covers the navbar */
    background-position: center; /* Center the image */
    opacity: 0.8; /* Set opacity for transparency effect */
    z-index: -1; /* Place the pseudo-element behind the content */
  }

  .navbar-brand img {
    max-height: 50px; /* Adjust the height of the logo */
    width: auto; /* Maintain aspect ratio */
  }

  .navbar-nav .nav-link {
    color: white; /* Text color for nav links */
  }

  .navbar-nav .nav-link.active {
    font-weight: bold; /* Highlight active nav link */
  }

  .navbar-nav {
    margin-left: auto;
  }

  /* Optional: Adjust link color on hover if needed */
  .navbar-nav .nav-link:hover {
    color: #f8f9fa; /* Change to a lighter color on hover if necessary */
  }
</style>

  </head>
  <body>
    <?php
    if (isset($_GET['action']) && $_GET['action'] == 'logout') {
      Session::destroy();
    }
    ?>

    <div class="container">
      <nav class="navbar navbar-expand-md navbar-dark card-header">
        
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarsExampleDefault">
          <ul class="navbar-nav">
            <?php if (Session::get('id') == TRUE) { ?>
              <?php if (Session::get('roleid') == '1') { ?>
                <li class="nav-item">
                  <a class="nav-link" href="index.php"><i class="fas fa-users mr-2"></i>view users</a>
                </li>
                
                <li class="nav-item
                  <?php
                  $path = $_SERVER['SCRIPT_FILENAME'];
                  $current = basename($path, '.php');
                  if ($current == 'addUser') {
                    echo " active ";
                  }
                  ?>">
                  <a class="nav-link" href="addUser.php"><i class="fas fa-user-plus mr-2"></i>Add user</a>
                </li>
              <?php } ?>
              <li class="nav-item
                <?php
                $path = $_SERVER['SCRIPT_FILENAME'];
                $current = basename($path, '.php');
                if ($current == 'profile') {
                  echo "active ";
                }
                ?>">
                <a class="nav-link" href="profile.php?id=<?php echo Session::get("id"); ?>"><i class="fab fa-500px mr-2"></i>Profile</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="?action=logout"><i class="fas fa-sign-out-alt mr-2"></i>Logout</a>
              </li>
            <?php } else { ?>
              <li class="nav-item
                <?php
                $path = $_SERVER['SCRIPT_FILENAME'];
                $current = basename($path, '.php');
                if ($current == 'register') {
                  echo " active ";
                }
                ?>">
              </li>
              <li class="nav-item
                <?php
                $path = $_SERVER['SCRIPT_FILENAME'];
                $current = basename($path, '.php');
                if ($current == 'login') {
                  echo " active ";
                }
                ?>">
                <a class="nav-link" href="login.php"><i class="fas fa-sign-in-alt mr-2"></i>Login</a>
              </li>
            <?php } ?>
          </ul>
        </div>
      </nav>
