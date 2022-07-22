         
<?php
  include 'includes/headers.php'
?>

<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<script src="jquery/jquery.min.js"></script>
    <!---- jquery link local dont forget to place this in first than other script or link or may not work ---->
    
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <!---- boostrap.min link local ----->

    <div class="page-holder">
      <!-- navbar-->
        <?php
          include 'includes/navbar.php'
        ?>
      
      <!-- HERO SECTION-->
  <div class="container-fluid">
    <div class="container" style="padding-bottom: 5rem;">
      <hr>
      <div class="row">
        <div class="col-md-5">
          <form role="form" action="signup.php" method="post">
            <fieldset>              
              <p class="text-uppercase pull-center"> SIGN UP.</p> 
                 <?php if(count($errors) > 0):?>
                  <div class="alert alert-danger">
                  <?php foreach($errors as $error): ?>
                      <li><?php echo $error; ?></li>
                    <?php endforeach; ?>
                    </div>
                  <?php endif; ?>

              <div class="form-group">
                <input type="text" name="fullname"  class="form-control input-lg" placeholder="Full Name" required>
              </div>
              <div class="form-group">
                <input type="text" name="username"  class="form-control input-lg" placeholder="Username" required>
              </div>

              <div class="form-group">
                <input type="email" name="email"  class="form-control input-lg" placeholder="Email Address" required>
              </div>
              <div class="form-group">
                <input type="password" name="password"  class="form-control input-lg" placeholder="Password" required>
              </div>
                <div class="form-group">
                <input type="password" name="passwordrepeat"  class="form-control input-lg" placeholder="Repeat Password" required>
              </div>
              <p class="text-uppercase pull-center"> ADDRESS</p> 
            <div class="form-group">
			     <input name="phonenumber"
			        oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"
			        type = "number"
			        maxlength = "12"
			        name="phonenumber" class="form-control input-lg" placeholder="Phone Number" required
			     />
              </div>
              <div class="form-group">
                <input name="postalcode"
			        oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"
			        type = "number"
			        maxlength = "6"
			        name="postalcode"  class="form-control input-lg" placeholder="Postal Code" required
			     />
              </div>
              <div class="form-group">
                <input type="region" name="region"  class="form-control input-lg" placeholder="Region" required>
              </div>
              <div class="form-group">
                <input type="city" name="city"  class="form-control input-lg" placeholder="City" required>
              </div>
              <div class="form-group">
                <input type="barangay" name="barangay"  class="form-control input-lg" placeholder="Barangay" required>
              </div>
              <div class="form-group">
                <input type="bse" name="bse"  class="form-control input-lg" placeholder="Building,Street,and etc..." required>
              </div>
              
              <div>
                    <input type="submit" name="signup-btn" class="btn btn-lg btn-primary" style=" background-color: #dcb14a; border-color: transparent;">
              </div>
            </fieldset>
          </form>
        </div>
        
        <div class="col-md-2">
          <!-------null------>
        </div>
        
        <div class="col-md-5">
            <form role="form" action="signup.php" method="post">
            <fieldset>              
              <p class="text-uppercase"> Already a member? Sign in: </p> 
                
              <div class="form-group">
                <input type="text" name="username" value="<?php if(isset($_COOKIE["username"])) { echo $_COOKIE["username"]; }?>" class="form-control" placeholder="Email Address/Username">
              </div>
              <div class="form-group">
                <input type="password" name="password" value="<?php if(isset($_COOKIE["password"])) { echo $_COOKIE["password"]; }?>" class="form-control" placeholder="Password">
              </div>
                    <a href="forgotpassword.php">Forgot password?</a>
              <div>
                <input type="submit" name="login-btn" style=" background-color: #dcb14a;" class="btn btn-md" value="Sign In">
              </div>
                 
            </fieldset>
        </form> 
        </div>
      </div>
    </div>
  </div>
      


</div>
      <?php
          include 'includes/footers.php'
      ?>
      <?php
          include 'jsfile.php'
      ?>
    </div>
  </body>
</html>