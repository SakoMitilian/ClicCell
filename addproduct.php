<?php
include 'connection.php';
session_start();

if (!isset($_SESSION['is_superuser']) || !$_SESSION['is_superuser']) {
    header("Location: /error-404.html");
    exit();
  }

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $quantity = $_POST['quantity'];
    $price = $_POST['price'];
    $category = $_POST['category']; // New category field
    $description = $_POST['description']; // New description field
    $image = $_FILES['image']['name'];
    $image_temp = $_FILES['image']['tmp_name'];

    // Directory where the image will be uploaded
    $upload_dir = 'uploads/';
    $upload_file = $upload_dir . basename($image);

    // Validate input fields
    if (empty($name) || empty($quantity) || empty($price) || empty($category) || empty($description) || empty($image)) {
        $error = "All fields are required.";
    } else {
        // Move the uploaded image to the uploads directory
        if (move_uploaded_file($image_temp, $upload_file)) {
            // Prepare and bind
            $stmt = $conn->prepare("INSERT INTO products (name, price, image, created_at, updated_at, quantity, category, description) VALUES (?, ?, ?, NOW(), NOW(), ?, ?, ?)");
            if ($stmt) {
                $stmt->bind_param("sdsiss", $name, $price, $upload_file, $quantity, $category, $description);
                if ($stmt->execute()) {
                    $success_message = "New product added successfully.";
                } else {
                    $error = "Error: " . $stmt->error;
                }
                $stmt->close();
            } else {
                $error = "Error: " . $conn->error;
            }
        } else {
            $error = "Failed to upload image.";
        }
    }

    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add Product</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/styles.css">
</head>
<body>
<a href="admin.php" class="logo"><img src="images/CLIC_CELL-modified.png" width="50px" height="50px"></a>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h2>Add a New Product</h2>
                    </div>
                    <div class="card-body">
                        <?php if (isset($error)): ?>
                            <div class="alert alert-danger"><?php echo $error; ?></div>
                        <?php endif; ?>
                        <?php if (isset($success_message)): ?>
                            <div class="alert alert-success"><?php echo $success_message; ?></div>
                        <?php endif; ?>
                        <form action="addproduct.php" method="post" enctype="multipart/form-data">
                            <div class="form-group">
                                <label for="name">Product Name:</label>
                                <input type="text" class="form-control" id="name" name="name" maxlength="50" required>
                            </div>
                            <div class="form-group">
                                <label for="quantity">Quantity:</label>
                                <input type="number" class="form-control" id="quantity" name="quantity" required>
                            </div>
                            <div class="form-group">
                                <label for="price">Price:</label>
                                <input type="number" step="0.01" class="form-control" id="price" name="price" required>
                            </div>
                            <div class="form-group">
                                <label for="category">Category:</label>
                                <select class="form-control" id="category" name="category" required>
                                    <option value="iphone">Phone</option>
                                    <option value="samsung">Computer</option>
                                    <option value="laptop">Laptop</option>
                                    <option value="console">Accessories</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="description">Description:</label>
                                <textarea class="form-control" id="description" name="description" rows="3" required></textarea>
                            </div>
                            <div class="form-group">
                                <label for="image">Image:</label>
                                <input type="file" class="form-control-file" id="image" name="image" accept="image/*" required>
                            </div>
                            <button type="submit" class="btn btn-primary btn-block">Add Product</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
