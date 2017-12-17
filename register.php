<?php 
include 'inc/header.php';
include 'lib/User.php';
?>
<?php 

$user = new User();

if (isset($_POST['register'])) {
  $userRegi = $user->userRegistration($_POST);
}
?>
                  <div class="panel panel-default">
                          <div class="panel-heading">
                         <h2>Registration</h2>
                          </div>
                            <div class="panel-body">
                            <div style="max-width: 600px;margin: 0 auto;">
                            <?php 

                            if (isset($userRegi)) {
                               echo $userRegi;
                            }

                             ?>

                            <form action="" method="post" enctype="multipart/form-data">
                                <div class="form-group">
                                    <label for="name">Full Name:</label>
                                    <input type="text" class="form-control" id="name" name="name" placeholder="Your Full Name">
                                  </div>
                                  <div class="form-group">
                                    <label for="username">Username:</label>
                                    <input type="text" class="form-control" id="username" name="username" placeholder="Type Username">
                                  </div>
                                <div class="form-group">
                                    <label for="email">Email address:</label>
                                    <input type="email" class="form-control" id="email" name="email" placeholder="Email Address">
                                  </div>
                                  <div class="form-group">
                                    <label for="password">Password:</label>
                                    <input type="password" class="form-control" id="password" name="password" placeholder="Type Password">
                                  </div>
                                  <div class="form-group">
                                    <label for="photo">Photo:</label>
                                    <input type="file" class="form-control" id="file" name="file" placeholder="Photo">
                                  </div>
                                  <button type="submit" class="btn btn-success" name="register">Submit</button>
                            </form>

                            </div>
                            </div>
                   </div>
<?php include 'inc/footer.php';?>
