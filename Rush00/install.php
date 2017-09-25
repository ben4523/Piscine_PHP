<?php
  require_once 'fonctions/ft_database.php';
  $database = start_database();
  require_once 'fonctions/ft_user.php';

// create products
$q = mysqli_query($database, "DROP TABLE IF EXISTS `products`;");
query_ok($q);
$q = mysqli_query($database, "CREATE TABLE IF NOT EXISTS `products` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` text NOT NULL,
  `image` text NOT NULL,
  `price` float NOT NULL,
  `description` text NOT NULL,
  `categories` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;");

// create commandes
$q = mysqli_query($database, "DROP TABLE IF EXISTS `commandes`;");
query_ok($q);
$q = mysqli_query($database, "CREATE TABLE IF NOT EXISTS `commandes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `login` text NOT NULL,
  `basket` text NOT NULL,
  `date` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;");
query_ok($q);

// create category
$q = mysqli_query($database, "DROP TABLE IF EXISTS `categories`;");
query_ok($q);
$q = mysqli_query($database, "CREATE TABLE IF NOT EXISTS `categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` text NOT NULL,
  `categorie` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;");
query_ok($q);

$q = mysqli_query($database, "INSERT INTO `categories` (`id`, `title`, `categorie`) VALUES
(1, 'Ipad', 'Ipad'),
(2, 'Iphone', 'Iphone'),
(3, 'Macbook Pro', 'Macbook Pro'),
(4, 'Imac', 'Imac')");
query_ok($q);

// create users
$q = mysqli_query($database, "DROP TABLE IF EXISTS `users`;");
query_ok($q);
$q = mysqli_query($database, "CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` text NOT NULL,
  `passwd` text NOT NULL,
  `admin` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=0 ;");
query_ok($q);


///////////////////
//// populate db
create_new_user('admin@admin.com','12345678');
$q = mysqli_query($database, "UPDATE users SET admin='1' WHERE email='admin@admin.com'");
query_ok($q);

$q = mysqli_query($database, "INSERT INTO `products` (`id`, `title`, `image`, `price`, `description`, `categories`) VALUES
(1, 'Iphone 7 Noir de Jais', 'https://store.storeimages.cdn-apple.com/4662/as-images.apple.com/is/image/AppleInc/aos/published/images/i/ph/iphone7/jetblack/iphone7-jetblack-select-2016_AV2?wid=300&hei=610&fmt=png-alpha&qlt=80&.v=1472693558353', 879, 'Iphone 7 128 Go Noir de Jais', '2'),
(2, 'Iphone 7 Plus Noir Mat', 'https://store.storeimages.cdn-apple.com/4662/as-images.apple.com/is/image/AppleInc/aos/published/images/i/ph/iphone7/black/iphone7-black-select-2016_AV2?wid=300&hei=610&fmt=png-alpha&qlt=80&.v=1472693191490', 1129, 'Iphone 7 Plus 256 Go Noir de Mat', '2'),
(4, 'Imac 27 Pouces', 'https://store.storeimages.cdn-apple.com/4662/as-images.apple.com/is/image/AppleInc/aos/published/images/i/ma/imac/27/imac-27-retina-selection-hero-201706?wid=904&hei=840&fmt=jpeg&qlt=80&op_sharpen=0&resMode=bicub&op_usm=0.5,0.5,0,0&iccEmbed=0&layer=comp&.v=1495749608503', 2599, 'Imac 27 Pouces 2 To 16 Go memoire vive', '4'),
(5, 'Imac 21,5 Pouces', 'https://store.storeimages.cdn-apple.com/4662/as-images.apple.com/is/image/AppleInc/aos/published/images/i/ma/imac/215/imac-215-retina-selection-hero-201706?wid=904&hei=840&fmt=jpeg&qlt=80&op_sharpen=0&resMode=bicub&op_usm=0.5,0.5,0,0&iccEmbed=0&layer=comp&.v=1495846295922', 1499, 'Imac 21,5 Pouces 1 To 16 Go memoire vive', '4'),
(6, 'Iphone 7 Rose', 'https://store.storeimages.cdn-apple.com/4662/as-images.apple.com/is/image/AppleInc/aos/published/images/i/ph/iphone7/rosegold/iphone7-rosegold-select-2016_AV2?wid=300&hei=610&fmt=png-alpha&qlt=80&.v=1472693193520', 779, 'Iphone 7 32 Go Go Rose', '2'),
(7, 'MacBook Pro 15 Pouces', 'https://store.storeimages.cdn-apple.com/4662/as-images.apple.com/is/image/AppleInc/aos/published/images/m/bp/mbp15touch/gray/mbp15touch-gray-select-201610?wid=904&hei=840&fmt=jpeg&qlt=80&op_sharpen=0&resMode=bicub&op_usm=0.5,0.5,0,0&iccEmbed=0&layer=comp&.v=1496611018929', 2299, 'MacBook Pro 15 Pouces 512 Go', '3'),
(8, 'Ipad Pro 10,5', 'https://store.storeimages.cdn-apple.com/4662/as-images.apple.com/is/image/AppleInc/aos/published/images/i/pa/ipad/pro/ipad-pro-10in-cell-select-silver-201706_GEO_FR?wid=940&hei=1112&fmt=png-alpha&qlt=80&.v=1495917183201', 739, 'Ipad Pro 10,5 Pouces Gris 64 Go Wifi', '1'),
(9, 'Ipad Pro 12,9', 'https://store.storeimages.cdn-apple.com/4662/as-images.apple.com/is/image/AppleInc/aos/published/images/i/pa/ipad/pro/ipad-pro-12in-wifi-select-gold-201706_GEO_FR?wid=940&hei=1112&fmt=png-alpha&qlt=80&.v=1495917898682', 1069, 'Ipad Pro 12,9 Pouces Or 64 Go 3G', '1'),
(10, 'Ipad Pro 10,5', 'https://store.storeimages.cdn-apple.com/4662/as-images.apple.com/is/image/AppleInc/aos/published/images/i/pa/ipad/pro/ipad-pro-10in-wifi-select-spacegray-201706_GEO_FR?wid=940&hei=1112&fmt=png-alpha&qlt=80&.v=1495917107066', 1219, 'Ipad Pro 10,5 Pouces Or 512 Go 3G', '1')
");

query_ok($q);
$pass = hash('sha512', "12345678");
$quest = "INSERT INTO `users` (`id`, `email`, `passwd`, `admin`) VALUES (2, 'user@user.fr', '$pass', 0);";
$q = mysqli_query($database, $quest);
query_ok($q);

$q = mysqli_query($database, "INSERT INTO `commandes` (`id`, `user_id`, `login`, `basket`, `date`) VALUES
(1, 1, 'admin@admin.com', 'a:1:{i:3;i:5;}', '2017-01-15'),
(2, 1, 'admin@admin.com', 'a:1:{i:3;i:4;}', '2017-01-15'),
(3, 1, 'user@user.fr', 'a:3:{i:3;i:8;i:6;i:10;i:7;i:13;}', '2017-01-15');");
query_ok($q);
header('Location: index.php');
?>
