<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php bloginfo( 'name' ); ?><?php bloginfo( 'description' ); ?></title>
    <link rel="stylesheet" media="all" href="<?php echo get_template_directory_uri() ?>/assets/css/style.css" />
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<header>
    <a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a>
</header>
