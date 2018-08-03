<?php 
require 'connect.php';

$user  = ( isset($_COOKIE['user']) ) ? unserialize($_COOKIE['user']) : null;
$alert = '';

if ( isset($_POST['submit']) ) {
  if ( isset($_POST['name']) ) {
    update($user, 'name', $_POST['name']);
  }

  if ( isset($_POST['surname']) ) {
    update($user, 'surname', $_POST['surname']);
  }

  if ( isset($_FILES['avatar']) ) {
    $ext = array(
      '.jpg',
      '.jpeg',
      '.png',
      '.gif'
    );

    $folder = '../volonter_images/avatar/';
    $avatar = $_FILES['avatar']['name'];

    move_uploaded_file($_FILES['avatar']['tmp_name'], $folder.$avatar);

    $upload_ext = '';

    foreach ($ext as $i) {
      if ( strpos($avatar, $i) != false ) {
        $upload_ext = $i;
        $alert      = 'success';
        break;
      }
    }

    if ($alert == '') {
      $alert = 'Extension of image doesn\'t supported, only supored: ' . $ext;
    }

    $new_name = "img_avatar_".$user->name.$user->surname.date("YmdHis").$upload_ext;
    //Переименуем файл на всякий случай что бы не было совпадений                                                  
    rename($folder.$avatar, $folder.$new_name);
    $avatar = $new_name;

    sleep(1);

    if ($alert == 'success') {
      $avt = R::dispense('avatar');
      $avt->path = $folder;
      $avt->name = $avatar;

      $user->ownAvatarList = array();
      $user->ownAvatarList[0] = $avt;

      $id = R::store( $user );

      setcookie('user', serialize(R::load('user', $id)), time()+3600, '/');

      $user = ( isset($_COOKIE['user']) ) ? unserialize($_COOKIE['user']) : null;
    }
  }
}

function update($user, $attribute, $value) {
  switch ($attribute) {
    case 'name': $user->name = $value;break;
    case 'surname': $user->surname = $value;break;
  }

  $id = R::store($user);

  setcookie('user', serialize(R::load('user', $id)), time()+3600, '/');

  global $user;

  $user = ( isset($_COOKIE['user']) ) ? unserialize($_COOKIE['user']) : null;
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
          <?php if(isset($_COOKIE['user'])){?><li class="navbar-item"><a class="nav-link" href="createProject.php">Create project</a></li><?php }?>
          <?php if(isset($_COOKIE['user'])){?><li class="navbar-item"><a class="nav-link activve" href="user.php">User</a></li><?php }?>
          <?php if(isset($_COOKIE['user'])){?><li class="navbar-item"><a class="nav-link" href="signOut.php">Sign out</a></li><?php }?>
        </ul>
      </div>
    </nav>

    <?php if ( isset($user) ) {?>

    <div class="editeProject flex-grow m-5">
      <div class="container">
        <h2>Edite user:</h2>
        <form method="POST" enctype="multipart/form-data">
          <div class="form-group">
            <input type="text" class="form-control my-2" name="name" placeholder="Name" value="<?php echo $user->name;?>">
            <input type="text" class="form-control my-2" name="surname" placeholder="Surname" value="<?php echo $user->surname;?>">
            <label class="btn btn-outline-secondary btn-block my-2 avatar-img">
              Your avatar
              <input type="file" style="display: none;" name="avatar">
              <span class="image_path"></span>
            </label>
            <button type="submit" class="btn btn-success btn-block" name="submit">Update</button>
          </div>
        </form>
      </div>
    </div>

    <?php } else {?>
      <div class="alert alert-danger" role="alert">You should be <a href="signIn.php">sign in</a></div>
    <?php }?>
    
    <footer class="footer bg-success p-3">
      <div class="container"><span class="text-light">2017 &copy; Anton Sizov, Vitalina Sizova and Rostislav Sizov.</span></div>
    </footer>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.2/js/bootstrap.min.js" integrity="sha384-o+RDsa0aLu++PJvFqy8fFScvbHFLtbvScb8AjopnFD+iEQ7wo/CG0xlczd+2O/em" crossorigin="anonymous"></script>
    <script>
      'use strict';
      let avatar     = document.querySelector('.avatar-img');
      let put        = document.querySelectorAll('.image_path');
      
      avatar.addEventListener('change', () => {
        if (document.querySelector('.avatar-img input').value) {
          put[0].innerHTML = document.querySelector('.avatar-img input').value; 
        } else {
          put[0].innerHTML = ''; 
        }
      });
    </script>
  </body>
</html>