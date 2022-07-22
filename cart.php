<?php 

  include'includes/headers.php';
?>


<?php
include 'includes/db.php';

// If the user clicked the add to cart button on the product page we can check for the form data
if (isset($_POST['product_id'], $_POST['quantity']) && is_numeric($_POST['product_id']) && is_numeric($_POST['quantity'])) {
    // Set the post variables so we easily identify them, also make sure they are integer
    $product_id = (int)$_POST['product_id'];
    $quantity = (int)$_POST['quantity'];
    // Prepare the SQL statement, we basically are checking if the product exists in our databaser
    $stmt = $db->prepare('SELECT * FROM products WHERE id = ?');
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
    header('location: index.php?page=cart');
    exit;
}

  // Remove product from cart, check for the URL param "remove", this is the product id, make sure it's a number and check if it's in the cart
  if (isset($_GET['remove']) && is_numeric($_GET['remove']) && isset($_SESSION['cart']) && isset($_SESSION['cart'][$_GET['remove']])) {
    // Remove the product from the shopping cart
    unset($_SESSION['cart'][$_GET['remove']]);
  }

  // Update product quantities in cart if the user clicks the "Update" button on the shopping cart page
  if (isset($_POST['update']) && isset($_SESSION['cart'])) {
    // Loop through the post data so we can update the quantities for every product in cart
    foreach ($_POST as $k => $v) {
        if (strpos($k, 'quantity') !== false && is_numeric($v)) {
            $id = str_replace('quantity-', '', $k);
            $quantity = (int)$v;
            // Always do checks and validation
            if (is_numeric($id) && isset($_SESSION['cart'][$id]) && $quantity > 0) {
                // Update new quantity
                $_SESSION['cart'][$id] = $quantity;
            }
        }
    }
    // Prevent form resubmission...
    header('location: index.php?page=cart');
    exit;
  }

  // Send the user to the place order page if they click the Place Order button, also the cart should not be empty
  if (isset($_POST['placeorder']) && isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
    header('Location: index.php?page=placeorder');
    exit;
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
    <div class="page-holder">
      <!-- navbar-->
       <?php
          include 'includes/navbar.php'
        ?>
      
      <div class="container">
        <!-- HERO SECTION-->
        <section class="py-5 bg-light">
          <div class="container">
            <div class="row px-4 px-lg-5 py-lg-4 align-items-center">
              <div class="col-lg-6">
                <h1 class="h2 text-uppercase mb-0">Cart</h1>
              </div>
              <div class="col-lg-6 text-lg-right">
                <nav aria-label="breadcrumb">
                  <ol class="breadcrumb justify-content-lg-end mb-0 px-0">
                    <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Cart</li>
                  </ol>
                </nav>
              </div>
            </div>
          </div>
        </section>
        <section class="py-5">
          <h2 class="h5 text-uppercase mb-4">Shopping cart</h2>
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
                      <th class="border-0" scope="col"> <strong class="text-small text-uppercase">Quantity</strong></th>
                      <th class="border-0" scope="col"> <strong class="text-small text-uppercase">Total</strong></th>
                      <th class="border-0" scope="col"> </th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php if (empty($products)): ?>
                    <tr>
                    <td colspan="5" style="text-align:center;">You have no products added in your Shopping Cart</td>
                    </tr>
                    <?php else: ?>
                    <?php foreach ($products as $product): ?>   
                    <tr>
                      <th class="pl-0 border-0" scope="row">
                        <div class="media align-items-center"><a class="reset-anchor d-block animsition-link" href=""><img src="img/<?=$product['image']?>" alt="<?=$product['name']?>" width="70"/></a>
                          <div class="media-body ml-3"><strong class="h6"><a class="reset-anchor animsition-link" href="index.php?page=product&id=<?=$product['id']?>"><?=$product['name']?></a></strong></div>
                        </div>
                      </th>
                      <td class="align-middle border-0">
                        <p class="mb-0 small"><?=$product['price']?></p>
                      </td>
                      <td class="align-middle border-0">
                        <div class="border d-flex align-items-center justify-content-between px-3"><span class="small text-uppercase text-gray headings-font-family">Quantity</span>
                          <div class="quantity">
                            
                            <input class="form-control form-control-sm border-0 shadow-0 p-0" name="quantity-<?=$product['id']?>" type="number" value="<?=$products_in_cart[$product['id']]?>"/>
                            
                          </div>
                        </div>
                      </td>
                      <td class="align-middle border-0">
                        <p class="mb-0 small"><?=$product['price'] * $products_in_cart[$product['id']]?></p>
                      </td>
                      <td class="align-middle border-0"><a class="reset-anchor" href="index.php?page=cart&remove=<?=$product['id']?>"><i class="fas fa-trash-alt small text-muted"></i></a></td>
                    </tr>
                    <?php endforeach; ?>
                    <?php endif; ?>
                  </tbody>
                </table>
              </div>

             
              <!-- CART NAV-->
              <div class="bg-light px-4 py-3">
                <div class="row align-items-center text-center">
                  <div class="col-md-6 mb-3 mb-md-0 text-md-left"><a class="btn btn-link p-0 text-dark btn-sm" href="index.php?page=products"><i class="fas fa-long-arrow-alt-left mr-2"> </i>Continue shopping</a></div>


                  <div class="col-md-6 text-md-right">
                    <div class="buttons" style="margin-top: 3rem;">
                      <input type="submit" value="Update" name="update" style=" background-color: #dcb14a; border-color: transparent;">
                      <input type="submit" value="Check Out" name="placeorder" style=" background-color: #dcb14a; border-color: transparent;">
                     </div>
                 </div>
                </div>
              </div>

              </form>
            </div>
            <!-- ORDER TOTAL-->
            <div class="col-lg-4">
              <div class="card border-0 rounded-0 p-lg-4 bg-light">
                <div class="card-body">
                  <h5 class="text-uppercase mb-4">Cart total</h5>
                  <ul class="list-unstyled mb-0">
                    <li class="d-flex align-items-center justify-content-between"><strong class="text-uppercase small font-weight-bold">Total</strong><span class="text-muted small"><?=$subtotal?></span></li>
                    <li class="border-bottom my-2"></li>
                  </ul>
                </div>
              </div>
            </div>
          </div>
        </section>
      </div>

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