<?php
session_start();
if (!isset($projectPath)) $projectPath = "../../../";

if (isset($_GET["logout"])) {
  unset($_SESSION["userId"]);
}

?>

<header>
    <!-- Einbinden Hilfsdateien -->
    <link rel="stylesheet" href="<?php echo $projectPath ?>/sites/components/cookieManager/css/drdsgvo.css">
    <!-- Falls bereits jQuery eingesetzt wird, kann die folgende Zeile ggfs. entfallen -->
    <script src="<?php echo $projectPath ?>/sites/components/cookieManager/js/jquery-2.2.0.min.js"></script>
    <script data-src="<?php echo $projectPath ?>/sites/components/cookieManager/successfulConsent.js" id="drdsgvo_script"></script>
    <div class="header">
        <div class="cityName">
            <a href="<?php echo $projectPath ?>sites/news/overview/newsOverview.php">
                <img width="80" height="80" src = "<?php echo $projectPath ?>sites/components/header/neuDoriasLogo.png" alt = "Wappen von XXX">
                <h1>Neu Dorias</h1>
            </a>
        </div>
        <input id="menu-toggle" type="checkbox" />
        <label class='menu-button-container' for="menu-toggle">
            <div class='menu-button'><p>X</p></div>
        </label>
        <div class="authentication">
            <?php if(isset($_SESSION["userId"])): ?>
            <form action="?logout=true" method="post">
              <input type="submit" id="logoutButton" value="Abmelden">
            </form>
            <a href="../../user/editProfile/editProfile.php">
                <img width="24" height="24" src="<?php echo $projectPath ?>sites/components/header/login.svg" alt = "Anmeldungs-Icon">
                <p>Nutzer bearbeiten</p>
            </a>
            <?php else: ?>
            <a href="../../user/login/login.php">
                <img width="24" height="24" src="<?php echo $projectPath ?>sites/components/header/login.svg" alt = "Anmeldungs-Icon">
                <p>Anmelden</p>
            </a>

            <?php endif; ?>
        </div>
        <nav>
            <a href="<?php echo $projectPath ?>sites/news/overview/newsOverview.php"> Neuigkeiten </a>
            <a href="<?php echo $projectPath ?>sites/forum/overview/forumOverview.php"> Forum </a>
            <a href="<?php echo $projectPath ?>sites/politics/overview/politicsOverview.php"> Kommunalpolitik </a>
            <a href="<?php echo $projectPath ?>sites/other/tutorial/tutorial.php"> Hilfe </a>
        </nav>
    </div>
</header>
