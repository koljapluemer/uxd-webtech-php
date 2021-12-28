<!DOCTYPE html>
<html>

<head>
  <title>Webtech | Friends</title>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Zen+Kaku+Gothic+Antique:wght@300;400;500;700&display=swap" rel="stylesheet" />
  <!-- <link rel="stylesheet" href="./styles/main.css"> -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
</head>

<body class="container mt-5 pt-5">
  <?php
  include('components/header.php');

   // if user token not set, redirect to login page
   if (!isset($_SESSION['user_token'])) {
    header('Location: login.php');
  }

  use Model\Friend;
  // POST means new friend request

  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $recipient = $_POST['recipient'];
    $friend = new Friend($recipient, "accepted");
    // send friend request to backend service
    $requestSucceeded = $service->friendRequest($friend, $_SESSION['user_token']);
    if ($requestSucceeded) {
      echo "<br>Request sent";
    } else {
      echo "<br>Request failed";
    }
  }

  // PUT (or rather, GET) means declining accepting one
  // but normal page load is also get, so we also check if we have interesting variables
  // otherwise, we just do nothing
  if ($_SERVER['REQUEST_METHOD'] === 'GET' && !empty($_GET)) {
    // get the first key value pair from _GET, that's the friend and desired action
    $key = array_keys($_GET)[0];
    $value = $_GET[$key];
    // if value is decline, we do friendDismiss, if it's accept, we do friendAccept with the key as username
    if ($value === "decline") {
      $friend = new Friend($key, "dismissed");
      $dismissSucceeded = $service->friendDismiss($friend, $_SESSION['user_token']);
      if ($dismissSucceeded) {
        echo "<br>Dismissed";
      } else {
        echo "<br>Dismiss failed";
      }
    } else if ($value === "accept") {
      $friend = new Friend($key, "accepted");
      $acceptSucceeded = $service->friendAccept($friend, $_SESSION['user_token']);
      if ($acceptSucceeded) {
        echo "<br>Accepted";
      } else {
        echo "<br>Accept failed";
      }
    }
  }


  ?>
  <header>
    <h1>Friends</h1>
    <a href="./logout.php" class="btn btn-secondary">Logout</a>
    </div>
  </header>
  <hr />
  <main>
    <ul class="list-group">
      <?php

      // load friends from backend service
      $friends = $service->loadFriends($_SESSION['user_token']);
      $unreadMessages = $service->getUnreadMessages($_SESSION['user_token']);
      // check if there are friends with status accepted
      $acceptedFriendsExist = false;
      foreach ($friends as $friend) {
        if ($friend->getStatus() === "accepted") {
          $acceptedFriendsExist = true;
          break;
        }
      }
      if ($acceptedFriendsExist) {
        foreach ($friends as $friend) {
          $name = $friend->getUsername();
          if ($friend->getStatus() == 'accepted') {
            echo '<a href="./chat.php?partner='
              . $name
              . '" class="list-group-item d-flex justify-content-between  ">'
              . $name;
            // check if key with the name of the friend exists in unreadMessages
            if (property_exists($unreadMessages, $name)) {
              echo $unreadMessages->$name !== 0 ? '<span class="badge bg-secondary circle-rounded">' . $unreadMessages->$name . '</span>' : '';
            }
            echo '</a>';
          }
        }
      } else {
        echo "<h2>No friends yet</h2>";
      }

      ?>


    </ul>
    <h2 class="mt-2 mb-2" >Friend Requests</h2>
    <form class="list-group" method='put' action="friends.php">

      <?php
      // check if there are friends with status requested
      $requestedFriendsExist = false;
      foreach ($friends as $friend) {
        if ($friend->getStatus() === "requested") {
          $requestedFriendsExist = true;
          break;
        }
      }
      if ($requestedFriendsExist) {
        echo "<hr>";
        foreach ($friends as $friend) {
          if ($friend->getStatus() === "requested") {
            echo '<li class="list-group-item d-flex justify-content-between align-items-center">'
              . "<span>Friend Request from "
              . $friend->getUsername()
              . '</span><div><button type="submit" value="accept" name="' . $friend->getUsername() . '" class="btn btn-success"><i class="bi-check-circle-fill "></i> Accept</button>'
              . '<button type="submit" value="decline" name="' . $friend->getUsername() . '" class="ms-2 btn btn-danger"><i class="bi-x-circle-fill "></i> Decline</button>'
              . '</div></li>';
          }
        }
        echo "<hr>";
      }
      ?>


    </form>
    <!-- <button data-bs-toggle="modal" data-bs-target="#dialog">Test</button> -->
    <!-- modal -->
    <div class="modal fade" id="dialog" role="dialog">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title">Titel</h4>
            <button type="button" class="btn-close" data-dismiss="modal"></button>
          </div>
          <div class="modal-body">
            <div class="container">
              <p>Inhalt</p>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-primary btn-block" onclick="accept()">
              Login (im footer)
            </button>
          </div>
        </div>
      </div>
    </div>
    <form action="friends.php" class="mb-3 mt-3" method="post">
      <div class="input-group">
        <input id="username" type="text" name="recipient" class="form-control" placeholder="Recipient's username" aria-label="Add Friend to list" aria-describedby="basic-addon2" />
        <input class="btn btn-primary" type="submit" value="Add" id="button-addon2">


      </div>
      <div id="recommendations" class="list-group"></div>

    </form>
  </main>
  <script>
    window.chatToken = "<?= $_SESSION['user_token'] ?>";
    window.chatCollectionId = "<?= CHAT_SERVER_ID ?>";
    window.chatServer = "<?= CHAT_SERVER_URL ?>";
  </script>

  <script>
    function accept() {
      let myModalEl = document.getElementById("dialog");
      let modal = bootstrap.Modal.getOrCreateInstance(myModalEl);
      modal.show();
    }
  </script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
  <script src="scripts/friends.js"></script>
</body>

</html>