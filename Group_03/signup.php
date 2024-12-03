<?php
// Include database connection
include('db_conn.php');

// Initialize variables for error and success messages
$error = '';
$success = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get user input from form
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);
    $confirm_password = trim($_POST['confirm_password']);

    // Validate inputs
    if (empty($username) || empty($email) || empty($password) || empty($confirm_password)) {
        $error = "All fields are required.";
    } elseif ($password !== $confirm_password) {
        $error = "Passwords do not match.";
    } else {
        // Sanitize the input to prevent SQL injection
        $username = mysqli_real_escape_string($dbc, $username);
        $email = mysqli_real_escape_string($dbc, $email);
        $password = mysqli_real_escape_string($dbc, $password);

        // Check if username already exists
        $checkQuery = "SELECT * FROM users WHERE username = '$username' OR email = '$email' LIMIT 1";
        $checkResult = mysqli_query($dbc, $checkQuery);

        if ($checkResult && mysqli_num_rows($checkResult) > 0) {
            $error = "Username or Email already exists.";
        } else {
            // Hash the password before storing it
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);

            // Insert new user into the database
            $query = "INSERT INTO users (username, email, password) VALUES ('$username', '$email', '$hashed_password')";
            if (mysqli_query($dbc, $query)) {
                $success = "Account created successfully. You can now <a href='login.php'>login</a>.";
            } else {
                $error = "Error creating account. Please try again later.";
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Sign Up - Alloy Wheel Products</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>

  <!-- Header Section -->
  <header class="header">
    <div class="logo">
      <img src="images/logo.jpg" alt="Alloy Wheel Logo">
      <h1>Alloy Wheel</h1>
    </div>
    <nav>
      <a href="products.php">PRODUCTS</a>
      <a href="login.php">LOGIN</a>
      <a href="checkout.php">CHECKOUT</a>
    </nav>
   
  </header>

  <!-- Signup Form Section -->
  <main class="signup-main">
    <h2>Create a New Account</h2>

    <?php if ($error): ?>
      <p class="error"><?php echo $error; ?></p>
    <?php endif; ?>

    <?php if ($success): ?>
      <p class="success"><?php echo $success; ?></p>
    <?php endif; ?>

    <form action="signup.php" method="POST">
      <label for="username">Username</label>
      <input type="text" name="username" id="username" required>

      <label for="email">Email</label>
      <input type="email" name="email" id="email" required>

      <label for="password">Password</label>
      <input type="password" name="password" id="password" required>

      <label for="confirm_password">Confirm Password</label>
      <input type="password" name="confirm_password" id="confirm_password" required>

      <button type="submit">Sign Up</button>

      <p>Already have an account? <a href="login.php">Login here</a></p>
    </form>
  </main>

  <!-- Footer Section -->
  <footer class="footer">
    <p>© 2024 AlloyWheels.com All Rights Reserved</p>
  </footer>

</body>
</html>
