<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Nos Produits – Marketplace Artisans</title>
    <link rel="stylesheet" href="./assets/css/pages/products.css">
</head>
<body>
    <section class="products-section">
        <h1 class="products-title">Nos Produits Artisanaux</h1>
        <p class="products-subtitle">
            Découvrez des pièces uniques créées par nos artisans.
        </p>

        <!-- ================== FILTRES ================== -->
        <div class="filter-card">

            <div class="filter-header">
                <div class="filter-icon">⭮</div>
                <div>
                    <h2 class="filter-title">Rechercher et filtrer</h2>
                    <p class="filter-subtitle">Affinez par produit, artisan, catégorie ou matière.</p>
                </div>
            </div>

            <!-- Recherche texte -->
            <div class="filter-row">
                <div class="filter-input-wrapper">
                    <span class="filter-input-icon">🔍</span>
                    <input
                        type="text"
                        id="productSearch"
                        class="filter-input"
                        placeholder="Rechercher par produit ou artisan..."
                    />
                </div>
            </div>

            <!-- Catégorie -->
            <div class="filter-row">
                <p class="filter-label">Catégorie :</p>
                <div class="chip-group" id="categoryChips">
                    <button class="chip chip-active" data-category="Tous">Tous</button>
                    <button class="chip" data-category="Poterie">Poterie</button>
                    <button class="chip" data-category="Vêtements">Vêtements</button>
                    <button class="chip" data-category="Décoration">Décoration</button>
                    <button class="chip" data-category="Accessoires">Accessoires</button>
                    <button class="chip" data-category="Autre">Autre</button>
                </div>
            </div>

            <!-- Matière -->
            <div class="filter-row">
                <p class="filter-label">Matière :</p>
                <div class="chip-group" id="materialChips">
                    <button class="chip chip-active" data-material="Tous">Tous</button>
                    <button class="chip" data-material="Céramique">Céramique</button>
                    <button class="chip" data-material="Bois">Bois</button>
                    <button class="chip" data-material="Cuir">Cuir</button>
                    <button class="chip" data-material="Textile">Textile</button>
                    <button class="chip" data-material="Métal">Métal</button>
                    <button class="chip" data-material="Verre">Verre</button>
                    <button class="chip" data-material="Papier">Papier</button>
                    <button class="chip" data-material="Autre">Autre</button>
                </div>
            </div>
        </div>

        <!-- ================== GRILLE PRODUITS ================== -->
        <div id="productsGrid" class="products-grid"></div>

        <!-- Message aucun résultat -->
        <p id="noResults" class="no-results" style="display:none;">
            Aucun produit ne correspond à vos filtres.
        </p>

        <!-- Pagination -->
        <div class="pagination">
            <button id="prevPage" class="pagination-btn" disabled>‹ Précédent</button>
            <span id="pageIndicator"></span>
            <button id="nextPage" class="pagination-btn">Suivant ›</button>
        </div>
    </section>

    <!-- ================== JS PRODUITS + FILTRES ================== -->
    <script>
        // ----------- DONNÉES PRODUITS (exemple) -----------
        const produits = [
            {
                id: 1,
                nom: "Bol en céramique",
                artisan: "Sophie Martin",
                prix: "29€",
                image: "./assets/img/products/2.jpg",
                categorie: "Poterie",
                matiere: "Céramique"
            },
            {
                id: 2,
                nom: "Planche en bois massif",
                artisan: "Thomas Dubois",
                prix: "45€",
                image: "./assets/img/products/2.jpg",
                categorie: "Décoration",
                matiere: "Bois"
            },
            {
                id: 3,
                nom: "Porte-cartes en cuir",
                artisan: "Marie Leroux",
                prix: "39€",
                image: "./assets/img/products/3.jpg",
                categorie: "Accessoires",
                matiere: "Cuir"
            },
            {
                id: 4,
                nom: "Tasse artisanale",
                artisan: "Sophie Martin",
                prix: "25€",
                image: "./assets/img/products/4.jpg",
                categorie: "Poterie",
                matiere: "Céramique"
            },
            {
                id: 5,
                nom: "Tablette murale",
                artisan: "Thomas Dubois",
                prix: "79€",
                image: "./assets/img/products/5.jpg",
                categorie: "Décoration",
                matiere: "Bois"
            },
            {
                id: 6,
                nom: "Portefeuille en cuir",
                artisan: "Marie Leroux",
                prix: "59€",
                image: "./assets/img/products/6.jpg",
                categorie: "Accessoires",
                matiere: "Cuir"
            },
            {
                id: 7,
                nom: "Vase en grès",
                artisan: "Sophie Martin",
                prix: "42€",
                image: "./assets/img/products/7.jpg",
                categorie: "Poterie",
                matiere: "Céramique"
            },
            {
                id: 8,
                nom: "Boîte sculptée",
                artisan: "Thomas Dubois",
                prix: "65€",
                image: "./assets/img/products/8.jpg",
                categorie: "Décoration",
                matiere: "Bois"
            },
            {
                id: 9,
                nom: "Ceinture en cuir",
                artisan: "Marie Leroux",
                prix: "70€",
                image: "./assets/img/products/9.jpg",
                categorie: "Vêtements",
                matiere: "Cuir"
            },
            {
                id: 10,
                nom: "Assiette décorative",
                artisan: "Sophie Martin",
                prix: "34€",
                image: "./assets/img/products/10.jpg",
                categorie: "Poterie",
                matiere: "Céramique"
            },
            {
                id: 11,
                nom: "Étagère minimaliste",
                artisan: "Thomas Dubois",
                prix: "89€",
                image: "./assets/img/products/11.jpg",
                categorie: "Décoration",
                matiere: "Bois"
            },
            {
                id: 12,
                nom: "Étui à lunettes en cuir",
                artisan: "Marie Leroux",
                prix: "49€",
                image: "./assets/img/products/12.jpg",
                categorie: "Accessoires",
                matiere: "Cuir"
            }
        ];
        
        const PER_PAGE = 9;
        let currentPage = 1;
        let searchTerm = "";
        let selectedCategory = "Tous";
        let selectedMaterial = "Tous";

        const grid          = document.getElementById("productsGrid");
        const prevBtn       = document.getElementById("prevPage");
        const nextBtn       = document.getElementById("nextPage");
        const pageIndicator = document.getElementById("pageIndicator");
        const noResults     = document.getElementById("noResults");
        const searchInput   = document.getElementById("productSearch");

        // ----------- FILTRAGE -----------
        function getFilteredProducts() {
            return produits.filter((p) => {
                const text = (p.nom + " " + p.artisan).toLowerCase();
                const matchText = text.includes(searchTerm.toLowerCase());

                const matchCategory =
                    selectedCategory === "Tous" ||
                    p.categorie === selectedCategory;

                const matchMaterial =
                    selectedMaterial === "Tous" ||
                    p.matiere === selectedMaterial;

                return matchText && matchCategory && matchMaterial;
            });
        }

        // ----------- AFFICHAGE PRODUITS -----------
        function afficherProduits() {
            const filtered = getFilteredProducts();
            const totalPages = Math.max(1, Math.ceil(filtered.length / PER_PAGE));

            if (currentPage > totalPages) currentPage = totalPages;

            grid.innerHTML = "";

            if (filtered.length === 0) {
                noResults.style.display = "block";
                pageIndicator.textContent = "";
                prevBtn.disabled = true;
                nextBtn.disabled = true;
                return;
            } else {
                noResults.style.display = "none";
            }

            const start = (currentPage - 1) * PER_PAGE;
            const end   = start + PER_PAGE;
            const pageItems = filtered.slice(start, end);

            pageItems.forEach((prod, index) => {
                const card = document.createElement("div");
                card.className = "product-card product-appear";

                // petit décalage d’animation pour chaque carte
                card.style.animationDelay = (index * 0.03) + "s";

                card.innerHTML = `
                    <img src="${prod.image}" class="product-img" alt="${prod.nom}">
                    <div class="product-info">
                        <h3 class="product-name">${prod.nom}</h3>
                        <p class="product-artisan">${prod.artisan}</p>
                        <p class="product-price">${prod.prix}</p>
                        <a href="produit-${prod.id}.html" class="product-btn">Acheter</a>
                    </div>
                `;

                grid.appendChild(card);
            });

            prevBtn.disabled = currentPage === 1;
            nextBtn.disabled = currentPage === totalPages;
            pageIndicator.textContent = `Page ${currentPage} / ${totalPages}`;
        }

        // ----------- LISTENERS -----------

        // Recherche texte
        searchInput.addEventListener("input", () => {
            searchTerm = searchInput.value.trim();
            currentPage = 1;
            afficherProduits();
        });

        // Catégories (chips)
        document.getElementById("categoryChips").addEventListener("click", (e) => {
            if (e.target.classList.contains("chip")) {
                document
                    .querySelectorAll("#categoryChips .chip")
                    .forEach(chip => chip.classList.remove("chip-active"));

                e.target.classList.add("chip-active");
                selectedCategory = e.target.dataset.category;
                currentPage = 1;
                afficherProduits();
            }
        });

        // Matières (chips)
        document.getElementById("materialChips").addEventListener("click", (e) => {
            if (e.target.classList.contains("chip")) {
                document
                    .querySelectorAll("#materialChips .chip")
                    .forEach(chip => chip.classList.remove("chip-active"));

                e.target.classList.add("chip-active");
                selectedMaterial = e.target.dataset.material;
                currentPage = 1;
                afficherProduits();
            }
        });

        // Pagination
        prevBtn.addEventListener("click", () => {
            if (currentPage > 1) {
                currentPage--;
                afficherProduits();
            }
        });

        nextBtn.addEventListener("click", () => {
            currentPage++;
            afficherProduits();
        });

        // Premier affichage
        afficherProduits();
    </script>
</body>
</html>
