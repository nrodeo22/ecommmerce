<?php include 'includes/headers.php'; 
include 'includes/conn.php'; 
include 'includes/upload.php';

//verify using token
if(isset($_GET['token'])){
    $token = $_GET['token'];
    verifyUser($token);
}

if(isset($_GET['password-token'])){
    $passwordToken = $_GET['password-token'];
    resetPassword($passwordToken);
}


?>
<style>
 .left, .right {
      position: absolute;
      overflow-x: hidden;
      overflow-y: hidden;
      padding-top: 10px;
      padding-left: 10px;

   }
   .left {
      height: 190%;
      width: 60%;
      margin-left:-63px;
      left: 0;
      padding-left: 80px;
      background-color: #F8F9FA; /*F8F9FA*/
      border-left: 1px solid gray;
   }
   .right {
      height: 240%;
      width: 45%;
      left: 0;
      margin-left:520px;
      padding-left: 120px;
      background-color: #F8F9FA;
   }

.horizontalrow {
  display: flex;
  flex-direction: row;
  flex-wrap: wrap;
  width: 100%;
}

.verticalcolumn {
  display: flex;
  flex-direction: column;
  flex-basis: 100%;
  flex: 1;
}

input[type=number]::-webkit-inner-spin-button, 
input[type=number]::-webkit-outer-spin-button { 
  -webkit-appearance: none; 
  margin: 0; 
}

</style>
<div class="page-holder">
      <!-- navbar-->
       <?php
          include 'includes/navbar.php'
        ?>

<?php if(!isset($_SESSION['id'])): ?>
        <p class="alert alert-danger mt-5 mx-5" style="margin-bottom:15rem;">You are not logged in, no profile found! <a href="signup.php">Login</a></p>
        <?php endif; ?>
<?php if(isset($_SESSION['id'])): ?>


<div class="container mx-auto bg-light" style="margin-bottom: 5rem;">
    <div class="row" style="margin-top:10px; margin-left:60px; padding-bottom:500px; overflow-y:hidden;">
        <div class="col-md-auto my-3" style="padding-bottom: 5rem;">
            <h2 class="text-left my-2">PROFILE</h2>
                <p class="text-left">Manage your account. <!--<a class="pull-right" href="edit_profile.php">
                <span><i class="fas fa-user-edit"></i></span> Edit Profile</a></p>-->
                <hr class="solid">
                <?php if(isset($_SESSION['message'])):?>
                <div class="alert <?php echo $_SESSION['alert-class']; ?>">
                <?php echo $_SESSION['message']; 
                      unset($_SESSION['message']);
                      unset($_SESSION['alert-class']);
                ?>
                </div>
                <?php endif; ?>

                <?php  if(isset($_SESSION['email'])): ?>
                <div class="alert alert-warning mx-0" style="visibility: hidden;">You need to verify your account. Sign in to your email and click the verification link at <strong><?php echo $_SESSION['email']; ?></strong></div>
                <?php endif; ?>

               <!-- Fullname: <input type="text" name="username" value="<php echo $row['fullname']; >"><br>
                            E-mail: <php echo $row['email']; ><br>
                            Username: <input type="text" name="username" value="<php echo $row['username']; >"><br>-->


