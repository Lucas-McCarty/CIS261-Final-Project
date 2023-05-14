<?php include('view/login_header.php'); ?>
<?php include('view/navbar.php'); ?>

<!-- form to create or login a user -->
<main id="login-main">
  <div class="main">  	
    <input type="checkbox" id="chk" aria-hidden="true">

    <!-- create user form -->
    <div class="signup">
      <form action="create_user.php" method="post" enctype="multipart/form-data">
        <label for="chk" aria-hidden="true">Sign up</label>
        <input type="username" name="username" placeholder="User name" required="">
        <input type="email" name="email" placeholder="Email" required="">
        <input type="password" name="password" placeholder="Password" required="">
        <input type="password" name="repeat" placeholder="Repeat Password" required="">
        <button type="submit" name="submit">Sign up</button>
      </form>
    </div>

    <!-- login form -->
    <div class="login">
      <form action="login_user.php" method="post">
        <label for="chk" aria-hidden="true">Login</label>
        <input type="username" name="username" placeholder="User name/Email" required="">
        <input type="password" name="password" placeholder="Password" required="">
        <button type="submit" name="submit">Login</button>
      </form>
    </div>
  </div>
</main>
<footer>
<?php
  // find any errors and display error message
    if(isset($_GET['error'])){
      switch($_GET['error']){
        case 'emptyinput':
          echo "<p>Fill in all fields!</p>";
          break;
        case 'invalidusername':
          echo "<p>Choose a proper username!</p>";
          break;
        case 'invalidemail':
          echo "<p>Choose a proper email!</p>";
          break;
        case 'passwordsdonotmatch':
          echo "<p>Your passwords don't match</p>";
          break;
        case 'usernametaken':
          echo "<p>That username is already taken</p>";
          break;
        case 'incorrectpassword':
          echo "<p>Incorrect password</p>"; 
          break;
        case 'wronglogin':
          echo "<p>Incorrect login information</p>"; 
          break;
        case 'notloggedin':
          echo "<p>You must login to view the portfolio page</p>";
          break;
        default: 
          break;
      }
    }
  ?>
</footer>
