<!doctype html>
<html>

<head>
  <title>Webtech | Register</title>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Zen+Kaku+Gothic+Antique:wght@300;400;500;700&display=swap" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

</head>



<body class="container mt-5 pt-5">
  <?php
  include('components/header.php');
  ?>
  <main>
    <div class="container text-center">
      <img class='header-img rounded-circle' src="./images/user.png" alt="Chat Icon" width="150" height="150">
    </div>
    <div class="container-sm bg-white border p-2 m-2">
      <form method="post">
        <div class="mb-3 text-center">
          <label for="SignIn" class="form-label">Please Sign Up</label>
          <input type="text" name="username" id="username" class="form-control" placeholder="Username">
        </div>
        <div class="mb-3">
          <input type="password" name="password" class="form-control" id="passwordInput" placeholder="Password">
        </div>
        <div class="mb-3">
          <input type="password" name="password-confirm" class="form-control" id="passwordControlInput" placeholder="Repeat Password">
        </div>
        <div class="btn-group mb-3" role="group" aria-label="Basic example">
          <a href="./login.php" type="button" class="btn btn-secondary">Login</a>
          <input type="submit" class="btn btn-primary" value="Register">
        </div>
      </form>
    </div>
  </main>


  <?php

  // get form data and send to register backend service
  if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $password_conf = $_POST['password-confirm'];

    // check if passwords match
    if ($password != $password_conf) {
      echo "<p>Passwords do not match</p>";
    } // check if username is not empty and at least length 3
    else if (empty($username) || strlen($username) < 3) {
      echo "<p>Username is too short</p>";
    } // check if password is not empty and at least length 8
    else if (empty($password) || strlen($password) < 3) {
      echo "<p>Password is too short</p>";
    } // check if username is already taken
    else if ($service->exists($username)) {
      echo "<p>Username is already taken</p>";
    } // if all checks pass, send to backend
    else {
      // call register function from backendService
      $user_token = $service->register($username, $password);
      if ($user_token !== false) {
        echo "<p>Token: $user_token <br> User $username registered successfully</p>";
        // set user token as Session variable
        $_SESSION['user_token'] = $user_token;
        $_SESSION['username'] = $username;
        // redirect to friends page
        header('Location: friends.php');
      } else {
        echo "<p>Registration failed...</p>";
      }
    }
  }

  ?>

</body>

</html>