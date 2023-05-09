<?php
session_start();

$cortes = array(
    ['name' => 'TOSTER', 'image' => 'uploads/imagem1.jpg', 'price' => 'R$25'],
    ['name' => 'UNDERCUT', 'image' => 'uploads/imagem2.jpg', 'price' => 'R$25'],
    ['name' => 'AMERICAN BLACK', 'image' => 'uploads/imagem3.jpg', 'price' => 'R$25']
);
//var_dump($cortes);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!--css-->
    <link rel="stylesheet" href="css/style.css">
    <title>Barbearia Na Pegada</title>
    <!--bootstrap-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <!--Flaticon-->
    <link rel='stylesheet' href='https://cdn-uicons.flaticon.com/uicons-solid-straight/css/uicons-solid-straight.css'>
</head>
<body>
    <nav class="navbar navbar-light bg-secondary"> 
        <div class="container">
        <a class="navbar-brand" href="#">
            <img src="images/barber.png" alt="" width="50" height="50" <h1>NA PEGADA</h1> <class= "d-inline-block align-text-top">
            </a>
        </div>       
    </nav>

    <!--<div class="card-group text-center  container">
	  <div class="card">
	    <img src="uploads/imagem1.jpg" class="card-img-top" alt="...">
	    <div class="card-body">
	      <h5 class="card-title">Camisa 01</h5>
	     <p class="card-text">R$ 49,90</p>
	      <a href="#" class="btn btn-warning">COMPRAR</a>
	    </div>

    <div class="card-group text-center  container">
	  <div class="card">
	    <img src="uploads/imagem2.jpg" class="card-img-top" alt="...">
	    <div class="card-body">
	      <h5 class="card-title">Camisa 01</h5>
	     <p class="card-text">R$ 49,90</p>
	      <a href="#" class="btn btn-warning">COMPRAR</a>
	    </div>

    <div class="card-group text-center  container">
	  <div class="card">
	    <img src="uploads/imagem3.jpg" class="card-img-top" alt="...">
	    <div class="card-body">
	      <h5 class="card-title">Camisa 01</h5>
	     <p class="card-text">R$ 49,90</p>
	      <a href="#" class="btn btn-warning">COMPRAR</a>
	    </div> -->
    


    <div class="card-group tex-center container">
        <?php foreach($cortes as $key =>$value): ?>
            <div class="card">
                <img src="<?=$value['image']?>" class="card-img-top" alt="">
                <div class="card-body">
                    <h5 class="card-title"><?=$value['name']?></h5>
                     <h6>Versátil, o corte combina com todos os tipos de fios e permite que o cabelo do topo seja estilizado de diversas formas: se for longo, você consegue ter uma franja também comprida e, se quiser, pode até mesmo esconder suas laterais raspadas.</h6>
                    <p class="card-text"><?=$value['price']?></p>
                    <a href="?comprar=<?php echo $key ?>" class="btn btn-dark">AGENDAR </a>
                </div>
            </div>
            <?php endforeach; ?>
    </div>

    
    <div class="container">
        <?php 
	  		if(isset($_GET['comprar'])){
                $idCorte = (int) $_GET['comprar'];
                if(isset($Cortes[$idCorte])){
                    if(isset($_SESSION['buy'][$idCorte])){
                        $_SESSION['buy'][$idCorte]['quant']++;
                    }else{
                        $_SESSION['buy'][$idCorte] = array('quant'=>1, 'name'=>$Cortes[$idCorte]['name'], 'price'=>$Cortes[$idCorte]['price']);
                    }
                    echo '<script>alert("Corte adicionada no carrinho")</script>';
                }else{
                    die("O corte não está mais disponível");
                }
            }  
	  	?>
    </div>
    <h2>Carrinho: </h2>
        <?php
        session_start();
        if(isset($_GET['limpar'])){
            unset($_SESSION['buy']);//unset -> Destrói a variável especificada
        }
            if(isset($_SESSION['buy'])){
                foreach ($_SESSION['buy'] as $key => $value){
                    echo '<p>Nome: '.$value['name'].'| Quant.:'.$value['quant'].' | Valor: R$'.$value['price']*$value['quant'].': ';
                    echo "<br>";
                        
                }
        }else{
                echo "O carrinho está vazio!";
        }
  ?>
  <p><a href="?limpar" class="btn btn-secondary">LIMPAR CARRINHO</a></p>
  <?php
  $total = [
    'quants' => 0,
    'prices' => 0
 ];
if(isset($_SESSION['buy']))
foreach ($_SESSION['buy'] as $key) {
$total['quants'] = $total['quants'] + $key['quant']; 
$total['prices'] = $total['prices'] + $key['price'] * $key['quant']; 
}
echo $total['quants']  . ' produtos  por R$ ' . $total['prices'];
?>

  
        
     
</body>
</html>