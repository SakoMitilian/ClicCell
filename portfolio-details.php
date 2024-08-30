<?php
include 'connection.php';

// Check if product ID is provided
if (!isset($_GET['id'])) {
    echo "No product ID provided!";
    exit;
}

// Sanitize and retrieve the product ID
$product_id = intval($_GET['id']);

// Prepare the SQL statement to fetch product details
$sql = "SELECT * FROM products WHERE id = ?";
$stmt = mysqli_prepare($conn, $sql);
if ($stmt) {
    mysqli_stmt_bind_param($stmt, "i", $product_id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    // Check if product exists
    if (!$result || mysqli_num_rows($result) === 0) {
        echo "Product not found!";
        exit;
    }

    // Fetch product details as an associative array
    $product = mysqli_fetch_assoc($result);

    // Close the statement
    mysqli_stmt_close($stmt);
} else {
    echo "Error preparing statement: " . mysqli_error($conn);
    exit;
}

// Close the database connection
mysqli_close($conn);

include 'header.php';
?>
<main id="main">

    <!-- ======= Breadcrumbs ======= -->
    <section id="breadcrumbs" class="breadcrumbs">
      <div class="container">

        <div class="d-flex justify-content-between align-items-center">
          <h2>Peoduct Details</h2>
          <ol>
            <li><a href="index.php">Home</a></li>
            <li>Product Details</li>
          </ol>
        </div>

      </div>
    </section><!-- End Breadcrumbs -->

    <!-- ======= Portfolio Details Section ======= -->
    <section id="portfolio-details" class="portfolio-details">
      <div class="container">
        <div class="row gy-4">
          <div class="col-lg-8">
            <!-- Replace the slider with a single image -->
            <img src="<?php echo htmlspecialchars($product['image']); ?>" alt="<?php echo htmlspecialchars($product['name'] ?? 'Product Image'); ?>
            " style="max-width: 100%; height: auto;">
          </div>
          <div class="col-lg-4">
            <div class="portfolio-info">
              <h3>Product information</h3>
              <ul>
                <li><strong>Category</strong>: <?php echo htmlspecialchars($product['category']); ?></li>
                <li><strong>Price</strong>: <?php echo htmlspecialchars($product['price']); ?></li>
                <li><strong>Product date</strong>: <?php echo htmlspecialchars($product['created_at']); ?></li>
              </ul>
            </div>
            <div class="portfolio-description">
              <h2>Product Description</h2>
              <p><?php echo nl2br(htmlspecialchars($product['description'])); ?></p>
            </div>
          </div>
        </div>
      </div>
    </section><!-- End Portfolio Details Section -->
</main>
<?php
include 'footer.php';
?>