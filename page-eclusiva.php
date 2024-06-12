<?php 
// Template name: Exclusivo
get_header(); ?>


<?php 
  // Verificar se o usuário esta logado para visualizar o seu produto
  $user = wp_get_current_user();

  $comprou = wc_customer_bought_product( $user->user_email, $user->ID, 96 );
?>


<?php if(have_posts()) { while (have_posts()) { the_post(); ?>
<h1 class="titulo"><?php the_title(); ?></h1>
<?php if($comprou) { ?>
<main class="container container-index"><?php the_content(); ?></main>
<?php } else { ?>
<p class="container">Essa página so pode ser vista por cliente que comprou um eBook</p>
<?php } ?>
<?php } } ?>


<?php get_footer(); ?>