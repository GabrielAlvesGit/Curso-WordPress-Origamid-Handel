<?php 
// Template name: Home
get_header(); ?>

<?php if(have_posts()) { while (have_posts()) { the_post(); ?>

<?php 
$products_slide = wc_get_products([
  'limit' => 6,
  'tag' => ['slide'],
  'stock_status' => 'instock'
]);

$products_new = wc_get_products ([
  'limit' => 9,
  'orderby' => 'date',
  'order' => 'DESC',
  'stock_status' => 'instock'
]);

$products_sales = wc_get_products ([
  'limit' => 9,
  'meta_key' => 'total_sales',
  'orderby' => 'meta_value_num',
  'order' => 'DESC',
  'stock_status' => 'instock'
]);

$data = [];

$data['slide'] = format_products($products_slide, 'slide');
$data['lancamentos'] = format_products($products_new, 'medium');
$data['vendidos'] = format_products($products_sales, 'medium');

//print_r($data);

$home_id = get_the_ID();
$categoria_esquerda = get_post_meta($home_id, 'categoria_esquerda', true);
$categoria_direita = get_post_meta($home_id, 'categoria_direita', true);

function get_product_category_data($category) {
    $cat = get_term_by('slug', $category, 'product_cat');
    
    $cat_id = $cat->term_id;
    $img_id = get_term_meta($cat_id, 'thumbnail_id', true);
    $img_cat = wp_get_attachment_image_src($img_id, 'slide')[0];

    return [
        'name' => $cat->name,
        'id' => $cat_id,
        'link' => get_term_link($cat_id, 'product_cat'), 
        'img' => $img_cat
    ];
}

$data['categorias'][$categoria_esquerda] = get_product_category_data($categoria_esquerda);
$data['categorias'][$categoria_direita] = get_product_category_data($categoria_direita);

//print_r($data['categorias']);
?>


<ul class="vantagens">
  <li>Frete Grátis</li>
  <li>Troca Fácil</li>
  <li>Até 12x</li>
</ul>
<section class="slide-wrapper">
  <ul class="slide">
    <?php foreach($data['slide'] as $product) { ?>
    <li class="slide-item">
      <img src="<?= $product['img']; ?>" alt="<?= $product['name']; ?>">
      <div class="slide-info">
        <span class="slide-preco"><?= $product['price']; ?></span>
        <h2 class="slide-nome"><?= $product['name']; ?></h2>
        <a class="btn-link" href="<?= $product['link']; ?>">Ver produto</a>
      </div>
    </li>
    <?php } ?>
  </ul>
</section>

<section class="container">
  <h1 class="subtitulo">Lançamentos</h1>
  <?php  handel_product_list($data['lancamentos']); ?>
</section>

<section class="categorias-home">
  <?php foreach($data['categorias'] as $categoria) { ?>
  <a href="<?= $categoria['link'] ?>">
    <img src="<?= $categoria['img'] ?>" alt="<?= $categoria['name'] ?>">
    <span class="btn-link"><?= $categoria['name'] ?></span>
  </a>
  <?php } ?>
</section>

<section class="container">
  <h1 class="subtitulo">Mais Vendidos</h1>
  <?php  handel_product_list($data['vendidos']); ?>
</section>
<!--
<pre>
 < ?php 
 $customer = new WC_Customer(1);
 $user = new WP_User(1);

 print_r($user);
 ?>
</pre>

<pre>
< ?php 
$ product = wc_get_product(60);

echo '<p>' . $product->get_status();
echo '<p>' . $product->get_sku();
echo '<p>' . $product->get_name();
echo '<p>' . $product->get_stock_quantity();
echo '<p>' . $product->get_total_sales();
//echo '<p>' . $product->get_category_ids();

echo $product->get_price_html();

$product->set_sale_price('39');
 //print_r($product);
?>
</pre>


< ?php do_action('dentro_da_home'); ?>

< ?php echo apply_filters('titulo_home', 'Essa é a home'); ?>


<pre>
 < ? //php 
 $woo = WC();

 // Sobre o Carrinho
 $cart = $woo->cart->get_cart();

 foreach($cart as $item) {
  
  echo '<p>Nome: ' . $item['data']->get_name();
  echo '<p>Preço: ' . $item['data']->get_price();
 }

 // Nome do Endereço/ Cidade / Estado da Loja
 echo $woo->countries->get_base_address();
 echo $woo->countries->get_base_city();
 echo $woo->countries->get_base_state();

 print_r(array_keys($GLOBALS));
 //print_r($cart);
 ?>
</pre>
-->
<?php } } ?>


<?php get_footer(); ?>