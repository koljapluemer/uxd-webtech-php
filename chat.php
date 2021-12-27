<!DOCTYPE html>
<html>

<head>
  <title>Webtech | Chat</title>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Zen+Kaku+Gothic+Antique:wght@300;400;500;700&display=swap" rel="stylesheet" />
  <!-- <link rel="stylesheet" href="./styles/main.css"> -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>

<body class="container mt-5 pt-5">
  <?php
  include('components/header.php');

  use Model\Message;
  use Model\Friend;

  // handle deleting of friend
  if (!empty($_GET['remove'])) {

    if ($_GET['remove'] == 'remove') {
      $friend = new Friend($_SESSION['partner']);
      $service->friendRemove($friend, $_SESSION['user_token']);
      // redirect to friends
      header('Location: friends.php');
    }
  }


  // if get variable partner exists, save it
  if (!empty($_GET['partner'])) {
    // set session variable partner
    $_SESSION['partner'] = $_GET['partner'];
  }

  if (!empty($_SESSION['partner'])) {
    echo "<h1>Chat with " . $_SESSION['partner'] . "</h1>";
  } else {
    // redirect back to friends if we have no partner
    header("Location: friends.php");
  }

  // check if we have a message to send
  if (!empty($_POST['message'])) {
    $message = $_POST['message'];
    $to = $_SESSION['partner'];
    $message = new Message($to, $message);
    $messageSucceeded =  $service->sendMessage($message,  $_SESSION['user_token']);
    if ($messageSucceeded) {
      echo "Message sent!";
    } else {
      echo "Message not sent!";
    }
  }
  ?>
  <header>
    <div class="btn-group">
      <a class="btn btn-secondary" href="./friends.php"> &lt; Back</a>
      <!-- Button trigger modal -->
      <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#removeFriendModal">
        Remove Friend
      </button>
      <!--  -->
    </div>
  </header>

  <main>
    <!-- this is kind of a form but we dont want page reload... -->
    <div id="chat">
      <div id="chat-wrapper" class="border p-3 mt-3 mb-3" style="max-height: 60vh; overflow-y:auto;">
        ... loading chat
      </div>
      <form action="./chat.php" method="post">
        <div class="input-group">
          <input type="text" placeholder="New Message" id="msg-input" class="form-control" name="message" />
          <input type="submit" value="Send" id="msg-send" class="btn btn-primary" />
        </div>
      </form>
    </div>
  </main>

  <!-- Modal -->
  <div class="modal fade" id="removeFriendModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Remove This Friend</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cancel"></button>
        </div>
        <div class="modal-body">End Friendship?</div>
        <form class="modal-footer" action="./chat.php" method="delete">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
            Close
          </button>
          <button type="submit" class="btn btn-danger" id="remove-friend" value="remove" name="remove">Remove Friend</button>
        </form>
      </div>
    </div>
  </div>
  <script>
    window.chatToken = "<?= $_SESSION['user_token'] ?>";
    window.chatCollectionId = "<?= CHAT_SERVER_ID ?>";
    window.chatServer = "<?= CHAT_SERVER_URL ?>";
    window.partner = "<?= $_SESSION['partner'] ?>";
  </script>
  <script src="./scripts/chat.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

</body>

</html>