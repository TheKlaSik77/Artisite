<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Profil – Arti'Site</title>
  <link rel="stylesheet" href="./assets/css/pages/profil.css" />
</head>

<body>
<main>
  <section class="profile-container">
    <div class="profile-card">
      <div class="profile-photo">
        <img src="https://picsum.photos/300/300" alt="Photo de profil" />
        <button class="change-photo-btn">Changer la photo</button>
      </div>

      <h2 class="profile-name"><?= htmlspecialchars($viewData['name']) ?></h2>
      <p class="profile-email"><?= htmlspecialchars($viewData['email']) ?></p>

      <div class="profile-info">
        <div class="info-block">
          <span class="label">Téléphone :</span>
          <span class="value"><?= htmlspecialchars($viewData['phone'] ?: '—') ?></span>
        </div>

        <div class="info-block">
          <span class="label">Adresse / Statut :</span>
          <span class="value"><?= htmlspecialchars($viewData['extra1']) ?></span>
        </div>

        <div class="info-block">
          <span class="label">Type de compte :</span>
          <span class="value"><?= htmlspecialchars($viewData['extra2']) ?></span>
        </div>
      </div>

      <div class="profile-actions">
        <button class="btn-primary">Modifier le profil</button>
        <button class="btn-secondary">Changer le mot de passe</button>
        <button class="btn-danger">Supprimer mon compte</button>
      </div>
    </div>
  </section>
</main>
</body>
</html>
