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
    <img class='header-img rounded-circle' src="./images/logout.png" alt="User Icon" width="150" height="150">
    </div> 
    <div class="container bg-white border">
    <header>
      <h2 class="text-center">Logged out</h2>
    </header>
    <main>
      <div id='logout-wrapper' class="text-center">
        <p class="text-center">See u!</p>
        <button type="button" class="btn btn-secondary">Log in again</button>
      </div>
    </div>
    </main>
    </div>
<?php include('components/footer.php'); ?>

  </body>
     
</html>