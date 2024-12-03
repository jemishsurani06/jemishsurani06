<?php include('db_conn.php'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Home - Alloy Wheel Products</title>
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
      <a href="login.php">LOGIN/SIGNUP</a>
      <a href="checkout.php">CHECKOUT</a>
    </nav>
  </header>

  <section class="hero">
  <div class="hero-text">
    <h2>Find Your Perfect Alloy Wheels</h2>
    <p>Browse the best collection of alloy wheels, tailored to fit your car’s needs.</p>
    <a href="products.php" class="cta-button">Browse Products</a>
  </div>
</section>




    <section class="featured">
      <h2>Featured Products</h2>
      <div class="featured-products">
        <?php
        // Query for fetching featured products (e.g., top-selling products or products from a specific category)
        $featuredQuery = "SELECT * FROM alloy_wheels LIMIT 4"; // Modify query as needed
        $featuredResult = mysqli_query($dbc, $featuredQuery);

        if ($featuredResult && mysqli_num_rows($featuredResult) > 0) {
          while ($row = mysqli_fetch_assoc($featuredResult)) {
            $name = $row['name'];
            $prize = $row['prize'];
            echo "
            <div class='product'>
              <img src='images/{$name}.jpg' alt='{$name}' title='{$name}'>
              <p><strong>{$name}</strong></p>
              <p class='price'>\${$prize}</p>
              <a href='product_detail.php?product_id={$row['id']}'>View Details</a>
            </div>
            ";
          }
        } else {
          echo "<p>No featured products available.</p>";
        }
        ?>
      </div>
    </section>

    <section class="about">
      <h2>About Us</h2>
      <p>We are a trusted supplier of high-quality alloy wheels. Our products come in various designs and sizes to fit your car perfectly.</p>
      <a href="about.php" class="cta-button">Learn More About Us</a>
    </section>
  </main>

  <!-- Footer Section -->
  <footer class="footer">
    <p>© 2024 AlloyWheels.com All Rights Reserved</p>
    <nav>
      <a href="privacy.php">Privacy Policy</a>
      <a href="terms.php">Terms & Conditions</a>
    </nav>
  </footer>

</body>
</html>
