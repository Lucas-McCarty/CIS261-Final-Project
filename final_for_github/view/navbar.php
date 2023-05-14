<!-- Navbar with list of links to all pages -->
<nav>
  <ul>
    <li>
      <a href="index.php">Home</a>
    </li>
    <li>
      <a href="portfolio.php">Portfolio</a>
    </li>
    <li>
      <a href="research.php?search_value=SPY" >Research</a>
    </li>
    <!-- Change display depending on if the user is logged in or not -->
     <?php
      if(isset($_SESSION['userid'])){
        echo "<li><a href='logout.php'>Logout</a></li>";
      } else{
        echo "<li><a href='login.php'>Login</a></li>";
      }
     ?>
  </ul>
  <!-- Search bar -->
  <form action="research.php" method="get">
    <input type="text" placeholder="Search" name="search_value">
  </form>
</nav>