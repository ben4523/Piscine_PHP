<?php
require_once 'fonctions/ft_produits.php';
?>
<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Apple - 42</title>
        <link rel="stylesheet" href="./design/css/main.css">
    </head>
    <body>
        <!-- Haut de page !-->
            <header id="header">
                <nav class="customer">
                    <a href="index.php">
                        <li class="logo">
                            <img src="design/img/iphone.png">
                        </li>
                    </a>
                    <a href="produits.php">
                        <li style="float: left">
                            Produits
                        </li>
                    </a>
                    <?php if(!isset($user)): ?>
                        <a href="panier.php">
                            <li>
                                    Mon Panier
                                    <span class="badge">
                                        <?php
                                            if($_SESSION['basket_total_count'] < 0)
                                                $_SESSION['basket_total_count'] = 0;
                                            echo $_SESSION['basket_total_count'];
                                        ?>
                                    </span>
                                    <span class="badge">
    									<?php if (isset($_SESSION['basket']) && $_SESSION['basket'] != null) {
    									foreach ($_SESSION['basket'] as $productId => $productCount)
    									{
    										$product = getOneProduct($productId);
    										$totalProductPrice = floatval($product['price'] * floatval($productCount));
    										$totalPrice = isset($totalPrice) ? $totalPrice + $totalProductPrice : $totalProductPrice;
    									} }
    									else
    										$totalPrice = 0;
    									echo $totalPrice."€"; ?>
                                    </span>
                            </li>
                        </a>
                        <a href="connexion.php">
                            <li>
                                    Connexion
                            </li>
                        </a>
                    <?php endif; ?>
                    <?php if(isset($user) && $user['admin'] == '0'): ?>
                        <a href="logout.php" style="color: white">
                            <li class="count-articles">
                                    Déconnexion
                            </li>
                        </a>
                        <a href="panier.php">
                            <li>
                                    <i class="fa fa-shopping-cart"></i>
                                    Mon Panier
                                    <span class="badge">
                                        <?php
                                            if($_SESSION['basket_total_count'] < 0)
                                                $_SESSION['basket_total_count'] = 0;
                                            echo $_SESSION['basket_total_count'];
                                        ?>
                                    </span>
                                    <span class="badge">
    									<?php if (isset($_SESSION['basket']) && $_SESSION['basket'] != null) {
    									foreach ($_SESSION['basket'] as $productId => $productCount)
    									{
    										$product = getOneProduct($productId);
    										$totalProductPrice = floatval($product['price'] * floatval($productCount));
    										$totalPrice = isset($totalPrice) ? $totalPrice + $totalProductPrice : $totalProductPrice;
    									} }
    									else
    										$totalPrice = 0;
    									echo $totalPrice."€"; ?>
                                    </span>
                            </li>
                        </a>
                            <a href="profil.php">
                                <li>
                                    Mon compte
                                </li>
                            </a>
                    <?php endif; ?>
                    <?php if(isset($user) && $user['admin'] == '1'): ?>
                        <a href="logout.php" style="color: white">
                            <li class="count-articles">
                                    Déconnexion
                            </li>
                        </a>
                        <a href="profil.php">
                            <li>
                                Administration
                            </li>
                        </a>
                        <a href="commandes.php">
                            <li>
                               Commandes
                            </li>
                        </a>
                    <?php endif; ?>
                </nav>
            </header>
        <!-- Fin du Haut de page !-->
