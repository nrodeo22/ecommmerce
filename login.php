         
<?php
  include 'includes/headers.php'
?>


    <div class="page-holder">
      <!-- navbar-->
        <?php
          include 'includes/navbar.php'
        ?>
      
      <!-- HERO SECTION-->
      



<div class="login-form">
<div class="main-div" style="border: 1px solid black;">
    <div class="panel" >
   <h2>Login</h2>
   <p>Please enter your email or username and password</p>

          <?php if(count($errors) > 0): ?>
          <div class="alert alert-danger">
          <?php foreach($errors as $error): ?>
              <li><?php echo $error; ?></li>
            <?php endforeach; ?>
            </div>
          <?php endif; ?>

   </div>
    <form id="Login" action="login.php" method="post">

        <div class="form-group">

            <input type="text" name="username" value="<?php if(isset($_COOKIE["username"])) { echo $_COOKIE["username"]; }?>" class="form-control" placeholder="Email Address/Username">
        </div>

        <div class="form-group">

            <input type="password" name="password" value="<?php if(isset($_COOKIE["password"])) { echo $_COOKIE["password"]; }?>" class="form-control" placeholder="Password">

        </div>
        <div class="forgot">
        <a href="forgotpassword.php">Forgot password?</a> <br><br>
        <a href="signup.php">Sign Up</a>
</div>
        <button type="submit" name="login-btn" class="btn btn-primary">Login</button>

    </form>
    </div>
<p class="botto-text"> Designed by Sunil Rajput</p>
</div></div>



       
        
      </div>
      <?php
          include 'includes/footers.php'
      ?>
      <?php
          include 'jsfile.php'
      ?>
    </div>
