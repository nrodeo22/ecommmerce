<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

//require $_SERVER['DOCUMENT_ROOT'] . '/mail/Exception.php';
//require $_SERVER['DOCUMENT_ROOT'] . '/mail/PHPMailer.php';
//require $_SERVER['DOCUMENT_ROOT'] . '/mail/SMTP.php';
include("includes/connectionpayment.php");
  // If the user clicked the add to cart button on the product page we can check for the form data
  if (isset($_POST['product_id'], $_POST['quantity']) && is_numeric($_POST['product_id']) && is_numeric($_POST['quantity'])) {
      // Set the post variables so we easily identify them, also make sure they are integer
      $product_id = (int)$_POST['product_id'];
      $quantity = (int)$_POST['quantity'];
      // Prepare the SQL statement, we basically are checking if the product exists in our databaser
      $stmt = $pdo->prepare('SELECT * FROM products WHERE id = ?');
      $stmt->execute([$_POST['product_id']]);
      // Fetch the product from the database and return the result as an Array
      $product = $stmt->fetch(PDO::FETCH_ASSOC);
      // Check if the product exists (array is not empty)
      if ($product && $quantity > 0) {
          // Product exists in database, now we can create/update the session variable for the cart
          if (isset($_SESSION['cart']) && is_array($_SESSION['cart'])) {
              if (array_key_exists($product_id, $_SESSION['cart'])) {
                  // Product exists in cart so just update the quanity
                  $_SESSION['cart'][$product_id] += $quantity;
              } else {
                  // Product is not in cart so add it
                  $_SESSION['cart'][$product_id] = $quantity;
              }
          } else {
              // There are no products in cart, this will add the first product to cart
              $_SESSION['cart'] = array($product_id => $quantity);
          }
      }
      // Prevent form resubmission...
      header('Location: index.php?page=placeorder');
      exit;
  }

    // Remove product from cart, check for the URL param "remove", this is the product id, make sure it's a number and check if it's in the cart
    if (isset($_GET['remove']) && is_numeric($_GET['remove']) && isset($_SESSION['cart']) && isset($_SESSION['cart'][$_GET['remove']])) {
      // Remove the product from the shopping cart
      unset($_SESSION['cart'][$_GET['remove']]);
    }

    // Check the session variable for products in cart
    $products_in_cart = isset($_SESSION['cart']) ? $_SESSION['cart'] : array();
    $products = array();
    $subtotal = 0.00;
    // If there are products in cart
    if ($products_in_cart) {
        // There are products in the cart so we need to select those products from the database
        // Products in cart array to question mark string array, we need the SQL statement to include IN (?,?,?,...etc)
        $array_to_question_marks = implode(',', array_fill(0, count($products_in_cart), '?'));
        $stmt = $pdo->prepare('SELECT * FROM products WHERE id IN (' . $array_to_question_marks . ')');
        // We only need the array keys, not the values, the keys are the id's of the products
        $stmt->execute(array_keys($products_in_cart));
        // Fetch the products from the database and return the result as an Array
        $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
        // Calculate the subtotal
        foreach ($products as $product) {
            $subtotal += (float)$product['price'] * (int)$products_in_cart[$product['id']];
        }
    }

  ?>

<?php 
include'includes/headers.php';
?>



<!------ Include the above in your HEAD tag ---------->


    <div class="page-holder">
      <!-- navbar-->
       <?php
          include 'includes/navbar.php'
        ?>
      


