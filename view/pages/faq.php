<link rel="stylesheet" href="./assets/css/pages/faq.css">

<section class="faq" id="faq">
  <div class="faq-inner">

    <div class="faq-header">
      <p class="part-title">FAQ</p>
      <h2 class="part-subtitle">Questions fréquentes</h2>
      <p class="faq-intro">Retrouvez ici les réponses aux questions les plus fréquentes.</p>
    </div>

    <div class="faq-search">
      <span class="faq-search-icon">🔍</span>
      <input type="text" id="faqSearch" placeholder="Rechercher une question..." />
    </div>

    <div class="faq-list" id="faqList">
      <?php if (!empty($faqs)): ?>
        <?php foreach ($faqs as $f): ?>
          <article class="faq-item" data-tags="">
            <button class="faq-question" type="button">
              <span class="faq-question-text"><?= htmlspecialchars($f['question']) ?></span>
              <span class="faq-icon">+</span>
            </button>

            <div class="faq-answer">
              <p><?= nl2br(htmlspecialchars($f['answer'])) ?></p>
            </div>
          </article>
        <?php endforeach; ?>
      <?php else: ?>
        <p>Aucune question pour le moment.</p>
      <?php endif; ?>
    </div>

    <div class="faq-empty" id="faqEmpty" style="display:none;">
      <span>🤎</span>
      <p>Aucune question ne correspond à votre recherche.</p>
    </div>

  </div>
</section>

<script src="./assets/js/faq.js"></script>
