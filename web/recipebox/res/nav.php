<nav class="navbar navbar-default navbar-fixed-top">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span> 
      </button>
      <a class="navbar-brand" href="home.php">Recipe Box</a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav navbar-right">
        <li><a href="home.php">BROWSE</a></li>
        <li><a href="submitrecipe.php">SUBMIT RECIPE</a></li>
<!--        <li><a href="about.php">ABOUT</a></li>
        <li><a href="contact.php">CONTACT</a></li>-->
        
        <li class="dropdown">
          <a class="dropdown-toggle" data-toggle="dropdown" href="#">ACCOUNT
            <span class="caret"></span>
          </a>
          <ul class="dropdown-menu">
        <?php 
            if (isset($_SESSION['username']))
            {
                $username = $_SESSION['username'];
                echo '<li class="user-welcome">Hello, ' . $username . '</li>';          
                echo '<li><a href="myrecipes.php">MY RECIPES</a></li>';
                echo '<li><a href="signout.php">SIGN OUT</a></li>';
            }
            else
            {
                echo '<li><a href="signin.php">SIGN IN</a></li>';
            }
        ?>
            
          </ul>
        </li>
        
      </ul>
    </div>
  </div>
</nav>