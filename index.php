<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri(); ?>/style.css">
  <title>Document</title>
</head>

<body>
  <!--< ? php 
  //$nome = "Gabriel";
  //$sobrenome = " Viana";

  //$completo = $nome . $sobrenome;

  //$completo = 'Esse é meu nome: "$nome"';
  //$multiplicacao = 10 * 2;
 // echo $nome;? > 

<div>
< ?=$multiplicacao; ?>
  </div>

  <div>
    < ?php echo $completo; ?>
  </div>
-->

  <!--  

  /* Segundo Exemplo */
  <pre>
  < ?php 
    // Array
    $produtos = ['Bermudas', 'Camisetas', 'Casacos'];

    print_r($produtos);
  ?>
  </pre>
  <h1>< ?= $produtos[2]; ?></h1>
  -->

  <!--
  /* Terceiro Exemplo */
  <pre>
  < ?php 
    // Array
    $produtos = [
      'nome' => 'Camiseta Preta',
      'preco' => 'R$ 49',
      'img' => [
        'src' => './img/image.png',
        'alt' => 'Camisa Preta',
      ]
    ];

    $categorias = ['Camisetas'];
    $categorias[] = 'Bermudas';
    $categorias[] = 'Casacos';
    
    // item no Array
    $produto['estoque'] = '10 items';
    
    // remover algo especifico  
    unset($produto['preco']);
    
    // Contar quantos itens tem nome, img e estoque
    count($produto);
    $totalProduto = count($produto);
    echo $totalProduto;

    print_r($produtos);
  ?>
</pre>

  <h1>< ?= $produtos['nome']; ?></h1>
  <p>< ?= $produtos['preco']; ?></p>
  <img src="< ?= $produtos['img']['src']; ?>" alt="< ?= $produtos['img']['alt']; ?>">
  -->


  <!-- 
<pre>
  < ?php 
    // Loop e Condicionais
    for($i = 0; $i <= 20; $i++){
      echo $i;
    }
  ?>
</pre>
-->

  <pre>
  <?php 
    // Loop e Condicionais
   $produtos = [
    [
      'nome' => 'Camisa Preta',
      'preco' => 'R$ 49'
    ],
    [
      'nome' => 'Bermuda Branca',
      'preco' => 'R$ 99'
    ],
    [
      'nome' => 'Casaco Branca',
      'preco' => 'R$ 199'
    ]
   ];

   // True e false
   $vitalicio = false;
   if($vitalicio){
    echo "Liberar";
   }

   // Negação
   if(!empty($categorias));
    echo "Está cheiodo";
   endif;

   $categorias = ['Bermuda'];
   if(empty($categorias)){
    echo "Está vazia";
   } else {
    echo "Não está vazia";
   }

   // Para cada Item -> Camiseta Preta e Bermuda Branca
   foreach($produtos as $produto){ ?>
   <h1><?= $produto['nome'] ?></h1>
   <p><?= $produto['preco'] ?></p>
   <?php } ?>
</pre>

  <?php 
?>
  // Ternário - Condicional de uma linha
  <?php 
    $preco = 120;
    $mensagem = $preco > 100 ? "Caro" : "Barato";
    echo $mensagem;
   ?>
</body>

</html>