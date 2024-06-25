<?php
// Initialize the session
session_start();

// Check if the user is logged in, if not then redirect him to login page
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
  header("location: login.php");
  exit;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>Dashboard</title>
  <!--Legacy Scripts-->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>

  <link rel="stylesheet" href="">


  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/2.0.8/css/dataTables.bootstrap5.css">

  <style>
    .wrapper{
      width: 50rem;
      margin: 0 auto;
    }
    table tr td:last-child {
      width: 120px;
    }
  </style>
  <script>
    $(document).ready(function() {
      $('[data-toggle="tooltip"]').tooltip();
    });
  </script>
</head>

<!-- Navigation Bar -->
<nav class="navbar bg-body-tertiary fixed-top">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">Employee Dashboard</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
      <div class="offcanvas-header">
        <h5 class="offcanvas-title" id="offcanvasNavbarLabel">User Panel</h5>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
      </div>
      <div class="offcanvas-body">
        <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="#">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="employee-manager.php">Employee Manager</a>
          </li>
          <!-- User Actions -->
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              User Actions
            </a>
            <ul class="dropdown-menu">
              <!-- Reset Password -->
              <li><a class="dropdown-item" href="reset-password.php">Password Reset</a></li>

              <li>
                <hr class="dropdown-divider">
              </li>
              <li><a class="dropdown-item" href="logout.php">Sign Out</a></li>
            </ul>
          </li>
          <p>


          </p>
        </ul>
        <form class="d-flex mt-3" role="search">
          <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
          <button class="btn btn-outline-success" type="submit">Search</button>
        </form>
      </div>
    </div>
  </div>
</nav>

<body>
  <div class="wrapper">
    <div class="container-fluid">
      <br>
      <h1 class="my-5">Hi, <b><?php echo htmlspecialchars($_SESSION["username"]); ?></b>. Welcome to our site.</h1>
      
      <!-- Employee Manager-->
      <a href="employee-manager.php" style="text-decoration: none;">
        <div class="card text-white bg-success mb-3" style="max-width: 18rem; margin-top:5rem;margin-left:2rem;">
          <div class="card-header">Total Employees</div>
          <div class="card-body">
              <h5 class="card-title"></h5>
              
              <?php
              // Include config file
              require_once "./db/config.php";
              
              // Attempt select query execution
              $sql = "SELECT COUNT(*) AS total_employees FROM employees";
              if($stmt = $pdo->prepare($sql)){
                  // Attempt to execute the prepared statement
                  if($stmt->execute()){
                      // Bind result variables
                      $stmt->bindColumn('total_employees', $total_employees);
                      
                      // Fetch result
                      if($stmt->fetch()){
                          echo '<h1 class="text-center">' . $total_employees . '</h1><br>';
                      } else{
                          echo '<p>No records found.</p>';
                      }
                  } else{
                      echo "Oops! Something went wrong. Please try again later.";
                  }
              }
              // Close statement
              unset($stmt);
              ?>
              
              <p class="card-text">Date and Time: <?php echo date("Y-m-d H:i:s"); ?></p>
          </div>
        </div>
      </a>

    </div>
  </div>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
  <script src="https://cdn.datatables.net/2.0.8/js/dataTables.js"></script>
  <script src="https://cdn.datatables.net/2.0.8/js/dataTables.bootstrap5.js"></script>
  <script>
    new DataTable('#example');
  </script>
</body>

</html>