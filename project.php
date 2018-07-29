<?php

require "connect.php";

if ( isset($_GET['project_id']) ) {
    $project = R::load('projects', $_GET['project_id']);
    $img_ids  = R::getAll('SELECT (id) FROM images WHERE projects_id = ?', array($project->id));
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
    <title><?php echo $project->title;?> -- Volonter.ua</title>
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
<?php if(isset($_COOKIE['user'])){?><li class="navbar-item"><a class="nav-link" href="createProject.php">Create project</a></li><?php }?>
<?php if(isset($_COOKIE['user'])){?><li class="navbar-item"><a class="nav-link" href="signOut.php">Sign out</a></li><?php }?>

        </ul>
      </div>
    </nav>
    <div class="container project m-5 p-5 flex-grow">
        <div class="row">
            <div class="col-lg-8">
                <h1><?php echo $project->title;?></h1>
                <h4><?php echo $project->description;?></h4>
                <?php
                    for( $i = 1; $i <= count($img_ids); $i++ ) {
                        ?><img src="<?php echo $project->ownImagesList[$img_ids[$i]['id']]['path'] . $project->ownImagesList[$img_ids[$i]['id']]['name'];?>" alt="" style="width: 300px; height: 200px; border-radius: 25px;" class="m-1">
                    <?php  
                    }
                ?>
                <p><?php echo $project->text;?></p>
            </div>
            <div class="col-lg-4">
                <img src="<?php echo $project->ownImagesList[$img_ids[0]['id']]['path'] . $project->ownImagesList[$img_ids[0]['id']]['name'];?>" alt="" style="width: 300px; height: 200px; border-radius: 25px;">
                <p class="pt-2"><?php echo 'Type: ' . $project->type;?></p>
                <p><?php echo 'Theme: ' . $project->theme;?></p>
                <p><?php echo 'Address: ' . $project->address;?></p>
                <p><?php echo 'Date: ' . $project->date;?></p>
                <p class="text-<?php echo ($project->status == "active") ? 'success' : 'danger';?>"><?php echo 'Status: ' . $project->status;?></p>

                <p>People which need help: <?php echo $project->user->name . ' ' . $project->user->surname;?></p>
                <p>Email: <a href="mailto:<?php echo $project->user->email;?>"><?php echo $project->user->email;?></a></p>
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