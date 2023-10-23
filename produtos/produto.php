<?php
include_once('../cod_conexao.php');
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
        <header>
            <a href="../index.html" class="logo"><img src="../logo_Tellech.png" alt="logo" ></a>
                
                <!-- itens menu -->
                <ul class="navmenu">
                    <li><a href="../index.html">Home</a></li>
                    <li><a href="produtos.html">Produtos</a></li>
                    <li><a href="../empresa/empresa.html">Sobre Nós</a></li>
                </ul>

                <div class="nav-icon"> <!-- Icones Menu -->
                    <a href="#"><i class='bx bx-search'></i></a>
                    <a href="../login/login.html"><i class='bx bx-user' id="user-icon"></i></a>
                    <a href="#"><i class='bx bx-cart'></i></a>
                </div> <!-- Fim Icones Menu -->

                <nav class="menu-hamburguer">
                    <input type="checkbox" class="menu-checkbox"/>

                    <div class="bx bx-menu" id="menu-icon"></div>
                    <ul>
                        <li><a href="../index.html">Home</a></li>
                        <li><a href="produtos.html">Produtos</a></li>
                        <li><a href="../FAQ/faq.html">FAQ</a></li>
                        <li><a href="../empresa/empresa.html">Sobre Nós</a></li>
                        <li><a href="../login/login.html">Login</a></li>
                        <li><a href="../cadastro/cadastro_cliente.html">Cadastro</a></li>
                        <li><a href="../cadastro/cadastro_administrador.html">Cadastro Administrador</a></li>
                        <li><a href="../cadastro/cadastro_empresa.html">Cadastro Empresa</a></li>

                        <li><a href="../usuario/perfildousuario.html">Perfil</a></li>
                        <li><a href="../login/logout.php">Logout</a></li>
                    </ul>
                </nav>        
        </header><!--Fim de header-->

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

                $nomeMidia = $produto['NomeMidia'];
                $midia = $produto['MidiaProduto'];
                $imagem = imagecreatefromstring($midia);
                ob_start();
                imagejpeg($imagem, null, 80);
                $data = ob_get_contents();
                ob_end_clean();
                
            ?>

                
                    <div class="item">
                        <span class="titulo-item"><?=$nome?></span>
                        <?php echo "<img src=\"data:image/jpg;base64," .  base64_encode($data)  . "\" class=\"img-item\"/>";?>
                        <span class="precio-item">R$<?=$preco?></span>
                        <button class="boton-item">Adicionar ao carrinho</button>
                        <button class="boton-item" id="ver-produto-btn">Ver produto</button>
                    </div>

            <?php
            }
            ?>





                <div class="item">
                    <span class="titulo-item">Cadeira de rodas</span>
                    <img src="../imagens/cadeirarodas.jpg" alt="" class="img-item">
                    <span class="precio-item">R$25000,00</span>
                    <button class="boton-item">Adicionar ao carrinho</button>
                    <button class="boton-item" id="ver-produto-btnn">Ver produto</button>
                </div>

                <div class="item">
                    <span class="titulo-item">Livro em braille</span>
                    <img src="../imagens/livrobraille.png" alt="" class="img-item">
                    <span class="precio-item">R$35000,00</span>
                    <button class="boton-item">Adicionar ao carrinho</button>
                    <button class="boton-item" id="ver-produto-btnnn">Ver produto</button>
                </div>

                <div class="item">
                    <span class="titulo-item">Adaptador</span>
                    <img src="../imagens/adaptador.png" alt="" class="img-item">
                    <span class="precio-item">R$18000,00</span>
                    <button class="boton-item">Adicionar ao carrinho</button>
                    <button class="boton-item" id="ver-produto-btnnnn">Ver produto</button>
                </div>

                <div class="item">
                    <span class="titulo-item">Garfo para auxiliar</span>
                    <img src="../imagens/garfo.jpg" alt="" class="img-item">
                    <span class="precio-item">R$18000,00</span>
                    <button class="boton-item">Adicionar ao carrinho</button>
                    <button class="boton-item" id="ver-produto-btnnnnn">Ver produto</button>
                </div>

                <div class="item">
                    <span class="titulo-item">Aparelho Auditivo</span>
                    <img src="../imagens/aparelhoauditivo.png" alt="" class="img-item">
                    <span class="precio-item">R$289,90</span>
                    <button class="boton-item">Adicionar ao carrinho</button>
                    <button class="boton-item" id="ver-produto-btnnnnnn">Ver produto</button>
                </div>

                <div class="item">
                    <span class="titulo-item">Fixador multiuso</span>
                    <img src="../imagens/fixador.jpg" alt="" class="img-item">
                    <span class="precio-item">R$32,00</span>
                    <button class="boton-item">Adicionar ao carrinho</button>
                    <button class="boton-item" id="ver-produto-btnnnnnnn">Ver produto</button>
                </div>

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
                        <span class="carrito-precio-total">R$120.000,00</span>
                    </div>
                    <button class="btn-pagar">Pagar <i class="fa-solid fa-bag-shopping"></i></button>
                </div>
            </div>
        </section>

        <!-- Rodapé-->
        <div id="linha-horizontal"></div>

		<footer class="footer-distributed">

			<div class="footer-left">
				<h3>Tellech<span>Developer</span></h3>
	
				<p class="footer-links">
					<a href="../index.html">Home</a>
					|
					<a href="produtos.html">Produtos</a>
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