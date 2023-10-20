<?php

session_start();

?>

<!DOCTYPE html>
<html lang="pt">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>Tellech</title>
		<!-- Link BootStrap-->
		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
		<!--CSS - link -->
		<link rel="stylesheet" href="style.css">

		<!-- Link Fonte -->
		<link rel="preconnect" href="https://fonts.googleapis.com">
		<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
		<link href="https://fonts.googleapis.com/css2?family=Jost:wght@100;200;300;400;500;600;700&display=swap" rel="stylesheet">
		<!-- Final Link Fonte -->

		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

		<link rel="stylesheet" href="https://unpkg.com/boxicons@latest/css/boxicons.min.css">

		<!--Link Rodapé-->
		<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css">
	    <link href="http://fonts.googleapis.com/css?family=Cookie" rel="stylesheet" type="text/css">
	</head>
	<body>
		<!-- Link BootStrap-->
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>


        <?php
        if(isset($_SESSION['id'])){
            include('./menu_logado.php');
        }else{
            include('./menu.html');
        }
        ?>


		

		<!-- Seção - HomePage -->
		<section class="main-home"> <!-- HomePage -->
			<div class="main-text"> <!-- Texto Principal -->
				<h1>Produtos de Tecnologia Assistiva <br> 2023</h1>

				<a href="produtos/produto.php" class="main-btn">Compre Agora <i class='bx bx-right-arrow-alt'></i></a> 
			</div>

			<div class="down-arrow"> <!-- Seta para baixo -->
				<a href="#trending" class="down"><i class='bx bx-down-arrow-alt'></i></a>
			</div>
		</section>

		<!-- Seção Carrosel-->
		<section class="carousel">
			<div id="carouselExampleIndicators" class="carousel slide">
				<div class="carousel-indicators">
					<button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
					<button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
					<button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
				</div>
				<div class="carousel-inner">
					<div class="carousel-item active">
						<img src="carrossel/c_image1.png" class="d-block w-100" alt="..." >
					</div>
					<div class="carousel-item">
						<img src="carrossel/c_image2.png" class="d-block w-100" alt="...">
					</div>
					<div class="carousel-item">
						<img src="carrossel/c_image3.png" class="d-block w-100" alt="...">
					</div>
				</div>
				<button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
					<span class="carousel-control-prev-icon" aria-hidden="true"></span>
					<span class="visually-hidden">Previous</span>
				</button>
				<button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
					<span class="carousel-control-next-icon" aria-hidden="true"></span>
					<span class="visually-hidden">Next</span>
				</button>
			</div>
		</section>
		<!-- Fim Seção Carrosel-->
		<div class="title">
			<h2>Nossos Produtos</h2>
		</div>

		<section class="contenedor" id="trending">
            <!-- Contenedor de elementos -->
            <div class="contenedor-items">
                <div class="item">
                    <span class="titulo-item">Muleta</span>
                    <img src="imagens/muleta.jpg" alt="" class="img-item">
                    <span class="precio-item">R$20,00</span>
                    <a href="carrinho/carrinho.html"><button class="boton-item" id="ver-produto-btn">Ver produto</button></a>
                </div>

                <div class="item">
                    <span class="titulo-item">Cadeira de rodas</span>
                    <img src="imagens/cadeirarodas.jpg" alt="" class="img-item">
                    <span class="precio-item">R$25000,00</span>
                    <button class="boton-item" id="ver-produto-btnn">Ver produto</button>
                </div>

                <div class="item">
                    <span class="titulo-item">Livro em braille</span>
                    <img src="imagens/livrobraille.png" alt="" class="img-item">
                    <span class="precio-item">R$35000,00</span>
                    <button class="boton-item" id="ver-produto-btnnn">Ver produto</button>
                </div>

                <div class="item">
                    <span class="titulo-item">Adaptador</span>
                    <img src="imagens/adaptador.png" alt="" class="img-item">
                    <span class="precio-item">R$18000,00</span>
                    <button class="boton-item" id="ver-produto-btnnnn">Ver produto</button>
                </div>

                <div class="item">
                    <span class="titulo-item">Garfo para auxiliar</span>
                    <img src="imagens/garfo.jpg" alt="" class="img-item">
                    <span class="precio-item">R$18000,00</span>
                    <button class="boton-item" id="ver-produto-btnnnnn">Ver produto</button>
                </div>

                <div class="item">
                    <span class="titulo-item">Aparelho Auditivo</span>
                    <img src="imagens/aparelhoauditivo.png" alt="" class="img-item">
                    <span class="precio-item">R$289,90</span>
                    <button class="boton-item" id="ver-produto-btnnnnnnn">Ver produto</button>
                </div>

                <div class="item">
                    <span class="titulo-item">Fixador multiuso</span>
                    <img src="imagens/fixador.jpg" alt="" class="img-item">
                    <span class="precio-item">R$32,00</span>
                    <button class="boton-item" id="ver-produto-btnnnnnnn">Ver produto</button>
                </div>

                <div class="item">
                    <span class="titulo-item">Engrossador em discos</span>
                    <img src="imagens/engrossador.jpeg" alt="" class="img-item">
                    <span class="precio-item">R$42,00</span>
                    <button class="boton-item" id="ver-produto-btnnnnnnnn">Ver produto</button>
                </div>
            </div>
        </section>

		<!-- Rodapé-->
		<div id="linha-horizontal"></div>

		<footer class="footer-distributed">

			<div class="footer-left">
				<h3>Tellech<span>Developer</span></h3>
	
				<p class="footer-links">
					<a href="index.html">Home</a>
					|
					<a href="produtos/produtos.html">Produtos</a>
					|
					<a href="empresa/empresa.html">Sobre Nós</a>
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
					<a href="https://www.facebook.com/profile.php?id=61550963147203"><i class="fa fa-facebook"></i></a>
					<a href="https://instagram.com/agencytellech?igshid=MzMyNGUyNmU2YQ=="><i class="fa fa-instagram"></i></a>
				</div>
			</div>
		</footer>
	</body>
</html>
