<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mon Site MVC</title>
    <link rel="stylesheet" href="<?= BASE_URL ?>css/main.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
</head>

<body>
    <div class="container">
        <header>
            <nav>
                <ul>
                    <li><a href="<?= BASE_URL ?>">Home</a></li>
                    <?php if (isLoggedIn()): ?>
                        <li class="dropdown">
                            <a href="javascript:void(0)" class="dropbtn" onclick="toggleDropdown()">Pompes</a>
                            <div class="dropdown-content">
                                <a href="<?= BASE_URL ?>pump/add_del">Ajouter/Supprimer</a>
                                <a href="<?= BASE_URL ?>pump/mode">Mode</a>
                                <a href="<?= BASE_URL ?>pump/limites">Seuils</a>
                            </div>
                        </li>
                        <li class="dropdown">
                            <a href="javascript:void(0)" class="dropbtn">Utilisateurs</a>
                            <div class="dropdown-content">
                                <a href="<?= BASE_URL ?>auth/register">Crée un compte</a>
                                <a href="<?= BASE_URL ?>auth/profile">Mon compte</a>
                                <a href="<?= BASE_URL ?>auth/logout" class="logout-button">Déconnexion <img
                                        src="<?= BASE_URL ?>assets/logout.png" class="logout-icon" alt="Déconnexion"></a>
                            </div>
                        </li>
                    <?php else: ?>
                        <li><a href="<?= BASE_URL ?>auth/login">Login</a></li>
                    <?php endif; ?>
                </ul>
            </nav>
        </header>
        <main>
            <?php include $content; ?>
        </main>
    </div>
    <footer class="site-footer">
        <div class="footer-content">
            <div class="site-footer-1">
                <figure>
                    <img src="<?= BASE_URL ?>assets/logo/aquasterion.png" alt="Logo_Aquasterion">
                </figure>
                <div class="footer-section links">
                    <a href="https://tiktok.com"><img src="<?= BASE_URL ?>assets/logo/tiktok.png" alt="TikTok"></a>
                    <a href="https://www.instagram.com/asterion_le_bon/"><img
                            src="<?= BASE_URL ?>assets/logo/instagram.png" alt="Instagram"></a>
                    <a href="https://x.com/aubolangi/"><img src="<?= BASE_URL ?>assets/logo/twitter.png"
                            alt="Twitter"></a>
                    <a href="https://www.youtube.com/@OlivierTrading"><img src="<?= BASE_URL ?>assets/logo/youtube.png"
                            alt="YouTube"></a>
                    <a href="https://www.linkedin.com/in/christophe-chatelot/"><img
                            src="<?= BASE_URL ?>assets/logo/linkedin.png" alt="Linkedin"></a>
                </div>
            </div>
            <div class="footer-section about">
                <h3>Aquasterion</h3>
                <p>Un site web moderne qui fait plein de truc, je dois remplir cette section donc bla bla bla. Vous
                    saviez que la couleur des carottes est dù à leurs couleur ?</p>
            </div>
            <div class="footer-section contact">
                <h3>Contact</h3>
                <p>Email: contact@aquasterion.local</p>
                <p>Téléphone: +33 6 04 56 76 82</p>
            </div>
        </div>
        <div class="footer-bottom">
            Copyright &copy; 2024 Aquasterion.
        </div>
    </footer>
</body>

</html>