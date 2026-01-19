document.addEventListener("DOMContentLoaded", () => {
    const searchInput = document.querySelector('.filter-input');
    const categoryChips = document.querySelectorAll('#categoryChips .chip');
    const sortChips = document.querySelectorAll('#sortChips .chip');
    const productCards = document.querySelectorAll('.product-card');

    let activeCategory = 'Tous';
    let activeSort = 'newest';

    function filterAndSort() {
        const search = searchInput.value.toLowerCase();

        // Récupérer tous les produits visibles avec leurs données
        const visibleProducts = Array.from(productCards).map(card => {
            const name = card.querySelector('.product-name').textContent.toLowerCase();
            const artisan = card.querySelector('.product-artisan').textContent.toLowerCase();
            const category = card.dataset.category || 'Tous';
            const price = parseFloat(card.dataset.price || 0);
            const id = parseInt(card.dataset.id || 0);

            const matchSearch = name.includes(search) || artisan.includes(search);
            const matchCategory = activeCategory === 'Tous' || category === activeCategory;

            return {
                card: card,
                visible: matchSearch && matchCategory,
                price: price,
                id: id
            };
        });

        // Trier les produits
        visibleProducts.sort((a, b) => {
            if (!a.visible && !b.visible) return 0;
            if (!a.visible) return 1;
            if (!b.visible) return -1;

            switch (activeSort) {
                case 'price_asc':
                    return a.price - b.price;
                case 'price_desc':
                    return b.price - a.price;
                case 'newest':
                default:
                    return b.id - a.id;
            }
        });

        // Appliquer la visibilité et réorganiser
        const container = document.querySelector('.products-grid');
        if (container) {
            visibleProducts.forEach(item => {
                item.card.style.display = item.visible ? 'block' : 'none';
                container.appendChild(item.card);
            });
        }

        // Afficher message si aucun résultat
        const noResults = document.querySelector('.no-results');
        const hasVisible = visibleProducts.some(item => item.visible);
        
        if (noResults) {
            noResults.style.display = hasVisible ? 'none' : 'block';
        }
    }

    // Event listener pour la recherche
    if (searchInput) {
        searchInput.addEventListener('input', filterAndSort);
    }

    // Event listeners pour les catégories
    categoryChips.forEach(btn => {
        btn.addEventListener('click', (e) => {
            e.preventDefault();
            categoryChips.forEach(c => c.classList.remove('chip-active'));
            btn.classList.add('chip-active');
            activeCategory = btn.dataset.value;
            filterAndSort();
        });
    });

    // Event listeners pour le tri
    sortChips.forEach(btn => {
        btn.addEventListener('click', (e) => {
            e.preventDefault();
            sortChips.forEach(c => c.classList.remove('chip-active'));
            btn.classList.add('chip-active');
            activeSort = btn.dataset.value;
            filterAndSort();
        });
    });
});
