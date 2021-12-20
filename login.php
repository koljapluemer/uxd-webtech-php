<!doctype html>
<html>

  <head>
    <title>Webtech | Login</title>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Zen+Kaku+Gothic+Antique:wght@300;400;500;700&display=swap"
      rel="stylesheet">
    <!-- <link rel="stylesheet" href="./styles/main.css"> -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
  </head>
  

<body>
  <div class="bg-light">
    <div class="container text-center">
        <img class='header-img rounded-circle' src="./images/chat.png" alt="Chat Icon" width="150" height="150">
    </div>
  
  <header>
    
  </header>
  <main>
    <div>  
    <div class="container-sm bg-white border p">
        <form method="post">
            <div class="mb-3 text-center">
              <label for="SignIn" class="form-label">Please Sign In</label>
              <input type="text" name="username" id="username" class="form-control" placeholder="Username">            </div>
            <div class="mb-3">
              <input type="password" name="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
            </div>
            <div class="btn-group" role="group" aria-label="Basic example">
                <button type="button" class="btn btn-secondary">Register</button>
                <input type="submit" class="btn btn-primary" value="Login">
            </div>
          </form>
    </div>  
    </div>  
  </main>
</div>
<?php 
include('components/footer.php'); 

// get form data and send to login method in BackendService
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $response = $service->login($username, $password);
    if ($response !== false) {
        echo "User $username logged in successfully";
        // set username and token in session
        $_SESSION['username'] = $username;
        $_SESSION['token'] = $response;
      } else {
        echo "Login failed...";
    }

}

?>

</body>

</html>