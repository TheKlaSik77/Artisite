
const select = document.getElementById("statusFilter");

const tbody = document.getElementById("table-content");


tbody.addEventListener("click", (e) => {
    const button = e.target.closest("button");
    if (!button) return;

    const customerId = button.dataset.id;
    if (!customerId) return;

    if (button.classList.contains("btn-delete")) {
        deleteCustomer(customerId);
    }
});

function renderTable(data) {
    const tbody = document.getElementById("table-content");
    tbody.innerHTML = "";

    data.forEach(customer => {
            tbody.innerHTML += `
            <tr>
                <td>${customer.username}</td>
                <td>${customer.email}</td>
                <td>${customer.phone_number}</td>
                <td>
                    <button class="btn-small btn-delete" 
                    data-id="${customer.user_id}">
                        Supprimer le compte
                    </button>
                </td>
            </tr>
        `;
    });
}

function deleteCustomer(id) {
    fetch("index.php?page=admin-delete-customer", {
        method: "POST",
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify({ customer_id: id })
    })
    .then(res => res.json())
    .then(res => {
        if (res.success) {
            customers = customers.filter(c => c.user_id != id);
            renderTable(customers);
        }
    });

}