<!DOCTYPE html>
<html>
  <head>
    <title>Webtech | Chat</title>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Zen+Kaku+Gothic+Antique:wght@300;400;500;700&display=swap"
      rel="stylesheet"
    />
    <!-- <link rel="stylesheet" href="./styles/main.css"> -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
  </head>

  <body class="container">
    <header>
      <h1>Chat with <span class="name">Tom</span></h1>
      <div class="btn-group">
        <a class="btn btn-secondary" href="./friends.html"> &lt; Back</a>
        <a class="btn btn-secondary" href="./profile.html">Profile</a>
        <!-- Button trigger modal -->
        <button
          type="button"
          class="btn btn-danger"
          data-bs-toggle="modal"
          data-bs-target="#removeFriendModal"
        >
          Remove Friend
        </button>
        <!--  -->
      </div>
    </header>

    <main>
      <!-- this is kind of a form but we dont want page reload... -->
      <div id="chat">
        <div id="chat-wrapper" class="border p-3 mt-3 mb-3">
          Loading messages...
        </div>
        <div class="input-group">
          <input
            type="text"
            placeholder="New Message"
            id="msg-input"
            class="form-control"
          />
          <input
            type="submit"
            value="Send"
            id="msg-send"
            class="btn btn-primary"
          />
        </div>
      </div>
    </main>

    <!-- Modal -->
    <div
      class="modal fade"
      id="removeFriendModal"
      tabindex="-1"
      aria-labelledby="exampleModalLabel"
      aria-hidden="true"
    >
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Remove This Friend</h5>
            <button
              type="button"
              class="btn-close"
              data-bs-dismiss="modal"
              aria-label="Cancel"
            ></button>
          </div>
          <div class="modal-body">End Friendship?</div>
          <div class="modal-footer">
            <button
              type="button"
              class="btn btn-secondary"
              data-bs-dismiss="modal"
            >
              Close
            </button>
            <a class="btn btn-danger" href="./friends.html" id="remove-friend">Remove Friend</a>
          </div>
        </div>
      </div>
    </div>

    <script src="./scripts/chat.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <?php include('components/footer.php'); ?>

  </body>
</html>
