<?php
// Assuming connection is established in connection.php
include 'connection.php';
session_start();

// Check if user is a superuser
if (!isset($_SESSION['is_superuser']) || !$_SESSION['is_superuser']) {
    header("Location: /error-404.html");
    exit();
  }
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["phone_number"])) {
    // Remove the user from the database
    $phone_number = $_POST["phone_number"];
    $sql = "DELETE FROM users WHERE phone_number = '$phone_number'";
    if ($conn->query($sql) === TRUE) {
        // Alert user removed
        echo '<script>alert("User removed successfully");</script>';
        // Redirect back to users page
        echo '<script>window.location.replace("users.php");</script>';
        exit(); // Stop further execution
    } else {
        echo "Error removing user: " . $conn->error;
    }
}

// Fetch users from the database
$sql = "SELECT phone_number, first_name, last_name, email, is_superuser FROM users"; // Replace with your actual table name
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>User Management</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/styles.css">
    <link rel="stylesheet" href="assets/css/user.css">
</head>
<body>
<a href="admin.php" class="logo"><img src="/images/CLIC_CELL-modified.png" width="50px" height="50px"></a>
<div class="container mt-5">
    <h2 class="mb-4">User Management</h2>
    <table class="table">
        <thead>
        <tr>
            <th>Phone Number</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Email</th>
            <th>Is Superuser</th>
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
                echo "<td>" . ($row["is_superuser"] ? 'True' : 'False') . "</td>";
                // Conditionally display remove button based on is_superuser field
                if (!$row["is_superuser"]) {
                    echo '<td><form method="post">';
                    echo '<input type="hidden" name="phone_number" value="' . $row["phone_number"] . '">';
                    echo '<button type="submit" class="btn btn-danger btn-sm">Remove</button>';
                    echo '</form></td>';
                } else {
                    echo '<td>No action</td>'; // Or any other message you want
                }
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='6'>No users found</td></tr>";
        }
        ?>
        </tbody>
    </table>
</div>
</body>
</html>
