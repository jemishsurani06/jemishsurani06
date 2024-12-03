<?php
// Include database connection
include('db_conn.php');

// Initialize variables for error and success messages
$error = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get user input from form
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    // Validate inputs
    if (empty($username) || empty($password)) {
        $error = "Please enter both username and password.";
    } else {
        // Sanitize the input to prevent SQL injection
        $username = mysqli_real_escape_string($dbc, $username);
        $password = mysqli_real_escape_string($dbc, $password);

        // Query to check if the username exists and match the password
        $query = "SELECT * FROM users WHERE username = '$username' LIMIT 1";
        $result = mysqli_query($dbc, $query);

        if ($result && mysqli_num_rows($result) > 0) {
            // Fetch user details from the database
            $user = mysqli_fetch_assoc($result);

            // Verify password using password_verify() if hashed in the database
            if (password_verify($password, $user['password'])) {
                // Start session and store user details
                session_start();
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['username'] = $user['username'];

                // Redirect to the homepage or user dashboard
                header('Location: home.php');  // Changed to 'home.php' for the homepage
                exit;
            } else {
                $error = "Incorrect username or password.";
            }
        } else {
            $error = "No user found with this username.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login - Alloy Wheel Products</title>
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
      <a href="home.php">HOME</a> 
      <a href="signup.php">SIGNUP</a>
      <a href="checkout.php">CHECKOUT</a>
    </nav>
  </header>

  <!-- Login Form Section -->
  <main class="login-main">
    <h2>Login to Your Account</h2>

    <?php if ($error): ?>
      <p class="error"><?php echo $error; ?></p>
    <?php endif; ?>

    <form action="login.php" method="POST">
      <label for="username">Username or Email</label>
      <input type="text" name="username" id="username" required>

      <label for="password">Password</label>
      <input type="password" name="password" id="password" required>

      <button type="submit">Login</button>

      <p>Don't have an account? <a href="signup.php">Sign up</a></p>
    </form>
  </main>

  <!-- Footer Section -->
  <footer class="footer">
    <p>© 2024 AlloyWheels.com All Rights Reserved</p>
  </footer>

</body>
</html>
