<?php 
include_once('lib/Session.php');
Session::init();
?>
<?php

if (isset($_GET['action']) && $_GET['action'] == 'logout') {
  Session::destroy();
}
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Students Management System</title>
    <link href="inc/bootstrap.min.css" rel="stylesheet">
    <script type="text/javascript" src="inc/jquery-3.1.1.min.js"></script>
    <script type="text/javascript" src="inc/bootstrap.min.js"></script>
  </head>
  <body>
    
      <div class="container">
          <nav class="navbar navbar-default">
              <div class="container-fluid">
                <div class="navbar-header">
                  <a class="navbar-brand" href="index.php">Students Management System</a>
                </div>
                  <ul class="nav navbar-nav navbar-right">
                  <?php 
                  $id = Session::get("id");
                  $userlogin = Session::get("login");
                  if ($userlogin == true) {
                   ?>
                  <li><a href="profile.php?id=<?php echo $id;?>">Profile</a></li>
                  <li><a href="?action=logout">Logout</a></li>

                  <?php }else{ ?>
                        <li><a href="login.php">Login</a></li>
                        <li><a href="register.php">Register</a></li>
                        <?php } ?>
                      </ul>
                </div>
          </nav>