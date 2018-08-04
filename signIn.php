<?php
require "connect.php";

$errors = array();

if( isset($_POST['email']) && isset($_POST['password']) )
{
  echo "";
  $user = R::findOne('user', 'email = ?', array($_POST['email']));
  if( $user ) {
    if ( password_verify($_POST['password'], $user->password) ) {
      setcookie('user', serialize(R::load('user', $user->id)), time()+3600, '/');
      header("Location: index.php");
    } else {
      $errors[] = "Wrong password";
    }
  } else {
    $errors[] = "Email don't uses";
  }
}

?>
<!DOCTYPE html>
<html> 
  <head> 
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.2/css/bootstrap.min.css" integrity="sha384-Smlep5jCw/wG7hdkwQ/Z5nLIefveQRIY9nfy6xoR1uRYBtpZgI6339F5dgvm/e9B" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/css/main.css">
    <title>Sign in -- Volonter.ua</title>
  </head>
  <body class="d-flex flex-column justify-content-between">
    <nav class="navbar navbar-expand-lg navbar-dark bg-success navbar-sticky"><a class="navbar-brand" href="#">Volonter</a>
      <button class="navbar-toggler" type="button" data-toggler="collapse" data-target="#navbarNav"><span class="navbar-toggler-icon"></span></button>
      <div class="navbar-collapse collapse" id="navbarNav">
        <ul class="navbar-nav">
          <li class="navbar-item"><a class="nav-link" href="index.php">Home</a></li>
          <li class="navbar-item"><a class="nav-link" href="projects.php">Projects</a></li>
          <?php if ( !isset($_COOKIE['user']) ) {?><li class="navbar-item"><a class="nav-link" href="signUp.php">Sign up</a></li><?php }?>
          <?php if ( !isset($_COOKIE['user']) ) {?><li class="navbar-item"><a class="nav-link active" href="signIn.php">Sign in</a></li><?php }?>
          <?php if(isset($_COOKIE['user'])){?><li class="navbar-item"><a class="nav-link" href="createProject.php">Create project</a></li><?php }?>
          <?php if(isset($_COOKIE['user'])){?><li class="navbar-item"><a class="nav-link" href="user.php">User</a></li><?php }?>
          <?php if(isset($_COOKIE['user'])){?><li class="navbar-item"><a class="nav-link" href="signOut.php">Sign out</a></li><?php }?>
        </ul>
      </div>
    </nav>
    <div class="container w-25 my-5">
      <form method="POST">
        <div class="form-group">
          <h2>Sign in for start </h2>
          <?php if(isset($_COOKIE['user'])) { ?> <div class="alert alert-success" role="alert">You're signed</div><?php }?>
          <?php if(!empty($errors)) { ?> <div class="alert alert-danger" role="alert"> <?php echo array_shift($errors);?></div><?php }?>
          <input class="form-control my-1" type="email" placeholder="Email" name="email" value="<?php if ( !empty($errors) ) { echo $_POST['email']; }?>" required>
          <input class="form-control my-1" type="password" placeholder="Password" name="password" required>
          <button class="btn btn-success btn-lg btn-block" type="submit" name="submit">Sign in  </button>
          <p class="text-info my-1">If you don't have account: </p><a class="btn btn-success btn-lg btn-block" role="button" href="signUp.php">Sign up</a>
        </div>
      </form>
    </div>
    <footer class="footer bg-success p-3">
      <div class="container"><span class="text-light">2017 &copy; Anton Sizov, Vitalina Sizova and Rostislav Sizov.</span></div>
    </footer>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.2/js/bootstrap.min.js" integrity="sha384-o+RDsa0aLu++PJvFqy8fFScvbHFLtbvScb8AjopnFD+iEQ7wo/CG0xlczd+2O/em" crossorigin="anonymous"></script>
  </body>
</html>