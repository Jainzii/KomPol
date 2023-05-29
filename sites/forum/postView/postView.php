<!DOCTYPE html>
<html lang="de">
<head>
  <meta charset="UTF-8">
  <title>KomPol</title>
  <link rel="stylesheet" type="text/css" href="../../../css/main.css">
  <link rel="stylesheet" type="text/css" href="postView.css">
  <meta name="viewport" content="width=device-width,initial-scale=1">
</head>
  <body>
    <!-- header -->
    <?php
    include "../../components/header/header.php"
    ?>

    <!-- main content -->
    <main>
      <!-- post and answers -->
      <div>
        <!-- post  -->
        <section class="post">
          <div class="userInfo">
            <img
              width="100"
              height="100"
              src="../../user/media/avatarDummy.png"
              alt = "Avatar">
            <p>Vorname</p>
            <p>Nachname</p>
          </div>
          <div class="postContent">
            <h2>Titel des Beitrags</h2>
            <p> Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore
              et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum.
              Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit
              amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam
              erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren,
              no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing
              elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua.
              At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus
              est Lorem ipsum dolor sit amet.
              Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat, vel illum dolore
              eu feugiat nulla facilisis at vero eros et accumsan et iusto odio dignissim qui blandit praesent luptatum
              zzril delenit augue duis dolore te feugait nulla facilisi. Lorem ipsum dolor sit amet,</p>
            <p>XXXX Likes | XXXX Dislikes</p>
            <button>Antworten</button>
          </div>
        </section>
        <!-- answers  -->
        <section class="comments">
          <h3>Kommentare</h3>
          <div class="comment">
            <div class="commentContent">
              <div class="userInfo">
                <img
                        width="100"
                        height="100"
                        src="../../user/media/avatarDummy.png"
                        alt = "Avatar">
                <p>Vorname</p>
                <p>Nachname</p>
              </div>
              <div class="postContent">
                <p>
                  Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore
                  et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum.
                  Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit
                  amet, consetetur sadipscing elitr
                </p>
                <p> XX Likes | XX Dislikes</p>
                <button> Antworten </button>
              </div>
            </div>
            <div class="comment">
              <div class="commentContent">
                <div class="userInfo">
                  <img
                          width="100"
                          height="100"
                          src="../../user/media/avatarDummy.png"
                          alt = "Avatar">
                  <p>Vorname</p>
                  <p>Nachname</p>
                </div>
                <div class="postContent">
                  <p>
                    Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore
                    et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum.
                    Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit
                    amet, consetetur sadipscing elitr
                  </p>
                  <p> XX Likes | XX Dislikes</p>
                  <button> Antworten </button>
                </div>
              </div>
            </div>
            <div class="comment">
              <div class="commentContent">
                <div class="userInfo">
                  <img
                          width="100"
                          height="100"
                          src="../../user/media/avatarDummy.png"
                          alt = "Avatar">
                  <p>Vorname</p>
                  <p>Nachname</p>
                </div>
                <div class="postContent">
                  <p>
                    Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore
                    et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum.
                    Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit
                    amet, consetetur sadipscing elitr
                  </p>
                  <p> XX Likes | XX Dislikes</p>
                  <button> Antworten </button>
                </div>
              </div>
              <div class="comment">
                <div class="commentContent">
                  <div class="userInfo">
                    <img
                            width="100"
                            height="100"
                            src="../../user/media/avatarDummy.png"
                            alt = "Avatar">
                    <p>Vorname</p>
                    <p>Nachname</p>
                  </div>
                  <div class="postContent">
                    <p>
                      Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore
                      et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum.
                      Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit
                      amet, consetetur sadipscing elitr
                    </p>
                    <p> XX Likes | XX Dislikes</p>
                    <button> Antworten </button>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </section>
      </div>
      <!-- party opinions -->
      <section class="partyOpinions">
        <h3>Meinung der Parteien</h3>
        <div class="opinionsContainer">
          <img width="32" height="32" src="../../../images/site/partyCircle.svg" alt = "Parteikreis">
          <img width="32" height="32" src="../../../images/site/partyCircle.svg" alt = "Parteikreis">
          <img width="32" height="32" src="../../../images/site/partyCircle.svg" alt = "Parteikreis">
          <img width="32" height="32" src="../../../images/site/partyCircle.svg" alt = "Parteikreis">
        </div>
      </section>
    </main>

    <!-- footer -->
    <footer>
      <nav>
        <a href="../../footer/imprint/imprint.php"> Impressum </a>
        <a href="../../footer/privacyPolicy/privacyPolicy.php"> Datenschutz </a>
        <a href="../../footer/termsOfUse/termsOfUse.php"> Nutzungsbedingungen </a>
        <a href="../../other/support/support.php"> Support </a>
      </nav>
    </footer>
  </body>
</html>