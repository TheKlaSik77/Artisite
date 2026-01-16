
const searchInput = document.getElementById("searchInput");

const tbody = document.getElementById("table-content");


tbody.addEventListener("click", (e) => {
    const button = e.target.closest("button");
    if (!button) return;

    const productId = button.dataset.id;
    if (!productId) return;

    if (button.classList.contains("btn-delete")) {
        deleteProduct(productId);
    }
});

searchInput.addEventListener("input", () => {
    const searchTerm = searchInput.value.toLowerCase().trim();

    let filteredProducts;

    if (searchTerm === "") {
        filteredProducts = products;
    } else {
        filteredProducts = products.filter(
            product => 
                product.name.toLowerCase().includes(searchTerm) ||
                product.company_name.toLowerCase().includes(searchTerm)
        );
    }
    renderTable(filteredProducts);
});

function renderTable(data) {
    const tbody = document.getElementById("table-content");
    tbody.innerHTML = "";

    if (data.length === 0) {
        tbody.innerHTML = `
            <tr>
                <td colspan="5" style="text-align: center;">Aucun produit trouvé</td>
            </tr>
        `;
        return;
    }

    data.forEach(product => {
        tbody.innerHTML += `
            <tr>
                <td>${product.name}</td>
                <td>${product.company_name}</td>
                <td>${product.unit_price} €</td>
                <td>${product.quantity}</td>
                <td>
                    <button class="btn-small btn-delete" 
                    data-id="${product.product_id}">
                        Supprimer le produit
                    </button>
                </td>
            </tr>
        `;
    });
}

function deleteProduct(id) {
    if (!confirm("Êtes-vous sûr de vouloir supprimer ce produit ?")) {
        return;
    }

    fetch("index.php?page=admin-delete-product", {
        method: "POST",
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify({ product_id: id })
    })
    .then(res => res.json())
    .then(res => {
        if (res.success) {
            products = products.filter(p => p.product_id != id);
            renderTable(products);
        } else {
            alert("Erreur lors de la suppression du produit");
        }
    })
    .catch(error => {
        console.error("Erreur:", error);
        alert("Erreur lors de la suppression du produit");
    });
}
