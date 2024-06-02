<h2>Connexion</h2>
<?php if (!empty($data['message'])): ?>
    <p style="color: red;"><?= $data['message'] ?></p>
<?php endif; ?>

<form action="<?= BASE_URL ?>auth/login" method="post">
    <input type="text" name="username" placeholder="Nom d'utilisateur" required><br>
    <input type="password" name="password" placeholder="Mot de passe" required><br>
    <button type="submit">Se connecter</button>
</form>
