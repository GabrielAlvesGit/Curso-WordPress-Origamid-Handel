<?php 

// Corrigido o nome da função para 'handle_custom_checkout'
function handle_custom_checkout($fields) {
  $fields['billing']['billing_first_name']['label'] = 'Primeiro nome';

  $fields['billing']['billing_presente'] = [
    'label' => 'Embrulhar para presente?',
    'required' => false,
    'class' => ['form-row-wide'],
    'clear' => true,
    'type' => 'select',
    'nao' => 'não',
    'sim' => 'sim'
  ];

  return $fields;
}

// Adicionando o filtro com o nome da função corrigido
add_filter('woocommerce_checkout_fields', 'handle_custom_checkout');

function show_admin_custom_checkout_presente($order) {
  $presente = get_post_meta($order->get_id(), '_billing_presente', true);
  echo '<p><strong>Presente:</strong>' . $presente . '</p>';
}

add_action('woocommerce_admin_order_data_after_shipping_address', 'show_admin_custom_checkout_presente');

// Adiciona campo
function handle_custom_checkout_fields($checkout) {
  woocommerce_form_field('mensagem_personalizada', [
    'type' => 'textarea',
    'class' => ['form-row-wide  mensagem-personalizada'],
    'label' => 'Mensagem Personalizada',
    'placeholder' => 'Escreva uma mensagem personalizada para a pessoa que você está presenteando.',
    'required' => true,
  ], $checkout->get_value('mensagem_personalizada'));
  echo 'funcionou';
}

add_action('woocommerce_after_order_notes', 'handle_custom_checkout_fields');

// Validar campo
function handel_custom_checkout_field_process() {
  if(!$_POST['mensagem_personalizada']) {
    wc_add_notice('Por favor, escreva uma mensagem personalizada', 'error');
  }
}

add_action('woocommerce_checkout_process', 'handel_custom_checkout_field_process');

// Adicionar ao banco de dados

function handel_custom_checkout_field_update(){
  if(!empty($_POST['mensagem_personalizada'])){
    update_post_meta($order_id, 'mensagem_personaliza', sanitize_text_field($_POST['mensagem_personalizada']));
  }
}

add_action('woocommerce_checkout_update_order_meta', 'handel_custom_checkout_field_update');

function show_admin_custom_checkout_mensagem($order) {
  $mensagem = get_post_meta($order->get_id(), 'mensagem_personaliza', true);
  echo '<p><strong>Mensagem:</strong>' . $mensagem . '</p>';
}

add_action('woocommerce_admin_order_data_after_shipping_address', 'show_admin_custom_checkout_mensagem');
?>