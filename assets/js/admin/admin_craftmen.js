
const select = document.getElementById("statusFilter");

const tbody = document.getElementById("table-content");

tbody.addEventListener("click", (e) => {
    const button = e.target.closest("button");
    if (!button) return;

    const craftmanId = button.dataset.id;
    if (!craftmanId) return;

    if (button.classList.contains("btn-delete")) {
        deleteCraftman(craftmanId);
    }

    if (button.classList.contains("btn-validate")) {
        validateCraftman(craftmanId);
    }
});

select.addEventListener("change", () => {
    const status = select.value;

    let filteredCraftmen;

    if (status === "") {
        filteredCraftmen = craftmen;
    }
    else if (status === "validated") {
        filteredCraftmen = craftmen.filter(
            craftman => craftman.validator_id !== null
        );
    }
    else if (status === "pending") {
        filteredCraftmen = craftmen.filter(
            craftman => craftman.validator_id === null
        );
    }
    renderTable(filteredCraftmen);
});

function renderTable(data) {
    const tbody = document.getElementById("table-content");
    tbody.innerHTML = "";

    data.forEach(craftman => {
        if (craftman.validator_email == null) {
            tbody.innerHTML += `
            <tr>
                <td>${craftman.company_name}</td>
                <td>${craftman.email}</td>
                <td>${craftman.validator_email}</td>
                <td class="btn-div-table">
                    <button 
                    class="btn-small btn-validate" 
                    data-id="${craftman.craftman_id}">
                        Valider la demande
                    </button>
                    <button class="btn-small btn-delete" 
                    data-id="${craftman.craftman_id}">
                        Supprimer le compte
                    </button>
                </td>
            </tr>
        `;
        } else {
            tbody.innerHTML += `
            <tr>
                <td>${craftman.company_name}</td>
                <td>${craftman.email}</td>
                <td>${craftman.validator_email}</td>
                <td>
                    <button class="btn-small btn-delete" 
                    data-id="${craftman.craftman_id}">
                        Supprimer le compte
                    </button>
                </td>
            </tr>
        `;
        }

    });
}

function deleteCraftman(id) {
    fetch("index.php?page=admin-delete-craftman", {
        method: "POST",
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify({ craftman_id: id })
    })
    .then(res => res.json())
    .then(res => {
        if (res.success) {
            craftmen = craftmen.filter(c => c.craftman_id != id);
            renderTable(craftmen);
        }
    });
}

function validateCraftman(id) {
    fetch("index.php?page=admin-validate-craftman", {
        method: "POST",
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify({ craftman_id: id })
    })
    .then(async (res) => {
        const text = await res.text();          // <- lire brut
        console.log("HTTP", res.status, text);  // <- voir ce que renvoie PHP
        return JSON.parse(text);                // <- parser ensuite
    })
    .then(data => {
        console.log("JSON:", data);
        if (data.success) window.location.reload();
        else alert("Erreur lors de la validation");
    })
    .catch(err => {
        console.error(err);
        alert("Erreur serveur");
    });
}