<section class="main-content bg-light py-4 mb-5">

        <?php if(!isset($_SESSION['id'])): ?>
        <p class="alert alert-danger mt-5" style="margin-bottom: 20rem;">You are not logged in! Login to checkout. <a href="signup.php">Login</a></p>
        <?php endif; ?>
        <?php if(isset($_SESSION['id'])): ?>

    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <div class="row mb-2">
                    <div class="col-md-12">
                        <div class="">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <h2>Delivery Address</h2>
                                        <small>This will act as a place to deliver</small><br>
                                        <small>(You are required to add address)</small><br>
                                        <?php 
  
  
                  $phonenumber=$_SESSION['phonenumber'];
                  $fullname=$_SESSION['fullname'];
                  $postalcode=$_SESSION['postalcode'];
                  $region=$_SESSION['region'];
                  $city=$_SESSION['city'];
                  $barangay=$_SESSION['barangay'];
                  $bse=$_SESSION['bse'];



                  
                  $display = "Phone Number: ".strtoupper($phonenumber)."<br>"."Full Name: ".strtoupper($fullname)."<br>"."Address: ".strtoupper($bse).", ".strtoupper($barangay).", ".strtoupper($city).", ".strtoupper($postalcode).", ".strtoupper($region);
                  
                  
?>
                                        <?php echo $display;?>

                <div class="container" style="padding-top: 2rem;">
                    <div class="row">       
                    <div id="myModal" class="modal fade in">
                          <div class="modal-dialog">
                              <div class="modal-content">
                   <form action="" method="post" name="login">

                                  <div class="modal-header">
                                      <a class="btn btn-default" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span></a>
                                      <h4 class="modal-title">New Address</h4>
                                  </div>
                                  <div class="modal-body">
                                      

                                  <div class="form-group">
                                     <input type="text" name="fullname" required  class="form-control my-input" value= "<?php echo $_SESSION['fullname']; ?>" readonly="readonly"/>
                                  </div>
                                  <div class="form-group">
                                     <input type="number" name="phonenumber" class="form-control my-input" placeholder="Phone number" required/>
                                  </div>
                                  <div class="form-group">
                                     <input type="text" name="postalcode" class="form-control my-input" placeholder="Postal Code" required/>
                                  </div>
                                  <div class="form-group">
                                     <input type="text" name="region" class="form-control my-input"placeholder="Region" required/>
                                  </div>
                                  <div class="form-group">
                                     <input type="text" name="city"  class="form-control my-input" placeholder="City">
                                  </div>
                                  <div class="form-group">
                                     <input type="text" name="barangay"  class="form-control my-input" placeholder="Barangay" required/>
                                  </div>
                                  <div class="form-group">
                                     <input type="text" name="bse"  class="form-control my-input"placeholder="Building,Street,and etc..." required/>
                                  </div>
                                  </div>
                                  <div class="modal-footer">
                                      <div class="btn-group">
                                          <button type="button" class="btn btn-danger" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Cancel</button>
                                          <button type="submit" name="submit" class="btn btn-primary"><span class="glyphicon glyphicon-check"></span> Save</button>
                                      </div>
                                  </div>
                                  </form>
                              </div><!-- /.modal-content -->
                          </div><!-- /.modal-dalog -->
                      </div><!-- /.modal -->
                      
                  <a data-toggle="modal" href="#myModal" class="btn btn-primary" >Change</a>


                    </div>
                  </div>
                                   </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
            </div>
            
        </div>
    </div>



