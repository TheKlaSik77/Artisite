
const select = document.getElementById("statusFilter");

const tbody = document.getElementById("table-content");

tbody.addEventListener("click", (e) => {
    const button = e.target.closest("button");
    if (!button) return;

    const orderId = button.dataset.id;
    if (!orderId) return;

    if (button.classList.contains("btn-view")) {
        viewOrderDetails(orderId);
    }
});

select.addEventListener("change", () => {
    const status = select.value;

    let filteredOrders;

    if (status === "") {
        filteredOrders = orders;
    } else {
        filteredOrders = orders.filter(
            order => order.status === status
        );
    }
    renderTable(filteredOrders);
});

function renderTable(data) {
    const tbody = document.getElementById("table-content");
    tbody.innerHTML = "";

    if (data.length === 0) {
        tbody.innerHTML = `
            <tr>
                <td colspan="6" style="text-align: center;">Aucune commande trouvée</td>
            </tr>
        `;
        return;
    }

    data.forEach(order => {
        const statusText = {
            'confirmed': 'Confirmée',
            'shipped': 'Expédiée',
            'delivered': 'Livrée',
            'cancelled': 'Annulée'
        }[order.status] || order.status;

        const orderDate = new Date(order.order_date).toLocaleDateString('fr-FR');

        tbody.innerHTML += `
            <tr>
                <td>#${order.order_id}</td>
                <td>${order.username}</td>
                <td>${orderDate}</td>
                <td>${parseFloat(order.order_cost).toFixed(2)} €</td>
                <td>${statusText}</td>
                <td>
                    <button class="btn-small btn-view" 
                    data-id="${order.order_id}">
                        Voir le contenu
                    </button>
                </td>
            </tr>
        `;
    });
}

function viewOrderDetails(id) {
    fetch("index.php?page=admin-order-details&order_id=" + id)
    .then(res => res.json())
    .then(data => {
        if (data.success) {
            showOrderModal(data.order, data.products);
        } else {
            alert("Erreur lors du chargement des détails de la commande");
        }
    })
    .catch(error => {
        console.error("Erreur:", error);
        alert("Erreur lors du chargement des détails de la commande");
    });
}

function showOrderModal(order, products) {
    const modal = document.createElement('div');
    modal.className = 'modal-overlay';
    
    let productsHtml = '';
    let total = 0;
    
    products.forEach(product => {
        const subtotal = parseFloat(product.unit_price) * parseInt(product.quantity);
        total += subtotal;
        productsHtml += `
            <tr>
                <td>${product.name}</td>
                <td>${product.quantity}</td>
                <td>${parseFloat(product.unit_price).toFixed(2)} €</td>
                <td>${subtotal.toFixed(2)} €</td>
            </tr>
        `;
    });
    
    modal.innerHTML = `
        <div class="modal-content">
            <div class="modal-header">
                <h2>Détails de la commande #${order.order_id}</h2>
                <button class="modal-close">&times;</button>
            </div>
            <div class="modal-body">
                <p><strong>Client :</strong> ${order.username}</p>
                <p><strong>Date :</strong> ${new Date(order.order_date).toLocaleDateString('fr-FR')}</p>
                <p><strong>Statut :</strong> ${order.status}</p>
                
                <h3>Produits commandés</h3>
                <table class="modal-table">
                    <thead>
                        <tr>
                            <th>Produit</th>
                            <th>Quantité</th>
                            <th>Prix unitaire</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        ${productsHtml}
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="3"><strong>Total de la commande</strong></td>
                            <td><strong>${total.toFixed(2)} €</strong></td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    `;
    
    document.body.appendChild(modal);
    
    modal.querySelector('.modal-close').addEventListener('click', () => {
        modal.remove();
    });
    
    modal.addEventListener('click', (e) => {
        if (e.target === modal) {
            modal.remove();
        }
    });
}
