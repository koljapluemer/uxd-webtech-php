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


<body class="container">

  <img class='header-img' src="./images/user.png" alt="User Icon" width="100" height="100">
  <header>
    <h1>Register yourself</h1>

  </header>
  <main>
    <form method="post" id="checkSubmission">
      <fieldset>
        <legend>Register</legend>
        <div class="label-input-wrapper">
          <label for="username">Username</label>
          <input type="text" name="username" id="username" value="" placeholder="Username"> <br>
        </div>

        <div class="label-input-wrapper">
          <label for="password">Password</label>
          <input type="password" name="password" id="password" value="" placeholder="Password"> <br>
        </div>
        <div class="label-input-wrapper">
          <label for="password-conf">Confirm Password</label>
          <input type="password" name="password-conf" id="password-conf" value="" placeholder="Confirm Password">
        </div>
      </fieldset>

      <a href="./login.html" class="button">Cancel</a>
      <input type="submit" class='button button-primary' value="Create Account">
    </form>
    <p id="msg"></p>
  </main>
  <?php include('components/footer.php'); ?>

  <?php

  // get form data and send to register backend service
  if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $password_conf = $_POST['password-conf'];

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