<form method="POST" action="">    

    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <div class="row mb-3">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                  <div class="col-md-12">
                                        <h2>Product Ordered</h2>
                                        
                                    </div>
                                    <div class="col-md-12">
                                       
                                        <div class="table-responsive mb-4">
                <table class="table">
                  <thead class="bg-light">
                    <tr>
                      <th class="border-0" scope="col"> <strong class="text-small text-uppercase">Product</strong></th>
                      <th class="border-0" scope="col"> <strong class="text-small text-uppercase">Price</strong></th>
                      <th class="border-0" scope="col"> <strong class="text-small text-uppercase">Quantity</strong></th>
                      <th class="border-0" scope="col"> <strong class="text-small text-uppercase">Total</strong></th>
                      <th class="border-0" scope="col"> </th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php 
                      // Check the session variable for products in cart
                      $products_in_cart = isset($_SESSION['cart']) ? $_SESSION['cart'] : array();
                      $products = array();
                      $subtotal = 0.00;

                      // If there are products in cart
                      if ($products_in_cart) {
                          // There are products in the cart so we need to select those products from the database
                          // Products in cart array to question mark string array, we need the SQL statement to include IN (?,?,?,...etc)
                          $array_to_question_marks = implode(',', array_fill(0, count($products_in_cart), '?'));
                          $stmt = $db->prepare('SELECT * FROM products WHERE id IN (' . $array_to_question_marks . ')');
                          // We only need the array keys, not the values, the keys are the id's of the products
                          $stmt->execute(array_keys($products_in_cart));
                          // Fetch the products from the database and return the result as an Array
                          $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
                          // Calculate the subtotal
                          
                          foreach ($products as $product) {
                              $subtotal += (float)$product['price'] * (int)$products_in_cart[$product['id']];
                          }

                        
                      } 
                    ?>
                    <?php if (empty($products)): ?>
                   
                    <?php else: ?>
                    <?php foreach ($products as $product): ?>
                    <tr>
                      <th class="pl-0 border-0" scope="row">
                        <div class="media align-items-center"><a class="reset-anchor d-block animsition-link" href="detail.html"><img src="img/<?=$product['image']?>" alt="<?=$product['name']?>" width="70"/></a>
                          <div class="media-body ml-3"><strong class="h6"><a class="reset-anchor animsition-link" href="index.php?page=product&id=<?=$product['id']?>"><?=$product['name']?></a></strong></div>
                        </div>
                      </th>
                      <td class="align-middle border-0">
                        <p class="mb-0 small"><?=$product['price']?></p>
                      </td>
                      <td class="align-middle border-0">
                        <p class="mb-0 small"><?=$products_in_cart[$product['id']]?></p>
                      </td>
                      <td class="align-middle border-0">
                        <p class="mb-0 small"><?=$product['price'] * $products_in_cart[$product['id']]?></p>
                      </td>
                    </tr>
                    <?php endforeach; ?>
                    <?php endif; ?>
                  </tbody>

                </table>

              </div>           
                                  </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="row mb-3">
                  <div class="col-md-12">
                  <h5 class="text-uppercase mb-4">Cart total</h5>
                  <ul class="list-unstyled mb-0">
                    <li class="d-flex align-items-center justify-content-between"><strong class="text-uppercase small font-weight-bold">Total</strong><span class="text-muted small"><?=$subtotal?></span></li>
                    <li class="border-bottom my-2"></li>
                  </ul>
                </div>
              </div>
            </div>
      </div>
    </div>           


    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <div class="row mb-3">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                  <div class="col-md-12">
                                        <h2><h2>Shipping Option</h2></h2>
                                  </div>
                                  <div class="col-md-12">
                                    <p>(Please select preferred delivery time)</p>
                                    <a>Standard Location</a><br>
                                    <a>J& T Express</a>
                                  <br><br>         
                                  <input type="radio" id="dat" name="so" value="Deliver any time" required/>&nbsp&nbspDeliver any time  <br>        
                                  <input type="radio" id="ddoh" name="so" value="Deliver during office hours"required/>&nbsp&nbspDeliver during office hours  
                                  <br><br> 
                                  <label class="custom-field">
                                       <input type="text" name="message">
                                       <span class="placeholder" not required>Message(Optional)</span>
                                  </label>      
                                       
                                  </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="row mb-3">
                  <div class="col-md-12"> 
                  <h5 class="text-uppercase mb-4">Shipping Fee: </h5>         
                  <span class="pr">&#8369;50</span>                
                </div>
              </div>
            </div>
      </div>
    </div>           


    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <div class="row mb-3">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                  <div class="col-md-12">
                                        <h2><h2>Payment Method</h2></h2>
                                  </div>
                                  <div class="col-md-12">
                                    <p>(Default: Cash on delivery)</p>
                                    <p>    Email Verification</p>
                                    <input id="email" type="email" name="email" placeholder="Email Address" style="width: 30%" required>
                                  </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="row mb-3">
                  <div class="col-md-12"> 
                 <span class="ttext">Subtotal:</span>
              <span class="pr">&#8369;<?=$subtotal?></span><br>
              <span class="tsf">Shipping Fee:</span>
              <span class="pr">&#8369;50</span><br>
              <span class="ttext">Total:</span>
              <span class="gtotal">&#8369;<?=$subtotal + 50?></span><br>  

              <div class="paybuttons">
                 <?php   

                  include("includes/connectionpayment.php");

                  $phonenumber=$_SESSION['phonenumber'];
                  $fullname=$_SESSION['fullname'];
                  $postalcode=$_SESSION['postalcode'];
                  $region=$_SESSION['region'];
                  $city=$_SESSION['city'];
                  $barangay=$_SESSION['barangay'];
                  $bse=$_SESSION['bse'];



                  
                  $display = "Phone Number: ".strtoupper($phonenumber)."<br>"."Full Name: ".strtoupper($fullname)."<br>"."Address: ".strtoupper($bse).", ".strtoupper($barangay).", ".strtoupper($city).", ".strtoupper($postalcode).", ".strtoupper($region);



                  foreach ($products as $product) {
                    if (isset($_POST['placeorder'])) { 
                          $query = "SELECT * FROM users WHERE fullname = '$fullname'";
                        $result = $db->query($query);
                        if ($result->num_rows > 0) {
                        while ($rows = $result->fetch_assoc()) {
                        $transid=$rows['transid'];
                        $phonenumber = $rows['phonenumber'];
                        $fullname = $rows['fullname'];
                        $postalcode = $rows['postalcode'];
                        $region = $rows['region'];
                        $city = $rows['city'];
                        $barangay = $rows['barangay'];
                        $bse = $rows['bse'];
                        }
                      }
                        $transid="Pending";               
                        $address = $bse."<br>".$barangay."<br>".$city."<br>".$region."<br>".$postalcode;
                        $email = $_SESSION['email'];
                        $emailsss = $_POST['email'];
                        $item = $product['name'];
                        $sub = (float)$product['price'];
                        $shippingoption = $_POST['so'];;
                        $fee = 50; 
                        $qtty=(int)$products_in_cart[$product['id']];
                        $pid=$product['id'];
                        $totalpayment = (float)$product['price'] * (int)$products_in_cart[$product['id']];
                        $cod = "Cash on Delivery";
                       
                        $mysqli = NEW MySQLi('localhost','id16475034_adminnew','-r?Hz6$5Z&+><9}9','id16475034_adminpanel');
                        
            
                        $transid = $mysqli->real_escape_string($transid);
                        $fullname = $mysqli->real_escape_string($fullname);
                        $phonenumber = $mysqli->real_escape_string($phonenumber);
                        $address = $mysqli->real_escape_string($address);
                        $email = $mysqli->real_escape_string($email);
                        $item = $mysqli->real_escape_string($item);
                        $sub = $mysqli->real_escape_string($sub);
                        $shippingoption = $mysqli->real_escape_string($shippingoption);
                        $fee = $mysqli->real_escape_string($fee);
                        $totalpayment = $mysqli->real_escape_string($totalpayment);
                        $cod = $mysqli->real_escape_string($cod);
          
          $mail = new PHPMailer;
$mail->isSMTP(); 
$mail->SMTPDebug = 2; // 0 = off (for production use) - 1 = client messages - 2 = client and server messages
$mail->Host = "smtp.gmail.com"; // use $mail->Host = gethostbyname('smtp.gmail.com'); // if your network does not support SMTP over IPv6
$mail->Port = 587; // TLS only
$mail->SMTPSecure = 'tls'; // ssl is deprecated
$mail->SMTPAuth = true;
$mail->Username = 'thehackerist2021@gmail.com'; // email
$mail->Password = 'th3hack3rist'; // password
$mail->setFrom('thehackerist2021@gmail.com', 'The Hackerists'); // From email and name
$mail->addAddress("$emailsss", ''); // to email and name
$mail->Subject = 'Order Confirmed';
$mail->msgHTML("Thank you for Ordering with Us, please contact thehackerist2021@gmail.com for additional help."); //$mail->msgHTML(file_get_contents('contents.html'), __DIR__); //Read an HTML message body from an external file, convert referenced images to embedded,
$mail->AltBody = 'HTML messaging not supported'; // If html emails is not supported by the receiver, show this body
// $mail->addAttachment('images/phpmailer_mini.png'); //Attach an image file
$mail->SMTPOptions = array(
                    'ssl' => array(
                        'verify_peer' => false,
                        'verify_peer_name' => false,
                        'allow_self_signed' => true
                    )
                );
if(!$mail->send()){
    //echo "Mailer Error: " . $mail->ErrorInfo;
}else{
//echo "Mailer Error: " . $mail->ErrorInfo;
}
                        //insert order into database
                        $insert = $mysqli->query("INSERT INTO codtotal(transid,fullname,phonenumber,address,email,item,subtotal,shippingoption,deliveryfee,totalpayment,cod)VALUES('$transid','$fullname','$phonenumber','$address','$email','$item','$sub','$shippingoption','$fee','$totalpayment','$cod')");
                        $insert2 = $mysqli->query("UPDATE products SET qty = (qty - $qtty) WHERE id = $pid");
                          unset($_SESSION['cart']);
                          header('Location:displayorder.php');
                        } } ?>

                <input class="btn btn-primary" type="submit" value="Place Order" name="placeorder" style="margin-bottom: 1rem; padding-left: 8rem; padding-right: 8rem;  ">


                <?php   
                  include("includes/connectionpayment.php");      

                  $phonenumber=$_SESSION['phonenumber'];
                  $fullname=$_SESSION['fullname'];
                  $postalcode=$_SESSION['postalcode'];
                  $region=$_SESSION['region'];
                  $city=$_SESSION['city'];
                  $barangay=$_SESSION['barangay'];
                  $bse=$_SESSION['bse'];

                  foreach ($products as $product) {
                  
                    if (isset($_POST['placeorderz'])) { 
                      $query = "SELECT * FROM users WHERE fullname = '$fullname'";
                        $result = $db->query($query);
                        if ($result->num_rows > 0) {
                        while ($rows = $result->fetch_assoc()) {
                        
                        $transid=$rows['transid'];
                        $phonenumber = $rows['phonenumber'];
                        $fullname = $rows['fullname'];
                        $postalcode = $rows['postalcode'];
                        $region = $rows['region'];
                        $city = $rows['city'];
                        $barangay = $rows['barangay'];
                        $bse = $rows['bse'];
                        }
                      }
                        $transid="Pending";              
                        $address = $bse."<br>".$barangay."<br>".$city."<br>".$region."<br>".$postalcode;
                        $email = $_POST['email'];
                        $item = $product['name'];
                        $sub = (float)$product['price'];
                        $shippingoption = $_POST['so'];;
                        $fee = 50; 
                        $qtty=(int)$products_in_cart[$product['id']];
                        $pid=$product['id'];
                        $totalpayment = (float)$product['price'] * (int)$products_in_cart[$product['id']];
                        $cod = "Paid Online";
                       
                          $mysqli = NEW MySQLi('localhost','id16475034_adminnew','-r?Hz6$5Z&+><9}9','id16475034_adminpanel');
                        $transid = $mysqli->real_escape_string($transid);
                        $fullname = $mysqli->real_escape_string($fullname);
                        $phonenumber = $mysqli->real_escape_string($phonenumber);
                        $address = $mysqli->real_escape_string($address);
                        $email = $mysqli->real_escape_string($email);
                        $item = $mysqli->real_escape_string($item);
                        $sub = $mysqli->real_escape_string($sub);
                        $shippingoption = $mysqli->real_escape_string($shippingoption);
                        $fee = $mysqli->real_escape_string($fee);
                        $totalpayment = $mysqli->real_escape_string($totalpayment);
                        $cod = $mysqli->real_escape_string($cod);

$mail = new PHPMailer;
$mail->isSMTP(); 
$mail->SMTPDebug = 2; // 0 = off (for production use) - 1 = client messages - 2 = client and server messages
$mail->Host = "smtp.gmail.com"; // use $mail->Host = gethostbyname('smtp.gmail.com'); // if your network does not support SMTP over IPv6
$mail->Port = 587; // TLS only
$mail->SMTPSecure = 'tls'; // ssl is deprecated
$mail->SMTPAuth = true;
$mail->Username = 'thehackerist2021@gmail.com'; // email
$mail->Password = 'th3hack3rist'; // password
$mail->setFrom('thehackerist2021@gmail.com', 'The Hackerists'); // From email and name
$mail->addAddress("$emailsss", ''); // to email and name
$mail->Subject = 'Order Confirmed';
$mail->msgHTML("Thank you for Ordering with Us, please contact thehackerist2021@gmail.com for additional help."); //$mail->msgHTML(file_get_contents('contents.html'), __DIR__); //Read an HTML message body from an external file, convert referenced images to embedded,
$mail->AltBody = 'HTML messaging not supported'; // If html emails is not supported by the receiver, show this body
// $mail->addAttachment('images/phpmailer_mini.png'); //Attach an image file
$mail->SMTPOptions = array(
                    'ssl' => array(
                        'verify_peer' => false,
                        'verify_peer_name' => false,
                        'allow_self_signed' => true
                    )
                );
if(!$mail->send()){
    //echo "Mailer Error: " . $mail->ErrorInfo;
}else{
//echo "Mailer Error: " . $mail->ErrorInfo;
}



                        //insert order into database
                        $insert = $mysqli->query("INSERT INTO codtotal(transid,fullname,phonenumber,address,email,item,subtotal,shippingoption,deliveryfee,totalpayment,cod)VALUES('$transid','$fullname','$phonenumber','$address','$email','$item','$sub','$shippingoption','$fee','$totalpayment','$cod')");
                        $insert2 = $mysqli->query("UPDATE products SET qty = (qty - $qtty) WHERE id = $pid");
                          unset($_SESSION['cart']);
                          header('Location:displayorder.php');
                         
                        } } ?>


                <input class="btn btn-primary" type="submit" value="Place Order" name="placeorderz" id="placeorderx" style="margin-bottom: 1rem; padding-left: 8rem; padding-right: 8rem;  " hidden>
             
              <div id="smart-button-container">
                <div style="text-align: center;">
                  <div id="paypal-button-container"></div>
                </div>
              </div>
              <input class="btn btn-primary" type="submit" value="Cancel" name="cancel" style="margin-bottom: 1rem; padding-left: 8rem; padding-right: 8rem;">  
              </div> 
            </div>
        </div>
      </div>
                 </div>
              </div>
            </div>
      </div>
    </div>           
 </form>
