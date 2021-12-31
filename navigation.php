<?php
  session_start();
  $userId = $_SESSION['userId'];
  $username = $_SESSION['username'];
  $isAdmin = $_SESSION['isAdmin'];

  $front = '<nav class="navbar navbar-dark navbar-expand-md navigation-clean-search">
  <div class="container"><a class="navbar-brand" href="./index.php">Liquor</a><button class="navbar-toggler" data-toggle="collapse" data-target="#navcol-1"><span class="sr-only">Toggle navigation</span><span class="navbar-toggler-icon"></span></button>
      <div class="collapse navbar-collapse"id="navcol-1">
          <ul class="nav navbar-nav">
              <li class="nav-item dropdown">
                  <a class="dropdown-toggle nav-link dropdown-toggle" data-toggle="dropdown" aria-expanded="false" href="#">Base</a>
                  <ul class="dropdown-menu" role="menu">
                      <a class="dropdown-item" role="presentation" href="index.php?tag=Vodka">Vodka</a>
                      <a class="dropdown-item" role="presentation" href="index.php?tag=Rum">Rum</a>
                      <a class="dropdown-item" role="presentation" href="index.php?tag=Gin">Gin</a>
                      <a class="dropdown-item" role="presentation" href="index.php?tag=Whisk(e)y">Whisk(e)y</a>
                      <a class="dropdown-item" role="presentation" href="index.php?tag=Tequila">Tequila</a>
                      <a class="dropdown-item" role="presentation" href="index.php?tag=Brandy">Brandy</a>
                  </ul>
              </li>

              <li class="nav-item dropdown">
                <a class="dropdown-toggle nav-link dropdown-toggle" data-toggle="dropdown" aria-expanded="false" href="#">Type</a>
                <ul class="dropdown-menu" role="menu">
                    <li><a class="dropdown-item" role="presentation" href="index.php?tag=Cocktail">Cocktail</a></li>
                    <li><a class="dropdown-item" role="presentation" href="index.php?tag=Highball">Highball</a></li>
                    <li><a class="dropdown-item" role="presentation" href="index.php?tag=Sour">Sour</a></li>
                    <li><a class="dropdown-item" role="presentation" href="index.php?tag=Collins">Collins</a></li>
                    <li><a class="dropdown-item" role="presentation" href="index.php?tag=Buck">Buck</a></li>
                    <li><a class="dropdown-item" role="presentation" href="index.php?tag=Dessert">Dessert</a></li>
                    <li><a class="dropdown-item" role="presentation" href="index.php?tag=Tiki-s">Tiki&rsquo;s</a></li>
                    <li><a class="dropdown-item" role="presentation" href="index.php?tag=Duo">Duo</a></li>
                    <li><a class="dropdown-item" role="presentation" href="index.php?tag=Trio">Trio</a></li>
                    <li><a class="dropdown-item" role="presentation" href="index.php?tag=Fancy">Fancy</a></li>
                    <li><a class="dropdown-item" role="presentation" href="index.php?tag=Frozen">Frozen</a></li>
                    <li><a class="dropdown-item" role="presentation" href="index.php?tag=Sling">Sling</a></li>
                    <li><a class="dropdown-item" role="presentation" href="index.php?tag=Frappe">Frappe</a></li>
                    <li><a class="dropdown-item" role="presentation" href="index.php?tag=Punch">Punch</a></li>
                    <li><a class="dropdown-item" role="presentation" href="index.php?tag=Fizz">Fizz</a></li>
                </ul>
              </li>

              <li class="nav-item dropdown">
                <a class="dropdown-toggle nav-link dropdown-toggle" data-toggle="dropdown" aria-expanded="false" href="#">Cup type</a>
                <ul class="dropdown-menu" role="menu">
                  <li><a class="dropdown-item" role="presentation" href="index.php?tag=Mojito Glass">Mojito Glass</a></li>
                  <li><a class="dropdown-item" role="presentation" href="index.php?tag=Cocktail Glass">Cocktail Glass</a></li>
                  <li><a class="dropdown-item" role="presentation" href="index.php?tag=Collins Glass">Collins Glass</a></li>
                  <li><a class="dropdown-item" role="presentation" href="index.php?tag=Highball Glass">Highball Glass</a></li>
                  <li><a class="dropdown-item" role="presentation" href="index.php?tag=Old Fashioned">Old Fashioned Glass</a></li>
                  <li><a class="dropdown-item" role="presentation" href="index.php?tag=Hurricane Glass">Hurricane Glass</a></li>
                  <li><a class="dropdown-item" role="presentation" href="index.php?tag=Champagne Glass">Champagne Glass</a></li>
                  <li><a class="dropdown-item" role="presentation" href="index.php?tag=Margarita Glass">Margarita Glass</a></li>
                  <li><a class="dropdown-item" role="presentation" href="index.php?tag=Champagne Glass">Champagne Glass</a></li>
                  <li><a class="dropdown-item" role="presentation" href="index.php?tag=Brandy Glass">Brandy Glass</a></li>
                </ul>
              </li>

              <li class="nav-item dropdown">
                <a class="dropdown-toggle nav-link dropdown-toggle" data-toggle="dropdown" aria-expanded="false" href="#">Tuning</a>
                <ul class="dropdown-menu" role="menu">
                  <li><a class="dropdown-item" role="presentation" href="index.php?tag=Build">Build</a></li>
                  <li><a class="dropdown-item" role="presentation" href="index.php?tag=Stir">Stir</a></li>
                  <li><a class="dropdown-item" role="presentation" href="index.php?tag=Shake">Shake</a></li>
                  <li><a class="dropdown-item" role="presentation" href="index.php?tag=Blend">Blend</a></li>
                  <li><a class="dropdown-item" role="presentation" href="index.php?tag=Roll">Roll</a></li>
                </ul>
              </li>

              <li class="nav-item dropdown">
                <a class="dropdown-toggle nav-link dropdown-toggle" data-toggle="dropdown" aria-expanded="false" href="#">Drinking method</a>
                <ul class="dropdown-menu" role="menu">
                  <li><a class="dropdown-item" role="presentation" href="index.php?tag=Straight">Straight</a></li>
                  <li><a class="dropdown-item" role="presentation" href="index.php?tag=LongDrink">LongDrink</a></li>
                  <li><a class="dropdown-item" role="presentation" href="index.php?tag=On the Rock">On the Rock</a></li>
                  <li><a class="dropdown-item" role="presentation" href="index.php?tag=Frozen">Frozen</a></li>
                </ul>
              </li>
          </ul>';

    $middle = "";
    if($userId && $username){ // already logged in
      if($isAdmin){ // is administrator
        $middle = '<form class="form-inline mr-auto" target="_self">
        <div class="form-group"><label for="search-field"><i class="fa fa-search"></i></label><input class="form-control search-field" type="search" name="search" id="search-field"></div>
    </form><span class="navbar-text"><a href="./resetPassword.php" class="login">Reset Password</a></span><a class="btn btn-light action-button" role="button" href="./logout.php">Logout</a>';
      }
      else{ // is not administrator
          $middle = '<form class="form-inline mr-auto" target="_self">
          <div class="form-group"><label for="search-field"><i class="fa fa-search"></i></label><input class="form-control search-field" type="search" name="search" id="search-field"></div>
      </form><span class="navbar-text"><a href="./recipe_liquor.php" class="login">New Recipe</a></span><span class="navbar-text"><a href="./resetPassword.php" class="login">Reset Password</a></span><a class="btn btn-light action-button" role="button" href="./logout.php">Logout</a>';
      }
  } // not logged in
  else{
      $middle = '<form class="form-inline mr-auto" target="_self">
      <div class="form-group"><label for="search-field"><i class="fa fa-search"></i></label><input class="form-control search-field" type="search" name="search" id="search-field"></div>
  </form><span class="navbar-text"><a href="./login.php" class="login">Log In</a></span><a class="btn btn-light action-button" role="button" href="./register.php">Sign Up</a>';
  }

  $tail = "</div></div></nav>";
  echo $front . $middle . $tail;
?>

            