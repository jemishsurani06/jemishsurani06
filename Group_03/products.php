<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Alloy Wheel Products</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <?php include('db_conn.php'); ?>
  
  <!-- Header Section -->
  <header class="header">
    <div class="logo">
      <img src="images/logo.jpg" alt="Alloy Wheel Logo">
      <h1>Alloy Wheel</h1>
    </div>
    <nav>
    <nav>
      <a href="HOME.php">HOME</a>
      <!-- <a href="login.php">LOGIN/SIGNUP</a> -->
      <a href="checkout.php">CHECKOUT</a>
    </nav>
 
    </nav>
  </header>

  <!-- Search Bar with Filter Options -->
  <div class="search-bar">
    <h1>Find Your Perfect Wheels</h1>
    <form id="filterForm" method="GET">
      <div class="filter-options">
        <select name="make" title="Select Make" onchange="document.getElementById('filterForm').submit();">
          <option value="">Make</option>
          <?php
          $makeQuery = "SELECT DISTINCT make FROM alloy_wheels";
          $makeResult = mysqli_query($dbc, $makeQuery);
          if ($makeResult) {
            while ($row = mysqli_fetch_assoc($makeResult)) {
              $selected = ($_GET['make'] ?? '') == $row['make'] ? 'selected' : '';
              echo "<option value='{$row['make']}' {$selected}>{$row['make']}</option>";
            }
          } else {
            echo "<option value=''>Error Loading Data</option>";
          }
          ?>
        </select>

        <select name="model" title="Select Model" onchange="document.getElementById('filterForm').submit();">
          <option value="">Model</option>
          <?php
          $modelQuery = "SELECT DISTINCT model FROM alloy_wheels";
          $modelResult = mysqli_query($dbc, $modelQuery);
          if ($modelResult) {
            while ($row = mysqli_fetch_assoc($modelResult)) {
              $selected = ($_GET['model'] ?? '') == $row['model'] ? 'selected' : '';
              echo "<option value='{$row['model']}' {$selected}>{$row['model']}</option>";
            }
          } else {
            echo "<option value=''>Error Loading Data</option>";
          }
          ?>
        </select>

        <select name="generation" title="Select Generation" onchange="document.getElementById('filterForm').submit();">
          <option value="">Generation</option>
          <?php
          $generationQuery = "SELECT DISTINCT generation FROM alloy_wheels";
          $generationResult = mysqli_query($dbc, $generationQuery);
          if ($generationResult) {
            while ($row = mysqli_fetch_assoc($generationResult)) {
              $selected = ($_GET['generation'] ?? '') == $row['generation'] ? 'selected' : '';
              echo "<option value='{$row['generation']}' {$selected}>{$row['generation']}</option>";
            }
          } else {
            echo "<option value=''>Error Loading Data</option>";
          }
          ?>
        </select>

        <!-- Reset Filters Button -->
        <button type="button" onclick="window.location.href='products.php';">Reset Filters</button>
      </div>
    </form>
  </div>

  <!-- Display Products -->
  <main class="products">
    <?php
    // Build query conditions
    $conditions = [];
    if (!empty($_GET['make'])) {
      $make = mysqli_real_escape_string($dbc, $_GET['make']);
      $conditions[] = "make = '$make'";
    }
    if (!empty($_GET['model'])) {
      $model = mysqli_real_escape_string($dbc, $_GET['model']);
      $conditions[] = "model = '$model'";
    }
    if (!empty($_GET['generation'])) {
      $generation = mysqli_real_escape_string($dbc, $_GET['generation']);
      $conditions[] = "generation = '$generation'";
    }

    // Main query to fetch products
    $query = "SELECT * FROM alloy_wheels";
    if (count($conditions) > 0) {
      $query .= " WHERE " . implode(" AND ", $conditions);
    }

    $result = mysqli_query($dbc, $query);

    // Display products if found
    if ($result && mysqli_num_rows($result) > 0) {
      while ($row = mysqli_fetch_assoc($result)) {
        $name = $row['name'];
        $prize = $row['prize'];

        echo "
          <div class='product'>
            <img src='images/{$name}.jpg' alt='{$name}' title='{$name}'>
            <p><strong>{$name}</strong></p>
            <div class='product-footer'>
              <button type='button'>BUY</button>
              <p class='price'>\${$prize}</p>
            </div>
          </div>
        ";
      }
    } else {
      echo "<p>No products found. Please adjust your filters.</p>";
    }
    ?>
  </main>

  <!-- Footer Section -->
  <footer class="footer">
    <p>© 2024 AlloyWheels.com All Rights Reserved</p>
  </footer>

</body>
</html>
