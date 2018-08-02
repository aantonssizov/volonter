<?php 

require 'connect.php';

@$get_user_id = (int) $_GET['user_id'];

$user;

if ($get_user_id) {
  $user = R::load('user', $get_user_id);
} else if ( isset($_COOKIE['user']) ) {
  $user = unserialize($_COOKIE['user']);
} else {
  $user = NULL;
}

function isUser($cookie, $user) {
  $cuser = unserialize($cookie);

  if ($cuser->id == $user->id) {
    return true;
  }

  return false;
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
    <?php if ($user) {
      $avt_id        = R::getRow( 'SELECT (id) FROM `avatar` WHERE user_id=:user LIMIT 1', array(':user'=>$user->id) );
      $user_projects = R::findAll('projects', 'user_id = :user', array(':user'=>$user->id));  
    ?>
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
          <p>Count of projects: <?php echo count($user_projects);?></p>
          <h3>Projects: </h3>
          <div class="row">
            <?php              
            foreach ($user_projects as $project) {
              $img_ids = R::getCol( 'SELECT  * FROM images WHERE projects_id=:project', array(":project"=>$project->id) );?>
              <div class="card col-4 p-0 mx-3 my-2">
                <img class="card-image-top" src="<?php echo $project->ownImagesList[$img_ids[0]]['path'] . $project->ownImagesList[$img_ids[0]]['name']?>">
                <div class="card-header"><?php echo $project->title;?></div>
                <div class="card-body">
                  <h4 class="card-title"><?php echo $project->title;?></h4>
                  <p><?php echo $project->description;?></p>
                  <p>Address: <?php echo $project->address;?></p>
                  <p>Date: <?php echo $project->date;?></p>
                  <p>Status: <?php echo $project->status;?></p>
                  <a href="project.php?project_id=<?php echo $project->id;?>" class="card-link">To project</a>
                  <?php if ( isUser($_COOKIE['user'], $user) ) {?>
                  <a href="editeProject.php?project_id=<?php echo $project->id;?>" class="card-link">Edite project</a>
                  <?php }?>
                </div>
              </div>
            <?php }?>
          </div>
        </div>
        <?php if ( isUser($_COOKIE['user'], $user) ) {?>
        <div class="container">
          <div class="row">
            <div class="col">
              <h2>Update user</h2>
              <a href="editeUser.php" role="button" class="btn btn-success btn-block btn-lg">Edite user</a>
            </div>
            <div class="col">
              <h2>Delete user</h2>
              <a href="deleteUser.php" role="button" class="btn btn-danger btn-block btn-lg">Delete user</a>
            </div>
          </div>
        </div>
        <?php }?>
    </div>
    <?php } else {?>
    <div class="container flex-grow">
      <div class="alert alert-warning" role="alert">User unselect please <a href="signIn.php">sign in</a></div>
    </div>
    <?php }?>
    <footer class="footer bg-success p-3">
      <div class="container"><span class="text-light">2017 &copy; Anton Sizov, Vitalina Sizova and Rostislav Sizov.</span></div>
    </footer>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.2/js/bootstrap.min.js" integrity="sha384-o+RDsa0aLu++PJvFqy8fFScvbHFLtbvScb8AjopnFD+iEQ7wo/CG0xlczd+2O/em" crossorigin="anonymous"></script>
  </body>
</html>
