<?php
if (!isset($projectPath)) $projectPath = "../../../"
?>

<header>
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
            <button>Abmelden</button>
            <a href="<?php echo $projectPath ?>sites/user/login/login.php">
                <img width="24" height="24" src="<?php echo $projectPath ?>sites/components/header/login.svg" alt = "Anmeldungs-Icon">
                <p>Anmelden</p>
            </a>
        </div>
        <nav>
            <a href="<?php echo $projectPath ?>sites/news/overview/newsOverview.php"> Neuigkeiten </a>
            <a href="<?php echo $projectPath ?>sites/forum/overview/forumOverview.php"> Forum </a>
            <a href="<?php echo $projectPath ?>sites/politics/overview/politicsOverview.php"> Kommunalpolitik </a>
            <a href="<?php echo $projectPath ?>sites/other/tutorial/tutorial.php"> Hilfe </a>
        </nav>
    </div>
</header>