<div class="profile"><!--profile start-->
        
        <div class="horizontalrow">
        <div class="verticalcolumn">
        
                <!--left --><div class="left" style="overflow-y:hidden;">
                <form action="" method="post" enctype="multipart/form-data" class="mx-0">
                
                <div class="form-group w-75">
                    <div class="row">
                        <div class="col-md-4">  
                            <label>Fullname:</label>
                        </div>
                        <div class="col-md-8">  
                            <input class="form-control form-control-sm" type="text"  name="fullname" value="<?php echo $_SESSION['fullname']; ?>">
                        </div>
                    </div>
                </div>
                
                <div class="form-group w-75">
                    <div class="row">
                        <div class="col-md-4">
                            <label>E-mail:</label>
                        </div>
                        <div class="col-md-8">
                            <?php echo $_SESSION['email']; ?>
                        </div>    
                    </div>
                </div>

                <div class="form-group w-75">
                    <div class="row">    
                        <div class="col-md-4">
                            <label>Username:</label> 
                        </div>
                        <div class="col-md-8">
                            <input class="form-control form-control-sm" type="text" name="username" value="<?php echo $_SESSION['username']; ?>">
                        </div>
                    </div>
                </div>

                <!--<div class="form-group w-75">-->
                <!--    <div class="row">-->
                <!--        <div class="col-md-4">-->
                <!--        <label>Phone:</label> -->
                <!--        </div>-->
                <!--        <div class="col-md-8">-->
                <!--        <input class="form-control form-control-sm" type="number" name="phonenumber" value="<?php //echo $_SESSION['phonenumber']; ?>" maxlength='14'>-->
                <!--        </div>-->
                <!--    </div>-->
                <!--</div>-->
                
                
                <div class="form-group w-75">
                    <div class="row">
                        <div class="col-md-4">
                        <label>Phone Number:</label> 
                        </div>
                        <div class="col-md-8">
                        <input class="form-control form-control-sm" type="text" name="phonenumber" maxlength='14'  value="<?php echo $_SESSION['phonenumber']; ?>">
                        </div>
                    </div>
                </div>
                
                

                
                <div class="form-group w-75">
                    <div class="row">
                        <div class="col-md-4">
                        <label>Postal Code:</label> 
                        </div>
                        <div class="col-md-8">
                        <input class="form-control form-control-sm" type="text" name="postalcode" maxlength='14'  value="<?php echo $_SESSION['postalcode']; ?>">
                        </div>
                    </div>
                </div>
                <div class="form-group w-75">
                    <div class="row">
                        <div class="col-md-4">
                        <label>Region:</label> 
                        </div>
                        <div class="col-md-8">
                        <input class="form-control form-control-sm" type="text" name="region" maxlength='14'  value="<?php echo $_SESSION['region']; ?>">
                        </div>
                    </div>
                </div>
                
                <div class="form-group w-75">
                    <div class="row">
                        <div class="col-md-4">
                        <label>City:</label> 
                        </div>
                        <div class="col-md-8">
                        <input class="form-control form-control-sm" type="text" name="city"  maxlength='14'  value="<?php echo $_SESSION['city']; ?>">
                        </div>
                    </div>
                </div>
                 <div class="form-group w-75">
                    <div class="row">
                        <div class="col-md-4">
                        <label>Barangay:</label> 
                        </div>
                        <div class="col-md-8">
                        <input class="form-control form-control-sm" type="text" name="barangay" maxlength='14' value="<?php echo $_SESSION['barangay']; ?>">
                        </div>
                    </div>
                </div>
                 <div class="form-group w-75">
                        <input class="btn btn-success btn-md float-right" type="submit" name="update-btn" value="UPDATE">
                </div>

                <div class="form-group w-75">
                    <div class="row">
                        <div class="col-md-4">
                        <label>Street:</label> 
                        </div>
                        <div class="col-md-8">
                        <input class="form-control form-control-sm" type="text" name="bse" maxlength='14' value="<?php echo $_SESSION['bse']; ?>">
                        </div>
                    </div>
                </div>
                
               
                    
        </div><!--left end-->
    </div>
    </div> 

        <div class="horizontalrow"> 
        <div class="verticalcolumn">
        <div class="right"> <!--right-->
        <form action="account.php" method="post"><!--form start-->
                <?php if(!empty($msg)): ?>
                    <div class="alert <?php echo $css_class;?>">
                <?php echo $msg; ?>
                    </div>
                <?php endif;?>








<?php 


//$db = mysqli_connect("localhost", "root","","adminpanel");
$sql = "SELECT images FROM users WHERE id='$id'";
$result = mysqli_query($db, $sql);
$users = mysqli_fetch_assoc($result);


if(empty($users['images'])): ?>
    <div class="form-group w-75">
        <img src="img/uploads/default_image.png" id="profileDisplay" style="height:150px; width:150px;border-radius: 100px;">
        <label class="">select image file to upload:</label>
        <input type="file" name="profileImage" onchange="displayImage(this)" id="profileImage">
    </div>
<?php else: ?>
    <div class="form-group w-75">
                        <?php foreach($users as $user): ?>
                        <img src="img/uploads/<?=$users['images']?>" style="height:150px; width:150px;border-radius: 100px;">
                        <label class="">select image file to upload:</label>
                        <input type="file" name="profileImage" onchange="displayImage(this)" id="profileImage">
                        <?php endforeach; ?>
                    </div>

                    <?php endif; ?>
                <div class="form-group w-75">
                        <button class="btn btn-dark btn-md float-right" type="submit" name="upload-btn">UPLOAD</button>
                </div>













               
        </form><!--form end-->
        </div><!--right end-->       
        </div>
        </div>

        </div> <!-- profile end-->
        <?php endif; ?>
        </div>
    </div>
