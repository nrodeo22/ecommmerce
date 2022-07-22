<?php 
    session_start();   
?>
<!DOCTYPE html>
<html>
<head>
  <title></title>
</head>
<body>
  <h3>Sign Up</h3>
  <hr>
  <div>
      <form action = "php/registration-process.php" method = "post">
          <div>
              <label for="fname">First Name</label>
              <input type="text" id="fname" name="fname" required>
          </div>
          <div>
              <label for="lname">Last Name</label>
              <input type="text" id="lname" name="lname" required>
          </div>
          <div>
              <label for="email">E-mail</label>         
              <input type="email" id="email" name="email" required>
          </div>
          <div>
              <label for="phonenumber">Phone Number</label>         
              <input type="text" id="phonenumber" name="phonenumber"  required onkeypress="isInputNumber(event)">
              <script>
                function isInputNumber(evt){
                  var ch = String.fromCharCode(evt.which);

                  if(!(/[0-9]/.test(ch))){
                    evt.preventDefault();
                  }
                }
              </script>
          </div>
          <div>
              <label for="username">Username</label>
              <input type="text" id="username" name="username" onkeypress="return AvoidSpace(event)" required>
              <script>
                  function AvoidSpace(event) {
                      var k = event ? event.which : window.event.keyCode;
                      if (k == 32) return false;
                  }
              </script>
          </div>
          <div>
              <label for="password">Password</label>
              <input type="password" id="password" name="password" required>
          </div>
          <div>
              <label for="rpassword">Repeat Password</label>
              <input type="password" id="rpassword" name="rpassword" required>
          </div>
          <?php
            echo $message;
          ?>
          <div >
              <button type="submit" name = "signup-button">Sign Up</button>
          </div>
      </form>
      <a href="login.php">Login</a>
  </div>           
</body>
</html>