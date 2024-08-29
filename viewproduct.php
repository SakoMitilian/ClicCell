<?php
include 'connection.php';
session_start();

if (!$_SESSION['is_superuser']) {
    echo "Access denied. You are not a superuser.";
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['remove_product'])) {
    $product_id = $_POST['remove_product'];
    $sql = "DELETE FROM products WHERE id = ?";
    $stmt = $conn->prepare($sql);
    if ($stmt) {
        $stmt->bind_param("i", $product_id);
        if ($stmt->execute()) {
            echo "<script>alert('Product removed successfully.');</script>";
        } else {
            echo "<script>alert('Failed to remove product.');</script>";
        }
        $stmt->close();
    } else {
        echo "<script>alert('Database error: Could not prepare statement.');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Product View</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/assets/css/view.css">
    <link rel="stylesheet" href="/assets/css/styles.css">
</head>
<body>
<a href="admin.php" class="logo"><img src="/images/CLIC_CELL-modified.png" width="50px" height="50px"></a>
    <div class="container">
        <h2>Product List</h2>
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Category</th>
                    <th>Description</th>
                    <th>Quantity</th>
                    <th>Price</th>
                    <th>Image</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $sql = "SELECT * FROM products";
                $result = mysqli_query($conn, $sql);
                if ($result) {
                    if (mysqli_num_rows($result) > 0) {
                        while ($row = mysqli_fetch_array($result)) {
                            echo "<tr>";
                            echo "<td>" . htmlspecialchars($row['name']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['category']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['description']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['quantity']) . "</td>";
                            echo "<td>$" . htmlspecialchars($row['price']) . "</td>";
                            echo "<td><img src='" . htmlspecialchars($row['image']) . "' alt='" . htmlspecialchars($row['name']) . "' style='width: 50px; height: 50px;'></td>";
                            echo "<td>
                                    <form method='POST'>
                                        <button type='submit' name='remove_product' class='btn btn-danger' value='" . htmlspecialchars($row['id']) . "'>Remove</button>
                                    </form>
                                </td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='7'>No products found</td></tr>";
                    }
                } else {
                    echo "<tr><td colspan='7'>Error: " . mysqli_error($conn) . "</td></tr>";
                }
                mysqli_close($conn);
                ?>
            </tbody>
        </table>
    </div>
    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
