<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Artisan – Ajouter un produit</title>
  <link rel="stylesheet" href="./assets/css/pages/add-product-craftman.css">
</head>
<body>

<div class="container">

  <header class="header">
    <h1>Ajouter un nouveau produit</h1>
    <a class="btn-outline" href="javascript:history.back()">← Retour</a>
  </header>

  <form class="form" id="productForm" enctype="multipart/form-data">

    <!-- Infos principales -->
    <div class="field">
      <label for="title">Nom du produit</label>
      <input id="title" name="title" type="text" placeholder="Ex : Bol en céramique" required>
    </div>

    <div class="row">
      <div class="field">
        <label for="price">Prix (€)</label>
        <input id="price" name="price" type="number" step="0.01" min="0.01" required>
      </div>
      <div class="field">
        <label for="stock">Stock</label>
        <input id="stock" name="stock" type="number" min="0" required>
      </div>
    </div>

    <div class="row">
      <div class="field">
        <label for="category">Catégorie</label>
        <select id="category" name="category" required>
          <option value="" disabled selected>— Choisissez une catégorie —</option>
          <option value="Poterie">Poterie</option>
          <option value="Décoration">Décoration</option>
          <option value="Vêtements">Vêtements</option>
          <option value="Accessoires">Accessoires</option>
        </select>
      </div>

      <!--  Ajout : Matière (comme sur page produit) -->
      <div class="field">
        <label for="material">Matière</label>
        <input id="material" name="material" type="text" placeholder="Ex : Céramique émaillée" required>
      </div>
    </div>

    <div class="field">
      <label for="description">Description</label>
      <textarea id="description" name="description" rows="5" placeholder="Décris ton produit..." required></textarea>
    </div>

    <!--  Caractéristiques (affichées dans le tableau de la page produit) -->
    <div class="field">
      <label>Caractéristiques (page produit)</label>

      <div class="row">
        <div class="field">
          <label for="diameter">Diamètre (cm)</label>
          <input id="diameter" name="diameter" type="number" step="0.1" min="0" placeholder="Ex : 14">
        </div>
        <div class="field">
          <label for="height">Hauteur (cm)</label>
          <input id="height" name="height" type="number" step="0.1" min="0" placeholder="Ex : 7">
        </div>
      </div>

      <div class="row">
        <div class="field">
          <label for="color">Couleur</label>
          <input id="color" name="color" type="text" placeholder="Ex : Blanc cassé / Beige">
        </div>
        <div class="field">
          <label for="fabrication">Fabrication</label>
          <input id="fabrication" name="fabrication" type="text" placeholder="Ex : Pièce faite main, légère variation possible">
        </div>
      </div>
    </div>

    <!-- Images -->
    <div class="field">
      <label for="images">Images (3 à 6)</label>
      <input id="images" name="images[]" type="file" multiple accept="image/jpeg,image/png,image/webp" required>
      <div id="preview" class="preview"></div>
    </div>

    <div class="actions">
      <button type="submit" class="btn-primary">Envoyer</button>
    </div>

  </form>
</div>

<!-- POPUP -->
<div class="modal-overlay" id="modal">
  <div class="modal">
    <h3>Information</h3>
    <p id="modalText"></p>
    <button type="button" id="modalOk">OK</button>
  </div>
</div>

<script>
document.addEventListener("DOMContentLoaded", () => {
  const form = document.getElementById("productForm");
  const imagesInput = document.getElementById("images");
  const preview = document.getElementById("preview");
  const modal = document.getElementById("modal");
  const modalText = document.getElementById("modalText");
  const modalOk = document.getElementById("modalOk");

  const MIN_IMAGES = 3;
  const MAX_IMAGES = 6;

  function openModal(message) {
    modalText.textContent = message;
    modal.style.display = "flex";
  }
  function closeModal() {
    modal.style.display = "none";
  }
  modalOk?.addEventListener("click", closeModal);
  modal?.addEventListener("click", (e) => { if (e.target === modal) closeModal(); });

  // Preview images
  imagesInput?.addEventListener("change", () => {
    preview.innerHTML = "";
    Array.from(imagesInput.files).forEach(file => {
      const img = document.createElement("img");
      img.src = URL.createObjectURL(file);
      preview.appendChild(img);
    });
  });

  form?.addEventListener("submit", (e) => {
    e.preventDefault();

    const title = document.getElementById("title").value.trim();
    const price = document.getElementById("price").value.trim();
    const stock = document.getElementById("stock").value.trim();
    const category = document.getElementById("category").value;
    const material = document.getElementById("material").value.trim();
    const description = document.getElementById("description").value.trim();

    //  Taille optionnelle (si les champs existent)
    const diameterEl = document.getElementById("diameter");
    const heightEl   = document.getElementById("height");

    const diameterRaw = diameterEl ? diameterEl.value.trim() : "";
    const heightRaw   = heightEl ? heightEl.value.trim() : "";

    const diameter = diameterRaw === "" ? null : Number(diameterRaw);
    const height   = heightRaw === "" ? null : Number(heightRaw);

    const imagesCount = imagesInput.files.length;

    // Obligatoires
    if (!title || !price || !stock || !category || !material || !description) {
      openModal("Veuillez compléter tous les champs obligatoires.");
      return;
    }

    // Images
    if (imagesCount < MIN_IMAGES || imagesCount > MAX_IMAGES) {
      openModal("Veuillez ajouter entre 3 et 6 images.");
      return;
    }

    // ✅ Si renseigné, diamètre/hauteur doivent être valides (>0)
    if (diameter !== null && (!Number.isFinite(diameter) || diameter <= 0)) {
      openModal("Diamètre invalide (laisse vide ou mets un nombre > 0).");
      return;
    }
    if (height !== null && (!Number.isFinite(height) || height <= 0)) {
      openModal("Hauteur invalide (laisse vide ou mets un nombre > 0).");
      return;
    }

    // Tu peux envoyer diameter/height même si null (optionnel)
    openModal(" Formulaire valide. Taille optionnelle OK. Prêt à être envoyé (PHP + base).");
  });
});
</script>


</body>
</html>
