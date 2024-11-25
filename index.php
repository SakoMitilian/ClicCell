<?php
include 'connection.php';
include 'header.php';
?>


  <section id="hero" class="d-flex align-items-center">
    <div class="container text-center position-relative" data-aos="fade-in" data-aos-delay="200">
      <h1>Your New Online Presence with Clic Cell</h1>
      <h2>We are a small shop of talented IT specialists fixing your devices in record time !</h2>
      <a href="prodcuts.php" class="btn-get-started scrollto">Get Started</a>
    </div>
  </section>

  <main id="main">

    <section id="clients" class="clients">
      <div class="container">
        <div class="row">
            
          <div class="col-lg-2 col-md-4 col-6 d-flex align-items-center" data-aos="zoom-in" data-aos-delay="100">
            <img src="images/spark.jpeg" class="img-fluid" alt="">
          </div>

          <div class="col-lg-2 col-md-4 col-6 d-flex align-items-center" data-aos="zoom-in" data-aos-delay="200">
            <img src="images/R.png" class="img-fluid" alt="">
          </div>

          <div class="col-lg-2 col-md-4 col-6 d-flex align-items-center" data-aos="zoom-in" data-aos-delay="300">
            <img src="images/samsung logo.png" class="img-fluid" alt="">
          </div>

          <div class="col-lg-2 col-md-4 col-6 d-flex align-items-center" data-aos="zoom-in" data-aos-delay="400">
            <img src="images/lenovo-logo-0.png" class="img-fluid" alt="">
          </div>

          <div class="col-lg-2 col-md-4 col-6 d-flex align-items-center" data-aos="zoom-in" data-aos-delay="500">
            <img src="images/Alienware-Logo.png" class="img-fluid" alt="">
          </div>

          <div class="col-lg-2 col-md-4 col-6 d-flex align-items-center" data-aos="zoom-in" data-aos-delay="600">
            <img src="images/hp logo.png" class="img-fluid" alt="">
          </div>

        </div>

      </div>
    </section>

    <!-- ======= Why Us Section ======= -->
    <section id="why-us" class="why-us">
      <div class="container">

        <div class="row">
          <div class="col-lg-4 d-flex align-items-stretch" data-aos="fade-right">
            <div class="content">
              <h3>Why Choose Clic Cell for your technical Needs?</h3>
              <p>
                We at Clic Cell all have years of experience repairing phones, computers, installing software and many other services. We have the best prices for phones laptops and all other products you might need.
              </p>
              <div class="text-center">
                <a href="#" class="more-btn">Learn More <i class="bx bx-chevron-right"></i></a>
              </div>
            </div>
          </div>
          <div class="col-lg-8 d-flex align-items-stretch">
            <div class="icon-boxes d-flex flex-column justify-content-center">
              <div class="row">
                <div class="col-xl-4 d-flex align-items-stretch" data-aos="zoom-in" data-aos-delay="100">
                  <div class="icon-box mt-4 mt-xl-0">
                    <i class="bx bx-receipt"></i>
                    <h4>Certified</h4>
                    <p>All of our employees have got a Bachellors degree in Computer Science</p>
                  </div>
                </div>
                <div class="col-xl-4 d-flex align-items-stretch" data-aos="zoom-in" data-aos-delay="200">
                  <div class="icon-box mt-4 mt-xl-0">
                    <i class="bx bx-cube-alt"></i>
                    <h4>Money Gram</h4>
                    <p>We also provide currency exchange and sending money to other countries</p>
                  </div>
                </div>
                <div class="col-xl-4 d-flex align-items-stretch" data-aos="zoom-in" data-aos-delay="300">
                  <div class="icon-box mt-4 mt-xl-0">
                    <i class="bx bx-images"></i>
                    <h4>Warranty</h4>
                    <p>All of our items have got a 1 year warranty!</p>
                  </div>
                </div>
              </div>
            </div><!-- End .content-->
          </div>
        </div>

      </div>
    </section><!-- End Why Us Section -->

    <!-- ======= Cta Section ======= -->
    <section id="cta" class="cta">
      <div class="container">

        <div class="text-center" data-aos="zoom-in">
          <h3>Call To Action</h3>
          <p> If you are interested in what you have been reading and seeing so far contact us for more details!</p>
          <a class="cta-btn" href="contact.php">Call To Action</a>
        </div>

      </div>
    </section><!-- End Cta Section -->

    <!-- ======= Portfolio Section ======= -->
    <?php

$sql = "SELECT * FROM products";
$result = mysqli_query($conn, $sql);
?>

<section id="portfolio" class="portfolio">
  <div class="container">
    <div class="section-title" data-aos="fade-left">
      <h2>Featured Products</h2>
      <p>Best Selling items this week.</p>
    </div>
    <div class="row portfolio-container" data-aos="fade-up" data-aos-delay="200">
      <?php
      $counter = 0;
while ($row = mysqli_fetch_assoc($result)) {
  if ($counter >= 3) {
    break;
}
?>
  <div class="col-lg-4 col-md-6 portfolio-item filter-<?php echo strtolower($row['category']); ?>">
    <div class="portfolio-wrap">
      <img src="<?php echo $row['image']; ?>" class="img-fluid" alt="">
      <div class="portfolio-info">
        <h4><?php echo $row['name']; ?></h4>
        <p><?php echo $row['category']; ?></p>
        <div class="portfolio-links">
          <a href="<?php echo $row['image']; ?>" data-gallery="portfolioGallery" class="portfolio-lightbox" title="<?php echo $row['name']; ?>"><i class="bx bx-plus"></i></a>
          <a href="portfolio-details.php?id=<?php echo $row['id']; ?>" title="More Details"><i class="bx bx-link"></i></a>
        </div>
      </div>
    </div>
  </div>
<?php
}
?>

    </div>
  </div>
</section>

<?php 
include 'footer.php';
?>