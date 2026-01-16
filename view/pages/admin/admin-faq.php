<main class="content">
  <div class="deconnexion">
    <button class="btn-small" onclick="window.location.href='index.php?page=home'">Revenir à l'accueil</button>
    <button class="btn-small" onclick="window.location.href='index.php?page=logout'">Se déconnecter</button>
  </div>
  <div class="admin-faq">
    <h1>Gestion FAQ</h1>

    <div class="admin-faq-grid">

      <!-- Carte Ajouter -->
      <section class="admin-card">
        <h2>Ajouter une question</h2>

        <form class="admin-form" method="POST" action="index.php?page=admin-faq&action=create">
          <div>
            <label class="admin-label">Question</label>
            <input class="admin-input" type="text" name="question" required
              placeholder="Ex : Quels moyens de paiement acceptez-vous ?">
          </div>

          <div>
            <label class="admin-label">Réponse</label>
            <textarea class="admin-textarea" name="answer" required
              placeholder="Ex : Nous acceptons Visa, MasterCard..."></textarea>
          </div>

          <div class="admin-actions">
            <button class="btn-primary" type="submit">Publier</button>
          </div>
        </form>
      </section>

      <!-- Carte Liste -->
      <section class="admin-card">
        <h2>Questions publiées</h2>

        <div class="table-wrap">
          <table class="admin-table">
            <thead>
              <tr>
                <th>Question</th>
                <th style="width: 140px;">Actions</th>
              </tr>
            </thead>

            <tbody>
              <?php if (!empty($faqs)): ?>
                <?php foreach ($faqs as $f): ?>
                  <tr>
                    <td>
                      <div class="faq-question"><?= htmlspecialchars($f['question']) ?></div>
                      <div class="faq-answer"><?= nl2br(htmlspecialchars($f['answer'])) ?></div>
                    </td>
                    <td>
                      <a class="btn-danger" href="index.php?page=admin-faq&action=delete&id=<?= (int) $f['question_id'] ?>"
                        onclick="return confirm('Supprimer cette question ?')">
                        Supprimer
                      </a>
                    </td>
                  </tr>
                <?php endforeach; ?>
              <?php else: ?>
                <tr>
                  <td colspan="2">Aucune question publiée.</td>
                </tr>
              <?php endif; ?>
            </tbody>
          </table>
        </div>

      </section>

    </div>
  </div>
</main>