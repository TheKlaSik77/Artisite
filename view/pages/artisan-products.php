<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Artisan – Mes produits</title>

  <link rel="stylesheet" href="../../assets/css/pages/add-product-craftmans.css">
</head>
<body>

<div class="container">

  <header class="header header-split">
    <div>
      <h1>Mes produits</h1>
      <p class="muted">Gérez vos produits : modifier, supprimer, surveiller le stock.</p>
    </div>

    <div class="header-actions">
      <a class="btn-outline" href="javascript:history.back()">← Retour</a>
      <a class="btn-primary" href="./add-product-craftman.html">+ Ajouter un produit</a>
    </div>
  </header>

  <!-- Toolbar -->
  <div class="toolbar">
    <div class="toolbar-left">
      <div class="searchbox">
        <span class="search-ico">🔍</span>
        <input id="searchInput" type="text" placeholder="Rechercher par nom, catégorie, statut..." />
      </div>

      <select id="statusFilter" class="select">
        <option value="all">Tous statuts</option>
        <option value="published">Publié</option>
        <option value="pending">En validation</option>
        <option value="draft">Brouillon</option>
      </select>

      <select id="stockFilter" class="select">
        <option value="all">Tous stocks</option>
        <option value="low">Stock faible (≤ 5)</option>
        <option value="out">Rupture (0)</option>
      </select>
    </div>

    <div class="toolbar-right">
      <div id="count" class="count-pill">0 produit</div>
    </div>
  </div>

  <!-- Liste -->
  <div id="productsList" class="products-list">

    <!-- Produit 1 -->
    <article class="product-row"
      data-id="1"
      data-title="Bol en céramique"
      data-category="Poterie"
      data-status="published"
      data-stock="12"
    >
      <div class="prod-left">
        <div class="prod-thumb">
          <img src="../../assets/img/products/2.jpg" alt="Bol en céramique">
        </div>

        <div class="prod-meta">
          <h3 class="prod-title">Bol en céramique</h3>
          <div class="prod-sub">
            <span class="badge cat">Poterie</span>
            <span class="badge status published">Publié</span>
            <span class="price">29,00 €</span>
          </div>
          <p class="prod-desc">Bol tourné à la main, finition émaillée.</p>
        </div>
      </div>

      <div class="prod-right">
        <div class="stock-box">
          <div class="stock-label">Stock</div>
          <div class="stock-controls">
            <button class="icon-btn" type="button" data-action="dec" aria-label="Diminuer">−</button>
            <input class="stock-input" type="number" min="0" value="12" />
            <button class="icon-btn" type="button" data-action="inc" aria-label="Augmenter">+</button>
          </div>
          <div class="stock-hint">OK</div>
        </div>

        <div class="row-actions">
          <!-- ✅ Modifier : le plus simple = lien -->
          <a class="btn-outline small" href="./edit-product-craftman.html?id=1">Modifier</a>
          <button class="btn-danger small" type="button" data-delete="1">Supprimer</button>
        </div>
      </div>
    </article>

    <!-- Produit 2 -->
    <article class="product-row"
      data-id="2"
      data-title="Porte-cartes en cuir"
      data-category="Accessoires"
      data-status="pending"
      data-stock="3"
    >
      <div class="prod-left">
        <div class="prod-thumb">
          <img src="../../assets/img/products/3.jpg" alt="Porte-cartes en cuir">
        </div>

        <div class="prod-meta">
          <h3 class="prod-title">Porte-cartes en cuir</h3>
          <div class="prod-sub">
            <span class="badge cat">Accessoires</span>
            <span class="badge status pending">En validation</span>
            <span class="price">39,00 €</span>
          </div>
          <p class="prod-desc">Cuir pleine fleur, couture main.</p>
        </div>
      </div>

      <div class="prod-right">
        <div class="stock-box">
          <div class="stock-label">Stock</div>
          <div class="stock-controls">
            <button class="icon-btn" type="button" data-action="dec" aria-label="Diminuer">−</button>
            <input class="stock-input" type="number" min="0" value="3" />
            <button class="icon-btn" type="button" data-action="inc" aria-label="Augmenter">+</button>
          </div>
          <div class="stock-hint">Stock faible</div>
        </div>

        <div class="row-actions">
          <a class="btn-outline small" href="./edit-product-craftman.html?id=2">Modifier</a>
          <button class="btn-danger small" type="button" data-delete="2">Supprimer</button>
        </div>
      </div>
    </article>

    <!-- Produit 3 -->
    <article class="product-row"
      data-id="3"
      data-title="Vase en grès"
      data-category="Poterie"
      data-status="draft"
      data-stock="0"
    >
      <div class="prod-left">
        <div class="prod-thumb">
          <img src="../../assets/img/products/7.jpg" alt="Vase en grès">
        </div>

        <div class="prod-meta">
          <h3 class="prod-title">Vase en grès</h3>
          <div class="prod-sub">
            <span class="badge cat">Poterie</span>
            <span class="badge status draft">Brouillon</span>
            <span class="price">42,00 €</span>
          </div>
          <p class="prod-desc">Brouillon non publié.</p>
        </div>
      </div>

      <div class="prod-right">
        <div class="stock-box">
          <div class="stock-label">Stock</div>
          <div class="stock-controls">
            <button class="icon-btn" type="button" data-action="dec" aria-label="Diminuer">−</button>
            <input class="stock-input" type="number" min="0" value="0" />
            <button class="icon-btn" type="button" data-action="inc" aria-label="Augmenter">+</button>
          </div>
          <div class="stock-hint">Rupture</div>
        </div>

        <div class="row-actions">
          <a class="btn-outline small" href="./edit-product-craftman.html?id=3">Modifier</a>
          <button class="btn-danger small" type="button" data-delete="3">Supprimer</button>
        </div>
      </div>
    </article>

  </div>

  <!-- empty -->
  <p id="emptyState" class="empty-state" style="display:none;">
    Aucun produit ne correspond à votre recherche.
  </p>

