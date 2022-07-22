
<?php include 'includes/headers.php'; ?>


<?php 

        if(!empty($_SESSION["username"]) && $_SESSION["username"]=="admin"){ 

?>

<?php header('location:adminnew/login.php'); ?>

<?php
        } else {
?>

<?php
  
  $page = 'home';
  
?>

<?php
// Get the 4 most recently added products
$stmt = $db->prepare('SELECT * FROM products ORDER BY date_added DESC LIMIT 8');
$stmt->execute();
$recently_added_products = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>

<script crossorigin="anonymous" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script crossorigin="anonymous" integrity="sha384-oesi62hOLfzrys4LxRF63OJCXdXDipiYWBnvTl9Y9/TRlw5xlKIEHpNyvvDShgf/" src="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/js/bootstrap.min.js"></script>

    
      <!-- navbar-->
        <?php
          include 'includes/navbar.php'
        ?>

      <!-- HERO SECTION-->
      <div class="headerx" style="background: #fff;">
      <div class="container">
          <?php
              include 'includes/slider.php'
            ?>
        </div>

      <svg class="waves" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 24 150 28" preserveAspectRatio="none" shape-rendering="auto">
            <defs><path id="gentle-wave" d="M-160 44c30 0 58-18 88-18s 58 18 88 18 58-18 88-18 58 18 88 18 v44h-352z" /></defs>
            <g class="parallax">
                <use xlink:href="#gentle-wave" x="48" y="0" fill="#458ce2" />
                <use xlink:href="#gentle-wave" x="48" y="3" fill="#5194e4" />
                <use xlink:href="#gentle-wave" x="48" y="5" fill="#5795df" />
                <use xlink:href="#gentle-wave" x="48" y="7" fill="#2e80e3" />
            </g>
        </svg>
    </div>

<section class="pt-5" style="margin-top: -3rem;">
<div class="headerx">
  <div class="container">
          <header class="text-center" style="padding-top: 2rem;">
            <p class="h6 text-uppercase mb-4">Fastest repair service with best price!</p>
            <h2 class="h3 text-uppercase mb-4">Why Choose Us</h2>
          </header>

             <div class="row mbr-justify-content-center">

            <div class="col-lg-6 mbr-col-md-10">
                <div class="wrap">
                    <div class="ico-wrap">
                        <span><img src="images/it_service/i1.png" alt="#" style="width: 6rem;
  height: 4rem;"></span>
                    </div>
                    <div class="text-wrap vcenter">
                        <h2 class="mbr-fonts-style mbr-bold mbr-section-title3 display-5">Data <span>Recovery</span></h2>
                        <p class="mbr-fonts-style text1 mbr-text display-6">On site Data Recovery for deleted files/images/videos.</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 mbr-col-md-10">
                <div class="wrap">
                    <div class="ico-wrap">
                        <span><img src="images/it_service/i2.png" alt="#" style="width: 6rem;
  height: 4rem;"></span>
                    </div>
                    <div class="text-wrap vcenter">
                        <h2 class="mbr-fonts-style mbr-bold mbr-section-title3 display-5">Computer
                            <span>repair</span>
                        </h2>
                        <p class="mbr-fonts-style text1 mbr-text display-6">Diagnose, repair, and replace parts to fix the system</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 mbr-col-md-10">
                <div class="wrap">
                    <div class="ico-wrap">
                        <span><img src="images/it_service/i3.png" alt="#" style="width: 6rem;
  height: 4rem;"></span>
                    </div>
                    <div class="text-wrap vcenter">
                        <h2 class="mbr-fonts-style mbr-bold mbr-section-title3 display-5">Mobile
                            <span>service</span>
                        </h2>
                        <p class="mbr-fonts-style text1 mbr-text display-6">Includes repairing and data recovery of mobile phones</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 mbr-col-md-10">
                <div class="wrap">
                    <div class="ico-wrap">
                        <span><img src="images/it_service/i4.png" alt="#" style="width: 6rem;
  height: 4rem;"></span>
                    </div>
                    <div class="text-wrap vcenter">
                        <h2 class="mbr-fonts-style mbr-bold mbr-section-title3 display-5">Network <span>solutions</span></h2>
                        <p class="mbr-fonts-style text1 mbr-text display-6">Offers advices and components for sale for better network</p>
                    </div>
                </div>
            </div>
        </div>
      </div>
      <svg class="waves" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 24 150 28" preserveAspectRatio="none" shape-rendering="auto">
            <defs><path id="gentle-wave" d="M-160 44c30 0 58-18 88-18s 58 18 88 18 58-18 88-18 58 18 88 18 v44h-352z" /></defs>
            <g class="parallax">
                <use xlink:href="#gentle-wave" x="48" y="0" fill="rgba(255,255,255,0.7" />
                <use xlink:href="#gentle-wave" x="48" y="3" fill="rgba(255,255,255,0.5)" />
                <use xlink:href="#gentle-wave" x="48" y="5" fill="rgba(255,255,255,0.3)" />
                <use xlink:href="#gentle-wave" x="48" y="7" fill="#fff" />
            </g>
        </svg>
    </div>
</section>

<section class="pt-5" style="margin-top: -3rem;">



<div class="service py-5">
      <div class="container-fluid">
          <div class="col-md-10 col-11 mx-auto">
            <header class="text-center" style="padding-top: 2rem;">
          
            <h2 class="h3 text-uppercase mb-4">Our Service</h2>
          </header>
          <div class="container">
            <div class="row ">
              <!-- left side data -->
              <div class="col-md-6 mt-md-2 m-0">
                <span class="badge-info badge rounded-pill px-3 py-1 my-2 font-weight-light">
                  What We Do
                </span>
                <h4>Awesome with Extra Ordinary Flexibility Features</h4>
                <h6 class="font-weight-light subtitle">You can relay on our amazing features list and also our customer services will be great experience for you without doubt and in no-time</h6>
                <!-- one more grid sys for services -->
                <div class="row mt-md-5">
                  <div class="col-md-6 mt-3">
                    <h6 class="font-weight-medium">Data Recovery</h6>
                    <p>On site Data Recovery for deleted files/images/videos.
</p>
                  </div>
                  <div class="col-md-6 mt-3">
                    <h6 class="font-weight-medium">Mobile Services</h6>
                    <p>Includes repairing and data recovery of mobile phones</p>
                  </div>
                  <div class="col-md-6 mt-3">
                    <h6 class="font-weight-medium">System Maintenance</h6>
                    <p>Offers wide array of products and tips to maintain your system, be it PC or Mobile</p>
                  </div>
                  <div class="col-md-6 mt-3">
                    <h6 class="font-weight-medium">Network Service</h6>
                    <p>Offers advices and components for sale for better and efficient network</p>
                  </div>
                  <div class="col-lg-12 my-4">
                    <a class="btn btn-sm btn-info" style="border-raidius:5px;" href="index.php?page=services"> Check More </a>
                  </div>
                </div>
              </div>
              <!-- right side data -->
              <div class="col-md-6 mt-md-5 m-0">
                <div class="row wrap-service">
                  <!-- left side images -->
                  <div class="col-md-6">
                    <div class="row">
                      <div class="col-md-12 img-hover mb-4">
                        <img alt="ux" class="rounded img-shadow img-fluid" src="img/services/s1.jpg" />
                      </div>
                      <div class="col-md-12 img-hover mb-4">
                        <img alt="ux" class="rounded img-shadow img-fluid" src="img/services/s2.jpg" />
                      </div>
                    </div>
                  </div>
                  <!-- right side images -->
                  <div class="col-md-6 uneven-box">

                    

                    <div class="row">
                      <div class="col-md-12 img-hover mb-4">
                        <img alt="ux" class="rounded img-shadow img-fluid" src="img/services/s3.png" />
                      </div>
                      <div class="col-md-12 img-hover mb-4">
                        <img alt="ux" class="rounded img-shadow img-fluid" src="img/services/s4.png" />
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

</section>






        <!-- CATEGORIES SECTION-->
        <div class="container">
            <?php
              include 'category.php'
            ?>
        </div>
        <!-- TRENDING PRODUCTS-->
        <section class="py-5">

          <div class="container">
          <header>
            
            <h2 class="h5 text-uppercase mb-4">Recently added products</h2>
          </header>
          <div class="row">
            <!-- PRODUCT-->
            <?php foreach ($recently_added_products as $product): ?>
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
        </section>

        <!-- SERVICES-->
        <section class="py-5 bg-light" style="margin-bottom: -3rem;">
          <div class="headerx" style="background: #fff;">
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
          <svg class="waves" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 24 150 28" preserveAspectRatio="none" shape-rendering="auto">
            <defs><path id="gentle-wave" d="M-160 44c30 0 58-18 88-18s 58 18 88 18 58-18 88-18 58 18 88 18 v44h-352z" /></defs>
            <g class="parallax">
                <use xlink:href="#gentle-wave" x="48" y="0" fill="#458ce2" />
                <use xlink:href="#gentle-wave" x="48" y="3" fill="#5194e4" />
                <use xlink:href="#gentle-wave" x="48" y="5" fill="#5795df" />
                <use xlink:href="#gentle-wave" x="48" y="7" fill="#2e80e3" />
            </g>
        </svg>
    </div>

        </section>      
      


      <?php
          include 'includes/footers.php'
      ?>

      <!-- JavaScript files-->
      <?php
          include 'jsfile.php'
      ?>
  
    

<?php } ?>


  


