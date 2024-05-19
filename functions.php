<?php 

function executar_na_home() { ?>

<div>Teste</div>
<h2>Segundo titulo</h2>

<?php } 

add_action('dentro_da_home', 'executar_na_home');

function mudar_titulo($titulo){
  echo '<h2>' . $titulo . '</h2>';
}

add_filter('titulo_home', 'mudar_titulo');
?>