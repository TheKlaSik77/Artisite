<link rel="stylesheet" href="./assets/css/pages/support.css">

<div class="support-page">

  <div class="support-top">
    <h1>Support</h1>
    <p>Crée une demande, suis son statut et discute avec l’équipe / l’artisan.</p>
  </div>

  <div class="support-layout">

    <!-- LEFT -->
    <div class="support-card">

      <h2>Mes demandes</h2>

      <ul class="support-items">
        <?php foreach ($tickets as $t): ?>
          <li class="support-item <?= (isset($_GET['ticket_id']) && (int)$_GET['ticket_id']===(int)$t['ticket_id']) ? 'active' : '' ?>">
            <a href="index.php?page=support&ticket_id=<?= (int)$t['ticket_id'] ?>">
              <?= htmlspecialchars($t['subject']) ?>
            </a>
            <span class="support-status" data-status="<?= htmlspecialchars($t['status']) ?>">
              <?= htmlspecialchars($t['status']) ?>
            </span>
          </li>
        <?php endforeach; ?>
      </ul>

      <hr class="support-sep">

      <h2>Créer une demande</h2>

      <form class="support-form" method="POST" action="index.php?page=support&action=create">

        <div>
          <div class="support-label">Sujet</div>
          <input class="support-input" type="text" name="subject" required>
        </div>

        <div>
          <div class="support-label">ID Artisan (pour MVP)</div>
          <input class="support-input" type="number" name="craftman_id" required>
        </div>

        <div>
          <div class="support-label">Message</div>
          <textarea class="support-textarea" name="message" required></textarea>
        </div>

        <button class="btn btn-primary" type="submit">Envoyer</button>
      </form>

    </div>

    <!-- RIGHT -->
    <div class="support-card">

      <h2>Conversation</h2>

      <?php if ($currentTicket): ?>

        <div class="support-meta">
          <div><strong>Sujet :</strong> <?= htmlspecialchars($currentTicket['subject']) ?></div>
          <div><strong>Statut :</strong> <?= htmlspecialchars($currentTicket['status']) ?></div>
        </div>

        <div class="support-messages">
          <?php foreach ($messages as $m): ?>
            <div class="support-message" data-role="<?= htmlspecialchars($m['sender_role']) ?>">
              <div class="meta">
                <strong><?= htmlspecialchars($m['sender_role']) ?></strong>
                <small><?= htmlspecialchars($m['created_at']) ?></small>
              </div>
              <div class="body"><?= nl2br(htmlspecialchars($m['body'])) ?></div>
            </div>
          <?php endforeach; ?>
        </div>

        <form class="support-reply" method="POST"
              action="index.php?page=support&action=reply&ticket_id=<?= (int)$currentTicket['ticket_id'] ?>">
          <textarea class="support-textarea" name="message" required placeholder="Votre réponse..."></textarea>
          <button class="btn btn-primary" type="submit">Répondre</button>
        </form>

      <?php else: ?>
        <p>Sélectionne un ticket pour voir la conversation.</p>
      <?php endif; ?>

    </div>

  </div>
</div>
