<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?php bloginfo('name'); ?> <?php wp_title('|'); ?></title>
  <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

  <?php 
  
    $img_url = get_stylesheet_directory_uri() . '/img';
    $cart_count = wc()->cart->get_cart_contents_count();
  ?>
  <header class="header">
    <div class="container grid">

      <a href="/"> <img src="<?php echo $img_url; ?>/handel.svg" alt="Handel"></a>

      <div class="busca">
        <? //php get_product_search_form(); ?>
        <form action="<?php bloginfo('url'); ?>/loja/" method="get">
          <input type="text" name="s" id="s" placeholder="Buscar" value="<?php the_search_query(); ?>">
          <!-- Buscar um produto especifico -->
          <input type="text" name="post_type" value="product" class="hidden">

          <!-- Btn - Busca -->
          <input type="submit" id="searchbutton" value="Buscar">
        </form>
      </div>

      <!-- Conta -->
      <nav class="conta">
        <a href="/minha-conta" class="minha-conta">Minha Conta</a>
        <a href="/carrinho" class="carrinho">Carrinho
          <?php if($cart_count) { ?>
          <span class="carrinho-count"><?php echo $cart_count; ?></span>
          <?php } ?>
        </a>
      </nav>

    </div>
  </header>

  <?php 
  wp_nav_menu([
    //Nome da ul = menu
    'menu' => 'categorias',

    //Nome da nav = menu-categorias
    'container' => 'nav',
    'container_class' => 'menu-categorias'
  ])
  ?>