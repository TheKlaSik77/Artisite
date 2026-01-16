<link rel="stylesheet" href="./assets/css/pages/craftman-support.css">

<div class="craftman-support-page">

  <div class="craftman-support-top">
    <h1>Support Artisan</h1>
    <p>Gérez les tickets reçus et répondez aux demandes des clients.</p>
  </div>

  <div class="craftman-support-layout">

    <!-- LEFT: Tickets -->
    <div class="craftman-card">
      <h2>Tickets reçus</h2>

      <ul class="craftman-items">
        <?php foreach ($tickets as $t): ?>
          <li class="craftman-item <?= (isset($_GET['ticket_id']) && (int)$_GET['ticket_id']===(int)$t['ticket_id']) ? 'active' : '' ?>">
            <a href="index.php?page=craftman-support&ticket_id=<?= (int)$t['ticket_id'] ?>">
              <?= htmlspecialchars($t['subject']) ?>
            </a>
            <span class="craftman-status" data-status="<?= htmlspecialchars($t['status']) ?>">
              <?= htmlspecialchars($t['status']) ?>
            </span>
          </li>
        <?php endforeach; ?>
      </ul>
    </div>

    <!-- RIGHT: Details -->
    <div class="craftman-card">
      <h2>Détails</h2>

      <?php if ($currentTicket): ?>

        <div class="craftman-meta">
          <div><strong>Sujet :</strong> <?= htmlspecialchars($currentTicket['subject']) ?></div>
          <div><strong>Statut :</strong> <?= htmlspecialchars($currentTicket['status']) ?></div>
        </div>

        <form class="craftman-actions" method="POST"
              action="index.php?page=craftman-support&action=status&ticket_id=<?= (int)$currentTicket['ticket_id'] ?>">
          <select class="craftman-select" name="status">
            <option value="nouveau" <?= $currentTicket['status']==='nouveau'?'selected':'' ?>>Nouveau</option>
            <option value="en_cours" <?= $currentTicket['status']==='en_cours'?'selected':'' ?>>En cours</option>
            <option value="resolu" <?= $currentTicket['status']==='resolu'?'selected':'' ?>>Résolu</option>
          </select>
          <button class="btn" type="submit">Mettre à jour</button>
        </form>

        <div class="craftman-messages">
          <?php foreach ($messages as $m): ?>
            <div class="craftman-message" data-role="<?= htmlspecialchars($m['sender_role']) ?>">
              <div class="meta">
                <strong><?= htmlspecialchars($m['sender_role']) ?></strong>
                <small><?= htmlspecialchars($m['created_at']) ?></small>
              </div>
              <div class="body"><?= nl2br(htmlspecialchars($m['body'])) ?></div>
            </div>
          <?php endforeach; ?>
        </div>

        <form class="craftman-reply" method="POST"
              action="index.php?page=craftman-support&action=reply&ticket_id=<?= (int)$currentTicket['ticket_id'] ?>">
          <textarea class="craftman-textarea" name="message" required placeholder="Réponse artisan..."></textarea>
          <button class="btn btn-primary" type="submit">Répondre</button>
        </form>

      <?php else: ?>
        <p>Sélectionne un ticket.</p>
      <?php endif; ?>

    </div>

  </div>
</div>
