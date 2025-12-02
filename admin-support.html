<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Admin – Support</title>
    <link rel="stylesheet" href="admin-support.css">
</head>
<body>
<div class="admin-layout">
    <aside class="sidebar">
        <div class="sidebar-logo">
            <span>Artisite</span><small>Admin</small>
        </div>
        <nav class="sidebar-nav">
            <a href="admin-dashboard.html" class="nav-item">Dashboard</a>
            <a href="admin-artisans.html" class="nav-item">Artisans</a>
            <a href="admin-clients.html" class="nav-item">Clients</a>
            <a href="admin-produits.html" class="nav-item">Produits</a>
            <a href="admin-commandes.html" class="nav-item">Commandes</a>
            <a href="admin-avis.html" class="nav-item">Avis</a>
            <a href="admin-support.html" class="nav-item active">Support</a>
        </nav>
    </aside>

    <main class="main">
        <header class="main-header">
            <button id="toggleSidebar" class="btn-icon">☰</button>
            <div class="header-right">
                <span class="admin-name">Admin</span>
                <button class="btn-small-outline">Se déconnecter</button>
            </div>
        </header>

        <section class="main-content">
            <h1 class="page-title">Support</h1>

            <div class="support-layout">
                <div class="support-list">
                    <div class="table-header">
                        <h2>Messages reçus</h2>
                        <select id="filterSupport">
                            <option value="all">Tous</option>
                            <option value="nouveau">Nouveau</option>
                            <option value="en_cours">En cours</option>
                            <option value="resolu">Résolu</option>
                        </select>
                    </div>

                    <ul id="supportItems" class="support-items">
                        <li class="support-item active" data-statut="nouveau">
                            <h3>Problème de commande #1024</h3>
                            <p>De : camille@example.com</p>
                            <small>Statut : Nouveau</small>
                        </li>
                        <li class="support-item" data-statut="en_cours">
                            <h3>Question sur un artisan</h3>
                            <p>De : julien@example.com</p>
                            <small>Statut : En cours</small>
                        </li>
                        <li class="support-item" data-statut="resolu">
                            <h3>Suggestion pour le site</h3>
                            <p>De : anna@example.com</p>
                            <small>Statut : Résolu</small>
                        </li>
                    </ul>
                </div>

                <div class="support-detail">
                    <h2 id="supportTitle">Problème de commande #1024</h2>
                    <p id="supportEmail"><strong>De :</strong> camille@example.com</p>
                    <p id="supportBody">
                        Bonjour, je n’ai pas encore reçu ma commande #1024 alors que la date estimée était dépassée.
                        Pouvez-vous vérifier le suivi ?
                    </p>

                    <div class="support-actions">
                        <label for="supportStatus">Statut :</label>
                        <select id="supportStatus">
                            <option value="nouveau">Nouveau</option>
                            <option value="en_cours" selected>En cours</option>
                            <option value="resolu">Résolu</option>
                        </select>
                        <button class="btn-small-outline" id="saveSupport">Enregistrer</button>
                    </div>
                    <p id="supportFeedback" style="font-size:0.85rem; color:var(--text-soft); margin-top:6px;"></p>
                </div>
            </div>
        </section>
    </main>
</div>

<script>
    document.getElementById("toggleSidebar").addEventListener("click", () => {
        document.querySelector(".sidebar").classList.toggle("sidebar-open");
    });

    const supportItems = document.querySelectorAll(".support-item");
    const filterSupport = document.getElementById("filterSupport");

    const detailTitle = document.getElementById("supportTitle");
    const detailEmail = document.getElementById("supportEmail");
    const detailBody = document.getElementById("supportBody");
    const supportStatus = document.getElementById("supportStatus");
    const supportFeedback = document.getElementById("supportFeedback");

    const messages = [
        {
            id: 0,
            titre: "Problème de commande #1024",
            email: "camille@example.com",
            body: "Bonjour, je n’ai pas encore reçu ma commande #1024 alors que la date estimée était dépassée.\nPouvez-vous vérifier le suivi ?",
            statut: "en_cours"
        },
        {
            id: 1,
            titre: "Question sur un artisan",
            email: "julien@example.com",
            body: "Bonjour, je souhaiterais savoir si l’artisan Atelier des Bois livre en Belgique ?",
            statut: "en_cours"
        },
        {
            id: 2,
            titre: "Suggestion pour le site",
            email: "anna@example.com",
            body: "Bonjour, ce serait super de pouvoir enregistrer plusieurs adresses de livraison.",
            statut: "resolu"
        }
    ];

    let currentMessageId = 0;

    supportItems.forEach((item, index) => {
        item.addEventListener("click", () => {
            supportItems.forEach(i => i.classList.remove("active"));
            item.classList.add("active");

            const msg = messages[index];
            currentMessageId = index;

            detailTitle.textContent = msg.titre;
            detailEmail.innerHTML = "<strong>De :</strong> " + msg.email;
            detailBody.textContent = msg.body;
            supportStatus.value = msg.statut;
            supportFeedback.textContent = "";
        });
    });

    filterSupport.addEventListener("change", () => {
        const value = filterSupport.value;
        supportItems.forEach((item, index) => {
            const msg = messages[index];
            if (value === "all" || msg.statut === value) {
                item.style.display = "";
            } else {
                item.style.display = "none";
            }
        });
    });

    document.getElementById("saveSupport").addEventListener("click", () => {
        const newStatus = supportStatus.value;
        messages[currentMessageId].statut = newStatus;
        supportFeedback.textContent = "Statut mis à jour (simulation) : " + newStatus;
        filterSupport.dispatchEvent(new Event("change")); // pour raffraîchir la liste
    });
</script>
</body>
</html>
