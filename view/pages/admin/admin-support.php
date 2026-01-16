<link rel="stylesheet" href="./assets/css/pages/admin-support.css?v=2">

<div class="support-page">

  <!-- Header page -->
  <div class="support-top">
    <h1 class="page-title">Support</h1>
    <p class="page-subtitle">
      Gère les tickets, change leur statut et réponds aux utilisateurs.
    </p>
  </div>

  <div class="support-layout">

    <!-- ================== -->
    <!--  LISTE DES TICKETS -->
    <!-- ================== -->
    <div class="support-list">

      <div class="support-list-header">
        <h2>Tickets</h2>

        <form method="GET" action="index.php">
          <input type="hidden" name="page" value="admin-support">
          <select class="support-filter" name="status" onchange="this.form.submit()">
            <option value="">Tous</option>
            <option value="nouveau" <?= ($_GET['status'] ?? '') === 'nouveau' ? 'selected' : '' ?>>Nouveau</option>
            <option value="en_cours" <?= ($_GET['status'] ?? '') === 'en_cours' ? 'selected' : '' ?>>En cours</option>
            <option value="resolu" <?= ($_GET['status'] ?? '') === 'resolu' ? 'selected' : '' ?>>Résolu</option>
          </select>
        </form>
      </div>

      <ul class="support-items">
        <?php foreach ($tickets as $t): ?>
          <li class="support-item <?= (isset($_GET['ticket_id']) && (int)$_GET['ticket_id'] === (int)$t['ticket_id']) ? 'active' : '' ?>">

            <a class="support-item-link"
               href="index.php?page=admin-support&ticket_id=<?= (int)$t['ticket_id'] ?>">
              <?= htmlspecialchars($t['subject']) ?>
            </a>

            <small class="support-item-status"
                   data-status="<?= htmlspecialchars($t['status']) ?>">
              <?= htmlspecialchars($t['status']) ?>
            </small>

          </li>
        <?php endforeach; ?>
      </ul>

    </div>

    <!-- ================== -->
    <!--  DÉTAIL DU TICKET  -->
    <!-- ================== -->
    <div class="support-detail">

      <?php if ($currentTicket): ?>

        <div class="support-detail-header">
          <h2><?= htmlspecialchars($currentTicket['subject']) ?></h2>

          <form class="support-status-form"
                method="POST"
                action="index.php?page=admin-support&action=status&ticket_id=<?= (int)$currentTicket['ticket_id'] ?>">

            <label>Statut :</label>

            <select name="status">
              <option value="nouveau" <?= $currentTicket['status'] === 'nouveau' ? 'selected' : '' ?>>Nouveau</option>
              <option value="en_cours" <?= $currentTicket['status'] === 'en_cours' ? 'selected' : '' ?>>En cours</option>
              <option value="resolu" <?= $currentTicket['status'] === 'resolu' ? 'selected' : '' ?>>Résolu</option>
            </select>

            <button class="btn" type="submit">Enregistrer</button>
          </form>
        </div>

        <!-- Messages -->
        <div class="support-messages">
          <?php foreach ($messages as $m): ?>
            <div class="support-message">

              <div class="support-message-meta">
                <strong><?= htmlspecialchars($m['sender_role']) ?></strong>
                <small><?= htmlspecialchars($m['created_at']) ?></small>
              </div>

              <div class="support-message-body">
                <?= nl2br(htmlspecialchars($m['body'])) ?>
              </div>

            </div>
          <?php endforeach; ?>
        </div>

        <!-- Réponse admin -->
        <form class="support-reply"
              method="POST"
              action="index.php?page=admin-support&action=reply&ticket_id=<?= (int)$currentTicket['ticket_id'] ?>">

          <textarea name="message"
                    required
                    placeholder="Réponse admin..."></textarea>

          <button class="btn btn-primary" type="submit">
            Répondre
          </button>
        </form>

      <?php else: ?>
        <p>Sélectionne un ticket à gauche.</p>
      <?php endif; ?>

    </div>

  </div>
</div>
