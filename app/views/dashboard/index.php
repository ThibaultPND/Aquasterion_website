<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tableau de bord</title>
</head>
<body>
    <h1>Bienvenue sur le tableau de bord</h1>
    <p>Bonjour, <?= $_SESSION['username']; ?>!</p>
    <p>Votre email est <?= $_SESSION['email']; ?>.</p>
    <a href="<?= BASE_URL ?>auth/logout">Se déconnecter</a>
</body>
</html>
