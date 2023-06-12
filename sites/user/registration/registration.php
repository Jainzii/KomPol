<main>
  <h2>Registrieren</h2>
  <form method="post">
    <label>
      E-Mail:
      <input type="email" name="registerEmail" value="<?php echo $this->data["email"] ?>" required>
    </label>
    <label>
      Passwort:
      <input type="password" name="registerPassword" value="<?php echo $this->data["password"] ?>" required>
    </label>
    <label>
      Passwort wiederholen:
      <input type="password" name="registerPasswordRepeat" value="<?php echo $this->data["passwordRepeat"] ?>" required>
    </label>
    <label>
      Registrierungscode:
      <input type="text" name="registerCode" value="<?php echo $this->data["code"] ?>">
    </label>
    <input type="submit" name="register" value="Registrieren">
    <p>Bereits einen Account? <a href="?view=login">Hier anmelden</a></p>
  </form>
</main>