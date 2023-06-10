<!-- main content -->
<main>
  <h2>Support-Ticket einreichen:</h2>
  <form action="?view=support&supportTicket=1" method="post">
    <!-- issue category -->
    <label>
      Anliegen:
      <select name="ticketIssue" required>
        <option value="anliegen1">Anliegen 1</option>
        <option value="anliegen2">Anliegen 2</option>
        <option value="anliegen3">Anliegen 3</option>
      </select>
    </label>
    <!-- support ticket  -->
    <?php if (!$this->data["isSignedIn"]): ?>
    <label>
      Email:
      <input type="email" name="ticketEmail" required>
    </label>
    <?php endif; ?>
    <label>
      Nachricht:
      <textarea name="ticketText" rows="20" cols="50" required></textarea>
    </label>
    <input type="submit" value="Nachricht abschicken">
  </form>
</main>

<!-- footer -->
<?php
include_once "sites/components/footer/footer.php"
?>