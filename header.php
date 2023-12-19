<!DOCTYPE html>
<!--suppress HtmlRequiredLangAttribute -->
<html <?php language_attributes(); ?>>
<!--suppress HtmlRequiredTitleElement -->
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=yes">
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

<?php wp_body_open();
get_template_part( 'components/header/header' ); ?>

<main id="main">
