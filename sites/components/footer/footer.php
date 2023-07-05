<?php
if (!isset($projectPath)) $projectPath = "../../../"
?>
<footer>
  <nav>
    <a href="<?php echo $projectPath ?>sites/footer/imprint/imprint.php"> Impressum </a>
    <a href="<?php echo $projectPath ?>sites/footer/privacyPolicy/privacyPolicy.php"> Datenschutz </a>
    <a href="<?php echo $projectPath ?>sites/footer/termsOfUse/termsOfUse.php"> Nutzungsbedingungen </a>
    <a href="<?php echo $projectPath ?>sites/other/support/support.php"> Support </a>
    <a onclick="drdsgvof(1)">Datenschutzeinstellungen anpassen</a>
  </nav>
  <script src="<?php echo $projectPath ?>sites/components/cookieManager/drdsgvo-consent-script.js"></script>
</footer>