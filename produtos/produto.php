<?php
include_once('../cod_conexao.php');
session_start();
?>

<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Tellech</title>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer">
        <link rel="stylesheet" href="produtos.css">
        <script src="produtos.js" async></script>

        <link rel="stylesheet" href="https://unpkg.com/boxicons@latest/css/boxicons.min.css">

        <!--Link Rodapé-->
            <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css">
            <link href="http://fonts.googleapis.com/css?family=Cookie" rel="stylesheet" type="text/css">
    </head>
    <body>
        <?php
        if(isset($_SESSION['id'])){
            include('./menu_logado.php');
        }else{
            include('./menu.html');
        }
        ?>

        <h1>Produtos Tellech</h1>
        <section class="contenedor">
            <!-- Contenedor de elementos -->
            
            <div class="contenedor-items">

            <?php
            $comando = "SELECT * FROM produto ORDER BY id DESC";
            $enviar = mysqli_query($conexao, $comando);
            $resultado = mysqli_fetch_all($enviar, MYSQLI_ASSOC);

            foreach ($resultado as $produto){
                $codigo = $produto['IdProduto'];
                $nome = $produto['NomeProduto'];
                $preco = $produto['Preco'];

                $midia = $produto['MidiaProduto'];
                $imagem = imagecreatefromstring($midia);
                ob_start();
                imagejpeg($imagem, null, 80);
                $data = ob_get_contents();
                ob_end_clean();
                
            ?>
                    <div class="item">
                        <span class="titulo-item"><?=utf8_encode($nome)?></span>
                        <?php echo "<img src=\"data:image/jpg;base64," .  base64_encode($data)  . "\" class=\"img-item\"/>";?>
                        <span class="precio-item"><?=$preco?></span>
                        <form class="carrinho" method="POST" action="../carrinho/gerenciar_carrinho.php">
                            <input type="hidden" name="produto_id" value="<?=$codigo?>">
                            <input type="hidden" name="quantidade" value="1">
                            <button class="boton-item" type="submit">Adicionar ao carrinho</button>
                        </form>
                        <button class="boton-item" id="ver-produto-btn">Ver produto</button>
                    </div>
            <?php
            }
            ?>


            </div>
            <!-- Carrito de Compras -->
            <div class="carrito" id="carrito">
                <div class="header-carrito">
                    <h2>Seu carrinho</h2>
                </div>
                <div class="carrito-items">
                    <!-- Conteúdo do carrinho aqui -->
                </div>
                <div class="carrito-total">
                    <div class="fila">
                        <strong>Total a pagar</strong>
                        <span class="carrito-precio-total"></span>
                    </div>
                    <form method="POST" action="../carrinho/gerenciar_carrinho.php">
                            <input type="hidden" name="produto_id" value="<?=$codigo?>">
                            <input type="hidden" name="quantidade" value="1">
                            <button class="btn-pagar" type="submit">Adicionar ao carrinho <i class="fa-solid fa-bag-shopping"></i></button>
                    </form>
                </div>
            </div>
        </section>

        <!-- Rodapé-->
        <div id="linha-horizontal"></div>

		<footer class="footer-distributed">

			<div class="footer-left">
				<h3>Tellech<span>Developer</span></h3>
	
				<p class="footer-links">
					<a href="../index.php">Home</a>
					|
					<a href="produto.php">Produtos</a>
					|
					<a href="../empresa/empresa.html">Sobre Nós</a>
				</p>
	
				<p class="footer-company-name">Copyright © 2023 <strong>Tellech</strong> All rights reserved</p>
			</div>
	
			<div class="footer-center">
				<div>
					<i class="fa fa-map-marker"></i>
					<p><span>Itaquera</span>
						São Paulo</p>
				</div>
	
				<div>
					<i class="fa fa-phone"></i>
					<p>+55 94**9**25</p>
				</div>
				<div>
					<i class="fa fa-envelope"></i>
					<p class="email"><a href="mailto:agencytellech@gmail.com">tellech@gmail.com</a></p>
				</div>
			</div>
			<div class="footer-right">
				<p class="footer-company-about">
					<span>Sobre a Loja</span>
					<strong>Tellech</strong> é uma loja virtual voltada para a venda de produtos de tecnologia assistiva.
				</p>
				<div class="footer-icons">
					<a href="https://www.facebook.com/profile.php?id=61551250011951&mibextid=ZbWKwL"><i class="fa fa-facebook"></i></a>
					<a href="https://instagram.com/agencytellech?igshid=MzMyNGUyNmU2YQ=="><i class="fa fa-instagram"></i></a>
				</div>
			</div>
		</footer>
    </body>
</html>