<?php endif; ?>

</section>


<script src="https://www.paypal.com/sdk/js?client-id=AX63JTokhsp_o0NFj_-cczReSRywLY6D_rVWHOM_W8bQJ6ShYuGKt70qrcx9KYLLlqiV89P-tYAtxldH&currency=PHP" data-sdk-integration-source="button-factory"></script>
  <script>
    function initPayPalButton() {
      paypal.Buttons({
        style: {
          shape: 'rect',
          color: 'blue',
          layout: 'vertical',
          label: 'paypal',

        },

        createOrder: function(data, actions) {
          return actions.order.create({
            purchase_units: [{"description":"Sampleeplep","amount":{"currency_code":"PHP","value":<?php echo ($subtotal + 49)?>+1,"breakdown":{"item_total":{"currency_code":"PHP","value":<?php echo ($subtotal + 49)?>},"shipping":{"currency_code":"PHP","value":1},"tax_total":{"currency_code":"PHP","value":0}}}}]
          });
        },

        onApprove: function(data, actions) {
          return actions.order.capture().then(function(details) {
            document.getElementById("placeorderx").click();
            alert('Transaction completed by ' + details.payer.name.given_name + '!'); 
            unset($_SESSION['cart']);
          });

        },

        onError: function(err) {
          console.log(err);

        }
      }).render('#paypal-button-container');
    }

    initPayPalButton();
  </script>

 <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
</div>
      <?php
          include 'includes/footers.php'
      ?>

      <!-- JavaScript files-->
      <?php
          include 'jsfile.php'
      ?>
    
  </body>
</html>