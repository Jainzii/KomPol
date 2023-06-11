<main>
  <!-- change details -->
  <section class="changeDetails">
    <h2>Daten ändern</h2>
    <form method="post" enctype="multipart/form-data">
      <img
        width="100"
        height="100"
        src="<?php echo $this->data["avatar"] ?>"
        alt = "Jetziger Avatar">

      <input
        type="file"
        name="avatar"
        accept="image/png, image/jpeg">
      <label>
        E-Mail:
        <input type="email" name="changeEmail" value="<?php echo $this->data["email"] ?>" required>
      </label>
      <label>
        Vorname:
        <input type="text" name="changeFirstName" value="<?php echo $this->data["firstName"] ?>" required>
      </label>
      <label>
        Nachname:
        <input type="text" name="changeLastName" value="<?php echo $this->data["lastName"] ?>" required>
      </label>
      <input type="submit" name="detailsSubmit" value="Daten ändern">
    </form>
  </section>

  <!-- change password -->
  <section class="changePassword">
    <h2>Passwort ändern</h2>
    <form method="post">
      <label>
        Altes Passwort:
        <input type="password" name="oldPassword" required>
      </label>
      <label>
        Neues Passwort:
        <input type="password" name="newPassword" required>
      </label>
      <label>
        Neues Passwort wiederholen:
        <input type="password" name="newPasswordRepeat" required>
      </label>
      <input type="submit" name="passwordSubmit" value="Passwort ändern">
    </form>
  </section>
</main>