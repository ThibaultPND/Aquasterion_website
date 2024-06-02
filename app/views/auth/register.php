<h2>Créer un compte de gestionnaire</h2>
<?php if (!empty($data['message'])): ?>
    <p style="color: red;"><?= $data['message'] ?></p>
<?php endif; ?>
<form action="<?= BASE_URL ?>auth/register" method="post">
    <input type="text" name="username" placeholder="Nom d'utilisateur" required><br>
    <input type="email" name="email" placeholder="Email" required><br>
    <input type="password" name="password" placeholder="Mot de passe" required><br>
    <button type="submit">S'inscrire</button>
</form>
