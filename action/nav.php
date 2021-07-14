<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
      <a class="navbar-brand" href="home.php">
        <h1 style="font-size: 30px;font-weight:900; "><strong>i'm </strong><u>Tailor</u></h1>
      </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <!-- <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="#">Home</a>
          </li> -->
          <li class="nav-item">
          <a  class="nav-link <?=(basename($_SERVER['PHP_SELF'])=='Customers.php'?'active':'')?>" href="./Customers.php">Customer</a>
          </li>
          <?php
          if (isset($_SESSION['USER'])) { if($_SESSION['USER']['Type']=="admin")
            {
           ?>
            <!-- <li class="nav-item">
          <a  class="nav-link <?=(basename($_SERVER['PHP_SELF'])=='CustomerManagement.php'?'active':'')?>" href="./CustomerManagement.php">Customer Management</a>
          </li> -->
          <li class="nav-item">
          <a  class="nav-link <?=(basename($_SERVER['PHP_SELF'])=='User.php'?'active':'')?>" href="./User.php">User</a>
          </li>
          <!-- <li class="nav-item">
          <a  class="nav-link <?=(basename($_SERVER['PHP_SELF'])=='UserManagement.php'?'active':'')?>" href="./UserManagement.php">User Management</a>
          </li> -->
         
          <?php } } ?>
          <!-- <li class="nav-item">
            <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Disabled</a>
          </li> -->
        </ul>
        <?php
        if (isset($_SESSION['USER'])) {
        ?>
          <ul class="navbar-nav mb-2 mb-lg-0">
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                <?php echo $_SESSION['USER']['Full_Name']; ?>
              </a>
              <ul class="dropdown-menu dropdown-menu-lg-end" aria-labelledby="navbarDropdown">
              <?php
         if($_SESSION['USER']['Type']=="admin")
            {
           ?>
            <li class="nav-item">
          <a  class="nav-link text-dark <?=(basename($_SERVER['PHP_SELF'])=='CustomerManagement.php'?'active':'')?>" href="./CustomerManagement.php">Customer Management</a>
          </li>
          <!-- <li class="nav-item">
          <a  class="nav-link <?=(basename($_SERVER['PHP_SELF'])=='User.php'?'active':'')?>" href="./User.php">User</a>
          </li> -->
          <li class="nav-item">
          <a  class="nav-link  text-dark <?=(basename($_SERVER['PHP_SELF'])=='UserManagement.php'?'active':'')?>" href="./UserManagement.php">User Management</a>
          </li>
         
          <?php  } ?>
                <li>
                  <hr class="dropdown-divider">
                </li>
                <li><a class="dropdown-item" href="Logout.php">Log out</a></li>
              </ul>
            </li>
          </ul>

        <?php
        } else {
        ?>
          <button class="btn btn-success" type="submit"> Log Out</button>
        <?php
        }
        ?>
      </div>
    </div>
  </nav>