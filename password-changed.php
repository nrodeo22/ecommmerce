         
<?php
  include 'includes/headers.php'
?>


<?php
if($_SESSION['info'] == false){
    header('Location: signup.php');  
}
?>
<div class="page-holder">
      <!-- navbar-->
        <?php
          include 'includes/navbar.php'
        ?>
      
      <!-- HERO SECTION-->
    <div class="container">
        <div class="row">
            <div class="col-md-4 offset-md-4 form login-form">
            <?php 
            if(isset($_SESSION['info'])){
                ?>
                <div class="alert alert-success text-center">
                <?php echo $_SESSION['info']; ?>
                </div>
                <?php
            }
            ?>
                <form action="login.php" method="POST" style="margin-bottom:10rem;">
                    <div class="form-group">
                        <input class="form-control button" type="submit" name="login-now" value="Login Now">
                    </div>
                </form>
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

