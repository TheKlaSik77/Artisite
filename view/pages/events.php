<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Tous nos Evénements</title>
    <link rel="stylesheet" href="./assets/css/pages/events.css">
</head>

<body>
    <main>
        <section class="events-section">
            <div class="events-header">
                <h1 class="events-title">Événements à Venir</h1>
                <p class="events-subtitle">
                    Découvrez les événements artisanaux à venir près de chez vous.
                </p>
                <!-- ================== FILTRES ================== -->
                <div class="filter-card">

                    <div class="filter-header">
                        <div>
                            <h2 class="filter-title">Rechercher et filtrer</h2>
                            <p class="filter-subtitle">Affinez par nom d'évènement ou catégorie de métier.</p>
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
                                placeholder="Rechercher un évènement..." />
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