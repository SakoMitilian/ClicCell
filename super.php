<?php
// Assuming connection is established in connection.php
include 'connection.php';
session_start();

if (!isset($_SESSION['is_superuser']) || !$_SESSION['is_superuser']) {
    header("Location: error-404.php");
    exit();
  }

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["phone_number"])) {
    // Remove the superuser from the database
    $phone_number = $_POST["phone_number"];
    $sql = "DELETE FROM users WHERE phone_number = '$phone_number' AND is_superuser = 1";
    if ($conn->query($sql) === TRUE) {
        // Alert superuser removed
        echo '<script>alert("Superuser removed successfully");</script>';
        // Redirect back to superuser management page
        echo '<script>window.location.replace("super.php");</script>';
        exit(); // Stop further execution
    } else {
        echo "Error removing superuser: " . $conn->error;
    }
}

// Fetch only superusers from the database
$sql = "SELECT phone_number, first_name, last_name, email, is_superuser FROM users WHERE is_superuser = 1"; // Replace with your actual table name
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Superuser Management</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/styles.css">
    <link rel="stylesheet" href="assets/css/user.css">
    
</head>
<body>
<a href="admin.php" class="logo"><img src="images/CLIC_CELL-modified.png" width="50px" height="50px"></a>
<div class="container mt-5">
    
    <h2 class="mb-4">Superuser Management</h2>
    <table class="table">
        <thead>
        <tr>
            <th>Phone Number</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Email</th>
            <th>Action</th> <!-- Added Remove button column -->
        </tr>
        </thead>
        <tbody>
        <?php
        if ($result->num_rows > 0) {
            // Output data of each row
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row["phone_number"] . "</td>";
                echo "<td>" . $row["first_name"] . "</td>";
                echo "<td>" . $row["last_name"] . "</td>";
                echo "<td>" . $row["email"] . "</td>";
                // Add a remove button that submits a form to delete the superuser
                echo '<td><form method="post">';
                echo '<input type="hidden" name="phone_number" value="' . $row["phone_number"] . '">';
                echo '<button type="submit" class="btn btn-danger btn-sm">Remove</button>';
                echo '</form></td>';
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='5'>No superusers found</td></tr>";
        }
        ?>
        </tbody>
    </table>
</div>
</body>
</html>
