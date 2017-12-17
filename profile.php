<?php 
include 'lib/User.php';
include 'inc/header.php';
Session::checkSession();
?>
<?php 

if (isset($_GET['id'])) {
  $id = $_GET['id']; 
}

$user = new User();
if (isset($_POST['update'])) {
  $updateuser = $user->updateUser($id, $_POST);
}

?>
                  <div class="panel panel-default">
                          <div class="panel-heading">
                         <h2>User Profile <span class="pull-right"><a class="btn btn-primary" href="index.php">Back</a></span></h2>
                          </div>
                            <div class="panel-body">
                            <div style="max-width: 600px;margin: 0 auto;">
<?php 
if (isset($updateuser)) {
   echo $updateuser;
 } ?>                            
                           
<?php 
$userdata = $user->getUserById($id);
if ($userdata) {

 ?>
                            <form>
                                <div class="form-group">
                                    <label for="name">Full Name:</label>
                                    <input type="text" class="form-control" id="name" name="name" placeholder="Your Full Name" value="<?php echo $userdata->name; ?>" >
                                  </div>
                                  <div class="form-group">
                                    <label for="username">Username:</label>
                                    <input type="text" class="form-control" id="username" name="username" placeholder="Type Username" value="<?php echo $userdata->username; ?>">
                                  </div>
                                <div class="form-group">
                                    <label for="email">Email address:</label>
                                    <input type="email" class="form-control" id="email" name="email" placeholder="Email Address" value="<?php echo $userdata->email; ?>">
                                  </div>
                                  <?php 
                                  $sesid = Session::get('id');
                                  if ($sesid==$id) {
                                    
                                

                                   ?>
                                  <button type="submit" class="btn btn-success" name="update">Update</button>
<?php } ?>
                            </form>
<?php } ?>
                            </div>
                            </div>
                   </div>
<?php include 'inc/footer.php';?>
