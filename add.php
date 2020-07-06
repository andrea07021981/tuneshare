<?php
    require_once('header.php');
    session_start();
    $user_session = isset($_SESSION['first_name']);
    ?>
<body class="add">
<div class="container inner">
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
    <?php
    //initialize variables
    $id = null; 
    $firstname = null;
    $lastname = null; 
    $location = null; 
    $genre = null; 
    $age = null; 
    $email = null; 
    $favsong = null;
   
    //added profile & linkk 
    $profile = null; 
    $link = null;

    if(!empty($_GET['id']) && (is_numeric($_GET['id']))) {
      //grab the id from url
      $id = filter_input(INPUT_GET, 'id');
      //connect to the database 
      require_once('connect.php'); 
      //set up our query 
      $sql = "SELECT * FROM songs WHERE user_id = :user_id;"; 
      //prepare our statement
      $statement = $db->prepare($sql); 
      //bind 
      $statement->bindParam(':user_id', $id); 
      //execute 
      $statement->execute(); 
      //use fetchAll to store 
      $records = $statement->fetchAll(); 
      //to loop through, use a foreach loop 
      foreach($records as $record) : 
      $firstname = $record['first_name']; 
      $lastname = $record['last_name']; 
      $genre = $record['genre'];
      $age = $record['age'];  
      $location = $record['location']; 
      $email = $record['email']; 
      $favsong = $record['favsong']; 
      $profilepic = $record['profile'];
      $link = $record['link'];
      endforeach; 
      //close the db connection 
      $statement->closeCursor(); 
    }
    ?>
    <main>
    <?php
        if ($user_session) {
            echo "<h1>Share Your Fave Tunes, " . $_SESSION['first_name'] . "</h1>";
        } else {
            echo "<h1>Share Your Fave Tunes</h1>";
        }
    ?>
      <form action="process.php" method="post" enctype="multipart/form-data" class="form">
        <!-- add hidden input with user id if editing -->
        <input type="hidden" name="user_id" value="<?php echo $id;?>">
        <div class="form-group">
          <label for="fname"> Your First Name  </label>
          <input type="text" name="fname" class="form-control" id="fname" value="<?php echo $firstname; ?>">
        </div>
        <div class="form-group">
          <label for="lname"> Your Last Name  </label>
          <input type="text" name="lname" class="form-control" id="lname" value="<?php echo $lastname; ?>">
        </div>
        <div>
          <label for="genre"> Your Favourite Genre  </label>
          <input type="text" name="genre" class="form-control" id="genre" value="<?php echo $genre; ?>">
        </div>
        <div>
          <label for="location"> Your Location </label>
          <input type="text" name="location" class="form-control" id="location" value="<?php echo $location; ?>">
        </div>
        <div class="form-group">
          <label for="location"> Your Age </label>
          <input type="number" name="age" class="form-control" id="age" value="<?php echo $age; ?>">
        </div>
        <div class="form-group">
          <label for="email"> Your Email </label>
          <input type="text" name="email" class="form-control" id="email" value="<?php echo $email; ?>">
        </div>
        <div class="form-group">
          <label for="favsong"> What Are You Listening To On Repeat?  </label>
          <input type="text" name="favsong" class="form-control" id="favsong" value="<?php echo $favsong;?>">
        </div>
        <div class="form-group">
          <label for="link"> Tune Link </label>
          <input type="url" name="link" class="form-control" id="link" value="<?php echo $link;?>">
        </div>
        <div class="form-group">
          <label for="profile"> Profile Pic </label>
          <input type="file" name="photo" id="profilepic" value="<?php echo $profile;?>">
        </div>
        <input type="submit" name="submit" value="Submit" class="btn">
      </form>
    </main>
<?php require_once('footer.php'); ?>