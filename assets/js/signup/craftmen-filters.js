document.addEventListener("DOMContentLoaded", () => {
    const searchInput = document.getElementById("productSearch");
    const categoryButtons = document.querySelectorAll("#categoryChips .chip");
    const cards = document.querySelectorAll(".craftman-card");

    let activeCategory = "tous";

    function filter() {
        const search = searchInput.value.toLowerCase();

        cards.forEach(card => {
            const name = card.dataset.name;
            const category = card.dataset.category;

            const matchSearch = name.includes(search);
            const matchCategory =
                activeCategory === "tous" || category === activeCategory;

            card.style.display = (matchSearch && matchCategory)
                ? "block"
                : "none";
        });
    }

    searchInput.addEventListener("input", filter);

    categoryButtons.forEach(btn => {
        btn.addEventListener("click", () => {
            categoryButtons.forEach(b => b.classList.remove("chip-active"));
            btn.classList.add("chip-active");

            activeCategory = btn.dataset.category.toLowerCase();
            filter();
        });
    });
});
