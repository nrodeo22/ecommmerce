         
<?php
  include 'includes/headers.php'
?>


    <div class="page-holder">
      <!-- navbar-->
        <?php
          include 'includes/navbar.php'
        ?>
      
      <!-- HERO SECTION-->
      


<div class="container">
<div class="login-form">
<div class="main-div" style="border: 1px solid black;">
    <div class="panel" >
   <h2>RECOVER PASSWORD</h2>
   <p>Please enter the email address that you used on this site to recover your password</p>

          <?php
            if(count($errors) > 0){
          ?>
          <div class="alert alert-danger text-center">
          <?php 
          foreach($errors as $error){
          echo $error;
          }
          ?>
          </div>
          <?php
          }
          ?>

   </div>
    <form id="Login" action="signup.php" method="post">

        <div class="form-group">

            <input class="form-control" type="email" name="email" placeholder="Enter email address" required value="<?php echo $email ?>">
        </div>

       
        <button class="btn btn-primary" type="submit" name="check-email" value="Continue">Submit</button>

    </form>
    </div>

</div></div></div>




       
        
      </div>
      <?php
          include 'includes/footers.php'
      ?>
      <?php
          include 'jsfile.php'
      ?>
    </div>

