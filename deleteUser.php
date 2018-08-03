<?php 

require "connect.php";

$user = isset($_COOKIE['user']) ? unserialize($_COOKIE['user']) : null;

if (!$user) {
    header("Location: index.php");
}

if ( isset($_POST['ok']) ) {
    $ok = $_POST['ok'];

    switch ($ok) {
        case 'yes': 
            R::trash($user);
            header("Location: index.php");
            break;
        case 'no':
            header("Location: signOut.php");
            break;
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
    <title><?php echo ($user) ? $user->name : 'Please Sign Up'?> -- Volonter.ua</title>
  </head>
  <body class="d-flex flex-column justify-content-between"> 
    <nav class="navbar navbar-expand-lg navbar-dark bg-success navbar-sticky"><a class="navbar-brand" href="#">Volonter</a>
      <button class="navbar-toggler" type="button" data-toggler="collapse" data-target="#navbarNav"><span class="navbar-toggler-icon"></span></button>
      <div class="navbar-collapse collapse" id="navbarNav">
        <ul class="navbar-nav">
          <li class="navbar-item"><a class="nav-link" href="index.php">Home</a></li>
          <li class="navbar-item"><a class="nav-link active" href="projects.php">Projects</a></li>
          <?php if ( !isset($_COOKIE['user']) ) {?><li class="navbar-item"><a class="nav-link" href="signUp.php">Sign up</a></li><?php }?>
          <?php if ( !isset($_COOKIE['user']) ) {?><li class="navbar-item"><a class="nav-link" href="signIn.php">Sign in</a></li><?php }?>
          <?php if( isset($_COOKIE['user']) ){?><li class="navbar-item"><a class="nav-link" href="createProject.php">Create project</a></li><?php }?>
          <?php if(isset($_COOKIE['user'])){?><li class="navbar-item"><a class="nav-link" href="user.php">User</a></li><?php }?>
          <?php if( isset($_COOKIE['user']) ){?><li class="navbar-item"><a class="nav-link" href="signOut.php">Sign out</a></li><?php }?>
        </ul>
      </div>
    </nav>

    <div class="container">
        <form method="POST">
            <div class="form-group">
                <h3 class="text-danger">Are you sure you want to delete your account?</h3>
                <div class="row">
                    <div class="col">
                        <button type="submit" name="ok" value="yes" class="btn btn-danger">Yes</button>
                    </div>
                    <div class="col">
                        <button type="submit" name="ok" value="no" class="btn btn-success">No</button>
                    </div>
                </div>
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