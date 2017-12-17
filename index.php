<?php 
include 'inc/header.php';
include 'lib/User.php';
$user = new User();
Session::checkSession();
?>

<?php 

$loginmsg = Session::get("loginmsg");
if (isset($loginmsg)) {
  echo $loginmsg;}
 ?>
                  <div class="panel panel-default">
                          <div class="panel-heading">
                         <h2>All Students<span class="pull-right">Current User - <strong>
                         <?php 
                         $name = Session::get("username");
                           if (isset($name)) {
                             echo $name;
                         }
                         Session::set("loginmsg"," ");
                          ?>
                         </strong></span></h2>
                          </div>
                            <div class="panel-body">
                              <table class="table table-striped">
                              <tr>
                              <th width="20%">Serial</th>
                              <th width="20%">Name</th>
                              <th width="20%">Username</th>
                              <th width="20%">Email Address</th>
                              <th width="20%">Action</th>
                              </tr>
                              <?php 

                              $user = new User();
                              $userdata = $user->getuserdata();
                              if ($userdata) {
                                $i=0;
                                foreach ($userdata as $value) {
                                $i++;
                               ?>
                              <tr>
                                <td><?php echo $i; ?></td>
                                <td><?php echo $value['name']; ?></td>
                                <td><?php echo $value['username']; ?></td>
                                <td><?php echo $value['email']; ?></td>
                                <td>
                                  <a class="btn btn-primary" href="profile.php?id=<?php echo $value['id']; ?>">view</a>
                                </td>
                              </tr>
                              <?php 

                                 }
                              }
                              else
                              {           
                               ?>
                              <td><tr><h2>Data Not Found</h2></tr></td>
                                <?php                                 
                              } ?>
                              </table>
                              
                            </div>
                   </div>
<?php include 'inc/footer.php';?>