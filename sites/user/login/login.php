<main>
  <h2>Anmelden</h2>
  <form method="post">
    <label>
      E-Mail:
      <input type="email" name="loginEmail" value="<?php echo $this->data["email"] ?>" required>
    </label>
    <label>
      Passwort:
      <input type="password" name="loginPassword" value="<?php echo $this->data["password"] ?>"" required>
    </label>
    <input type="submit" name="loginSubmit" value="Anmelden">
    <p>Noch keinen Account? <a href="?view=registration">Hier registrieren</a></p>
  </form>
</main>