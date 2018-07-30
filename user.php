<?php 

require 'connect.php';

$user = isset($_GET['user_id']) ? 
  ( R::load('user', $_GET['user_id']) ) : 
  ( isset($_COOKIE['user']) ) ? 
    unserialize($_COOKIE['user']) :
    null;

if ( !$user ) {
  header('Location: index.php');
}

$avt_id = R::getRow( 'SELECT (id) FROM `avatar` WHERE user_id=:user LIMIT 1', array(':user'=>$user->id) )
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
  <body class="d-flex flex-column"> 
    <nav class="navbar navbar-expand-lg navbar-dark bg-success navbar-sticky"><a class="navbar-brand" href="#">Volonter</a>
      <button class="navbar-toggler" type="button" data-toggler="collapse" data-target="#navbarNav"><span class="navbar-toggler-icon"></span></button>
      <div class="navbar-collapse collapse" id="navbarNav">
        <ul class="navbar-nav">
          <li class="navbar-item"><a class="nav-link" href="index.php">Home</a></li>
          <li class="navbar-item"><a class="nav-link active" href="projects.php">Projects</a></li>
          <?php if ( !isset($_COOKIE['user']) ) {?><li class="navbar-item"><a class="nav-link" href="signUp.php">Sign up</a></li><?php }?>
          <?php if ( !isset($_COOKIE['user']) ) {?><li class="navbar-item"><a class="nav-link" href="signIn.php">Sign in</a></li><?php }?>
          <?php if( isset($_COOKIE['user']) ){?><li class="navbar-item"><a class="nav-link" href="createProject.php">Create project</a></li><?php }?>
          <?php if( isset($_COOKIE['user']) ){?><li class="navbar-item"><a class="nav-link" href="signOut.php">Sign out</a></li><?php }?>
        </ul>
      </div>
    </nav>

    <div class="user flex-grow m-5">
        <div class="container">
            <div class="row">
                <div class="col">
                    <h2><?php echo $user->name . ' ' . $user->surname;?></h2>
                    <p>Email: <a href="mailto:<?php echo $user->email;?>"><?php echo $user->email;?></a></p>
                </div>
                <div class="col">
                    <img src="<?php echo $user->ownAvatarList[$avt_id['id']]->path . $user->ownAvatarList[$avt_id['id']]->name;?>" alt="" style="width: 300px;heigth: 400px;">
                </div>
            </div>
            <div class="row">
              <?php
              $user_projects = R::findAll('projects', 'user_id = :user', array(':user'=>$user->id));  
                
              foreach ($user_projects as $project) {
                $img_ids = R::getCol( 'SELECT  * FROM images WHERE projects_id=:project', array(":project"=>$project->id) );?>
                <div class="card col-4 p-0 mx-3 my-2">
                  <img class="card-image-top" src="<?php echo $project->ownImagesList[$img_ids[0]]['path'] . $project->ownImagesList[$img_ids[0]]['name']?>">
                </div>
              <?php }?>
            </div>
        </div>
    </div>

    <footer class="footer bg-success p-3">
      <div class="container"><span class="text-light">2017 &copy; Anton Sizov, Vitalina Sizova and Rostislav Sizov.</span></div>
    </footer>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.2/js/bootstrap.min.js" integrity="sha384-o+RDsa0aLu++PJvFqy8fFScvbHFLtbvScb8AjopnFD+iEQ7wo/CG0xlczd+2O/em" crossorigin="anonymous"></script>
  </body>
</html>