</div>

<!--Transaction History-->

<?php
  require('connection.inc.php');
  require('functions.inc.php');

if(isset($_GET['type']) && $_GET['type']!=''){
  $type=get_safe_value($con,$_GET['type']);
  if($type=='status'){
    $operation=get_safe_value($con,$_GET['operation']);
    $id=get_safe_value($con,$_GET['id']);
    if($operation=='active'){
      $status='On Delivery';
    }else{
      $status='Canceled';
    }
    $update_status_sql="update codtotal set status='$status' where id='$id'";
    mysqli_query($con,$update_status_sql);
  }
}
?>
    <div class="page-holder" style="margin-top: -8rem;">
      <div class="container"> 
        <section class="py-5">
          <h2 class="h5 text-uppercase mb-4">Transaction History</h2>
          <div class="row">
            <div class="col-lg-8 mb-4 mb-lg-0">
              <!-- CART TABLE-->
              <form action="index.php?page=cart" method="post">
              <div class="table-responsive mb-4">
                <table class="table">
                  <thead class="bg-light">
                    <tr>
                      <th class="border-0" scope="col"> <strong class="text-small text-uppercase">Product</strong></th>
                      <th class="border-0" scope="col"> <strong class="text-small text-uppercase">Price</strong></th>
                      <th class="border-0" scope="col"> <strong class="text-small text-uppercase">Total</strong></th>
                      <th class="border-0" scope="col"> <strong class="text-small text-uppercase">Date</strong></th>
                      <th class="border-0" scope="col"><strong class="text-small">Order ID</strong></th>
                      <th class="border-0" scope="col"><strong class="text-small text-uppercase"></strong></th>
                    </tr>
                  </thead>
                  <tbody>
                     <?php 
                     
                      $emailz=$_SESSION['email'];
                      $query = "SELECT * FROM codtotal WHERE email = '$emailz'";
                      $result = $con->query($query);
                      if ($result->num_rows > 0) {
                        while ($rows = $result->fetch_assoc()) {
                          $id = $rows['id'];   
                          $item = $rows['item'];
                          $subtotal = $rows['subtotal'];
                          $totalpayment = $rows['totalpayment'];
                          $status = $rows['status'];
                          $date=$rows['date_ordered'];
                          $transid=$rows['transid'];
                         
                    ?>  
                    <tr>
                      <th class="pl-0 border-0" scope="row">
                        <div class="media align-items-center">
                          <div class="media-body ml-3">
                            <strong class="h6"><a class="reset-anchor animsition-link" href="index.php?page=product&id=<?=$product['id']?>"><?php echo $item;?></a></strong>
                          </div>
                        </div>
                      </th>
                      <td class="align-middle border-0">
                        <p class="mb-0 small"><?php echo $subtotal;?></p>
                      </td>
                      <td class="align-middle border-0">
                        <p class="mb-0 small">&#8369;<?php echo $totalpayment;?></p>
                      </td>
                      <td class="align-middle border-0">
                        <p class="mb-0 small"><?php echo $date;?></p>
                      </td>
                      <td class="align-middle border-0">
                        <p class="mb-0 small"><?php echo $transid;?></p>
                      </td>
                    </tr>
                    
                  </tbody>
                  <?php }} ?> 
                 </table>
                </div>
              </form>
            </div>
          </div>
        </section>
      </div>
    </div>
<!--End of Transaction History-->





<?php 
ob_end_flush();
?>

<script type="text/javascript">

function triggerClick(){
    document.querySelector('#profileImage').click();
}
function displayImage(e){
    if (e.files[0]){
        var reader = new FileReader();

        reader.onload = function(e) {
            document.querySelector('#profileDisplay').setAttribute('src',e.target.result);
        }
        reader.readAsDataURL(e.files[0]);
    }
}
</script>



      <?php
          include 'includes/footers.php'
      ?>

      <!-- JavaScript files-->
      <?php
          include 'jsfile.php'
      ?>
    </div>
  </body>
</html>