</div>

<!-- POPUP (confirmation suppression) -->
<div class="modal-overlay" id="modal">
  <div class="modal">
    <h3 id="modalTitle">Confirmer</h3>
    <p id="modalText"></p>
    <div class="modal-actions">
      <button class="btn-outline" type="button" id="modalCancel">Annuler</button>
      <button class="btn-danger" type="button" id="modalConfirm">Supprimer</button>
    </div>
  </div>
</div>

<script>
document.addEventListener("DOMContentLoaded", () => {
  const list        = document.getElementById("productsList");
  const modal       = document.getElementById("modal");
  const modalText   = document.getElementById("modalText");
  const modalConfirm= document.getElementById("modalConfirm");
  const modalCancel = document.getElementById("modalCancel");

  const searchInput  = document.getElementById("searchInput");
  const statusFilter = document.getElementById("statusFilter");
  const stockFilter  = document.getElementById("stockFilter");
  const countEl      = document.getElementById("count");
  const emptyState   = document.getElementById("emptyState");

  let rows = Array.from(document.querySelectorAll(".product-row"));
  let pendingDeleteRow = null;

  function openModal(message, onConfirm) {
    modalText.textContent = message;
    modal.style.display = "flex";
    modalConfirm.onclick = () => {
      modal.style.display = "none";
      onConfirm?.();
    };
  }

  function closeModal() {
    modal.style.display = "none";
    pendingDeleteRow = null;
  }

  modalCancel.addEventListener("click", closeModal);
  modal.addEventListener("click", (e) => { if (e.target === modal) closeModal(); });

  function updateStockState(row, value) {
    const hint = row.querySelector(".stock-hint");
    row.dataset.stock = String(value);

    row.classList.remove("stock-low", "stock-out");

    if (value === 0) {
      row.classList.add("stock-out");
      hint.textContent = "Rupture";
    } else if (value <= 5) {
      row.classList.add("stock-low");
      hint.textContent = "Stock faible";
    } else {
      hint.textContent = "OK";
    }
  }

  function applyFilters() {
    const q  = (searchInput.value || "").trim().toLowerCase();
    const st = statusFilter.value;
    const sf = stockFilter.value;

    let visible = 0;

    rows.forEach(row => {
      const title  = (row.dataset.title || "").toLowerCase();
      const cat    = (row.dataset.category || "").toLowerCase();
      const status = (row.dataset.status || "").toLowerCase();
      const stock  = parseInt(row.dataset.stock || "0", 10);

      const matchText   = !q || title.includes(q) || cat.includes(q) || status.includes(q);
      const matchStatus = (st === "all") || (status === st);

      let matchStock = true;
      if (sf === "low") matchStock = stock > 0 && stock <= 5;
      if (sf === "out") matchStock = stock === 0;

      const show = matchText && matchStatus && matchStock;
      row.style.display = show ? "" : "none";
      if (show) visible++;
    });

    countEl.textContent = `${visible} produit${visible > 1 ? "s" : ""}`;
    emptyState.style.display = visible === 0 ? "block" : "none";
  }

  // Click handlers (inc/dec + delete)
  list.addEventListener("click", (e) => {
    const row = e.target.closest(".product-row");
    if (!row) return;

    const btnStock = e.target.closest("button[data-action]");
    if (btnStock) {
      const input = row.querySelector(".stock-input");
      let v = parseInt(input.value || "0", 10);
      if (btnStock.dataset.action === "inc") v++;
      if (btnStock.dataset.action === "dec") v = Math.max(0, v - 1);
      input.value = v;
      updateStockState(row, v);
      applyFilters();
      return;
    }

    const delBtn = e.target.closest("button[data-delete]");
    if (delBtn) {
      pendingDeleteRow = row;
      const name = row.querySelector(".prod-title")?.textContent || "ce produit";
      openModal(`Voulez-vous vraiment supprimer "${name}" ?`, () => {
        pendingDeleteRow?.remove();
        rows = Array.from(document.querySelectorAll(".product-row")); // refresh
        applyFilters();
      });
      return;
    }
  });

  // Stock input manual
  list.addEventListener("input", (e) => {
    const input = e.target.closest(".stock-input");
    if (!input) return;
    const row = e.target.closest(".product-row");

    let v = parseInt(input.value || "0", 10);
    if (Number.isNaN(v) || v < 0) v = 0;
    input.value = v;

    updateStockState(row, v);
    applyFilters();
  });

  // Filters events
  searchInput.addEventListener("input", applyFilters);
  statusFilter.addEventListener("change", applyFilters);
  stockFilter.addEventListener("change", applyFilters);

  // init stock state
  rows.forEach(r => {
    const v = parseInt(r.dataset.stock || "0", 10);
    const input = r.querySelector(".stock-input");
    if (input) input.value = v;
    updateStockState(r, v);
  });

  applyFilters();
});
</script>

</body>
</html>
