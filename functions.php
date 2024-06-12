<?php

function handel_add_woocommerce_support() {
  add_theme_support('woocommerce');
}
add_action('after_setup_theme', 'handel_add_woocommerce_support');

// Importação do CSS dentro da function
function handel_css() {
  wp_register_style('handel-style', get_template_directory_uri() . '/style.css', [], '1.0.0');
  wp_enqueue_style('handel-style');
}
add_action('wp_enqueue_scripts', 'handel_css');

// Pre-definição de um tamanho específico dentro de WP -> Configurações -> Mídia -> Tamanho 768x840
function handel_custom_images() {
  add_image_size('slide', 1000, 800, ['center', 'top']);
  update_option('medium_crop', 1);
}
add_action('after_setup_theme', 'handel_custom_images');

// Em uma lista quero mostrar somente 2 itens
function handel_loop_shop_per_page() {
  return 6;
}
add_filter('loop_shop_per_page', 'handel_loop_shop_per_page');

function remove_some_body_class($classes) {
  $woo_class = array_search('woocommerce', $classes);
  $woopage_class = array_search('woocommerce-page', $classes);
  $search = in_array('archive', $classes) || in_array('product-template-default', $classes);
  if($woo_class && $woopage_class && $search) {
    unset($classes[$woo_class]);
    unset($classes[$woopage_class]);
  }

  return $classes;
}
add_filter('body_class', 'remove_some_body_class');


// Funções comentadas para exemplo
/*
function executar_na_home() { ?>
<div>Teste</div>
<h2>Segundo Título</h2>
<?php }
add_action('dentro_da_home', 'executar_na_home');

function executar_na_home_2() { 
  echo 'Segunda vez na Home';
}
add_action('dentro_da_home', 'executar_na_home_2');

function mudar_titulo($titulo) {
  echo '<h2>' . $titulo . '</h2>';
}
add_filter('titulo_home', 'mudar_titulo');

function mudar_the_title($title) {
  return $title . ' Handel';
}
add_filter('the_title', 'mudar_the_title');

// Mudando nome de classe de preço já pelo próprio WP
function mudar_classe_preco() {
  return 'prices';
}
add_filter('woocommerce_product_price_class', 'mudar_classe_preco');
*/

include(get_template_directory() . '/inc/product-list.php');

include(get_template_directory() . '/inc/user-custom-menu.php');

include(get_template_directory() . '/inc/checkout-customizado.php');

//function hendel_change_email_header() {
  //echo '<h2 style="text-align: center;">Mensagem Header<h2>';
//}

//add_action('woocommerce_email_header', 'hendel_change_email_header');

function handel_change_email_footer_text($text) {
  echo 'Handel 
  <ul style="padding: 0px; margin: 0px; list-style: none;">
    <li><a href="/">Facebook</a></li>
    <li><a href="/">Instagram</a></li>
    <li><a href="/">YouTube</a></li>
  </ul>
  ';
}

add_filter('woocommerce_email_footer_text', 'handel_change_email_footer_text');


function handel_add_email_meta($order){
  $mensagem = get_post_meta($order->get_id(), 'mensagem_personalizada', true);
  $presente = get_post_meta($order->get_id(), '_billing_presente', true);

  echo '<h2 style="margin: -20px 0 10px 0px">Detalhes:</h2>
    <p style="font-size: 16px; border: 1px solid #e5e5e5; padding: 10px; " ><string>Mensagem: </strong>' . $mensagem . '</p>
    <p style="font-size: 16px; border: 1px solid #e5e5e5; padding: 10px; " ><string>Presente: </strong>' . $presente . '</p>
  ';
}

add_action('woocommerce_email_order_meta', 'handel_add_email_meta');
?>