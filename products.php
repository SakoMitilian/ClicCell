<?php
include 'header.php';
include 'connection.php';

// Fetch products from the database
$sql = "SELECT * FROM products";
$result = mysqli_query($conn, $sql);
?>

<section id="portfolio" class="portfolio mt-5">
  <div class="container">
    <div class="section-title" data-aos="fade-left">
      <h2>Products</h2>
      <p>These are our products. Please call or text for more info about them.</p>
    </div>

    <div class="row" data-aos="fade-up" data-aos-delay="100">
      <div class="col-lg-12 d-flex justify-content-center">
        <ul id="portfolio-flters">
          <li data-filter="*" class="filter-active">All</li>
          <li data-filter=".filter-computer">Computer</li>
          <li data-filter=".filter-laptop">Laptop</li>
          <li data-filter=".filter-accessories">Accessories</li>
        </ul>
      </div>
    </div>

    <div class="row portfolio-container" data-aos="fade-up" data-aos-delay="200">
      <?php
      // Loop through each product fetched from the database
      while ($row = mysqli_fetch_assoc($result)) {
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
<script src="assets/js/catagories.js"></script>