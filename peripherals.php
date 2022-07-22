
<?php
  include 'includes/headers.php'
?>

<?php
// The amounts of products to show on each page
$num_products_on_each_page = 12;
// The current page, in the URL this will appear as index.php?page=products&p=1, index.php?page=products&p=2, etc...
$current_page = isset($_GET['p']) && is_numeric($_GET['p']) ? (int)$_GET['p'] : 1;
// Select products ordered by the date added
$stmt = $db->prepare('SELECT * FROM products WHERE categories_id=2 ORDER BY date_added DESC LIMIT ?,?');
// bindValue will allow us to use integer in the SQL statement, we need to use for LIMIT
$stmt->bindValue(1, ($current_page - 1) * $num_products_on_each_page, PDO::PARAM_INT);
$stmt->bindValue(2, $num_products_on_each_page, PDO::PARAM_INT);
$stmt->execute();
// Fetch the products from the database and return the result as an Array
$products = $stmt->fetchAll(PDO::FETCH_ASSOC);
// Get the total number of products
$total_products = $db->query('SELECT * FROM products WHERE categories_id=2')->rowCount();
?>

    <div class="page-holder">
      <!-- navbar-->
        <?php
          include 'includes/navbar.php'
        ?>
      
      <!-- HERO SECTION-->
      <div class="container">
       
       
        <!-- TRENDING PRODUCTS-->
        <section class="py-5">
          <header>
            
            <h2 class="h5 text-uppercase mb-4">Peripherals</h2>
            <p  class="text-muted"><?=$total_products?> Products</p>
          </header>
          <div class="row">
            <!-- PRODUCT-->
            <?php foreach ($products as $product): ?>
            <div class="col-xl-3 col-lg-4 col-sm-6">
              <div class="product text-center">
                <div class="position-relative mb-3">
                  <div class="badge text-white badge-"></div><a class="d-block" href="index.php?page=product&id=<?=$product['id']?>"><img class="img-fluid w-100" style="width: 5rem; height: 15rem;" src="img/<?=$product['image']?>" alt="<?=$product['name']?>"></a>
                  <div class="product-overlay">
                    <ul class="mb-0 list-inline">
                      
                       <li class="list-inline-item m-0 p-0"><a class="btn btn-sm btn-dark" href="index.php?page=product&id=<?=$product['id']?>">View</a></li>
                     
                    </ul>
                  </div>
                </div>
                <h6> <a class="reset-anchor" href="detail.html"><?=$product['name']?></a></h6>
                <p class="small text-muted"><?=$product['price']?></p>
              </div>
            </div>
          <?php endforeach; ?>
       
          </div>
            <div class="buttons">
                <?php if ($current_page > 1): ?>
                <a href="index.php?page=products&p=<?=$current_page-1?>">Prev</a>
                <?php endif; ?>
                <?php if ($total_products > ($current_page * $num_products_on_each_page) - $num_products_on_each_page + count($products)): ?>
                <a href="index.php?page=products&p=<?=$current_page+1?>">Next</a>
                <?php endif; ?>
            </div>
        </section>

        <!-- SERVICES-->
        <section class="py-5 bg-light">
          <div class="container">
            <div class="row text-center">
              <div class="col-lg-4 mb-3 mb-lg-0">
                <div class="d-inline-block">
                  <div class="media align-items-end">
                    <svg class="svg-icon svg-icon-big svg-icon-light">
                      <use xlink:href="#delivery-time-1"> </use>
                    </svg>
                    <div class="media-body text-left ml-3">
                    <h6 class="text-uppercase mb-1">Free shipping</h6>
                    <p class="text-small mb-0 text-muted">Free shipping worlwide on certain purchase amounts</p>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-lg-4 mb-3 mb-lg-0">
                <div class="d-inline-block">
                  <div class="media align-items-end">
                    <svg class="svg-icon svg-icon-big svg-icon-light">
                      <use xlink:href="#helpline-24h-1"> </use>
                    </svg>
                    <div class="media-body text-left ml-3">
                    
                      <h6 class="text-uppercase mb-1">24 x 7 service</h6>
                      <p class="text-small mb-0 text-muted">Just Contact us by dropping us an email</p>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-lg-4">
                <div class="d-inline-block">
                  <div class="media align-items-end">
                    <svg class="svg-icon svg-icon-big svg-icon-light">
                      <use xlink:href="#label-tag-1"> </use>
                    </svg>
                    <div class="media-body text-left ml-3">
                      <h6 class="text-uppercase mb-1">Festival offer</h6>
                      <p class="text-small mb-0 text-muted">Offers wide ranged of products online, and effective services on-site</p>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </section>  
        
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