<!DOCTYPE html>
<html>
  <head>
    <title>Webtech | Friends</title>
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
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3"
      crossorigin="anonymous"
    />
  </head>

  <body>
    <div class="container">
      <header>
        <h1>Friends</h1>
        <div class="btn-group" role="group" aria-label="Basic example">
          <button type="button" class="btn btn-secondary">&lt;Logout></button>
          <button type="button" class="btn btn-secondary">Edit Profile</button>
        </div>
      </header>
      <hr />
      <main>
        <ul class="list-group">
          <li
            class="
              list-group-item
              d-flex
              justify-content-between
              align-items-start
            "
          >
            Tom<span class="badge bg-primary rounded-circle">3</span>
          </li>

          <li
            class="
              list-group-item
              d-flex
              justify-content-between
              align-items-start
            "
          >
            Marvin<span class="badge bg-primary rounded-circle">1</span>
          </li>

          <li class="list-group-item">Tick</li>
          <li class="list-group-item">Trick</li>
        </ul>
        <hr />
        <h2>New Request</h2>
        <ul class="list-group">
          <li class="list-group-item">
            Friend request from
            <button
              type="button"
              class="btn"
              data-toggle="modal"
              data-target="#dialog"
            >
              Track
            </button>
          </li>
        </ul>
        <button data-bs-toggle="modal" data-bs-target="#dialog">Test</button>
        <!-- modal -->
        <div class="modal fade" id="dialog" role="dialog">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h4 class="modal-title">Titel</h4>
                <button
                  type="button"
                  class="btn-close"
                  data-dismiss="modal"
                ></button>
              </div>
              <div class="modal-body">
                <div class="container">
                  <p>Inhalt</p>
                </div>
              </div>
              <div class="modal-footer">
                <button
                  type="button"
                  class="btn btn-primary btn-block"
                  onclick="accept()"
                >
                  Login (im footer)
                </button>
              </div>
            </div>
          </div>
        </div>
        <hr />
        <div class="input-group mb-3">
          <input
            type="text"
            class="form-control"
            placeholder="Recipient's username"
            aria-label="Add Friend to list"
            aria-describedby="basic-addon2"
          />
          <button class="btn btn-primary" type="button" id="button-addon2">
            Add
          </button>
        </div>
      </main>
    </div>
    <?php include('components/footer.php'); ?>

    <script>
      function accept() {
        let myModalEl = document.getElementById("dialog");
        let modal = bootstrap.Modal.getOrCreateInstance(myModalEl);
        modal.show();
      }
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

  </body>
</html>
