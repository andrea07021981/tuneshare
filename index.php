<?php
    require_once('header.php');
    session_start();
    $user_session = isset($_SESSION['first_name'])

?>
  <body class="text-center">
    <div class="cover-container d-flex w-100 h-100 p-3 mx-auto flex-column">
  <header class="masthead mb-auto">
    <div class="inner">
      <h3 class="masthead-brand">TuneShare</h3>
      <nav class="nav nav-masthead justify-content-center">
        <a class="nav-link" href="index.php">Home</a>
        <a class="nav-link" href="add.php">Share Your Tune</a>
        <a class="nav-link" href="view.php">View Playlists</a>
          <?php
              if ($user_session) {
                  echo "<a class=\"nav-link\" href=\"forget.php\">Forget!</a>";
              }
          ?>
      </nav>
    </div>
  </header>

  <main role="main" class="inner cover">
      <?php
          if ($user_session) {
              echo "<h1 class=\"cover-heading\">Hi ". $_SESSION['first_name'] ."!</h1>";
          } else {
              echo "<h1 class=\"cover-heading\">Join The TuneShare Community.</h1>";
          }
      ?>
    <p class="lead">Need a new WFH playlist? We've got you covered. Join our community and connect with fellow music-lovers. Share your top bops and browse what others are listening too. </p>
    <!-- I had to Google what bop meant. I am very uncool -->
    <p class="lead">
      <a href="add.php" class="btn btn-lg btn-secondary">Share Your Top Tune</a>
      <a href="#" class="btn btn-lg btn-secondary orange">Browse Tunes </a>
    </p>
  </main>
  <footer class="mastfoot mt-auto">
    <div class="inner">
      <p> &copy; Copyright <?php echo date('yy'); ?></p>
    </div>
  </footer>
</div>
</body>
</html>
<!-- Design and layout relies on help from Bootstrap cover example - https://getbootstrap.com/docs/4.5/examples/cover/ -->
