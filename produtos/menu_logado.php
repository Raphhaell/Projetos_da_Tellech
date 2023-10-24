<?php
		include('../protect.php');
		?>
		
		<header> <!--imagem logo -->
			<a href="../index.php" class="logo"><img src="../logo_Tellech.png" alt="logo" ></a>
			
			<!-- itens menu -->
			<ul class="navmenu">
				<li><a href="../index.php">Home</a></li>
				<li><a href="produto.php">Produtos</a></li>
				<li><a href="../empresa/empresa.html">Sobre Nós</a></li>
			</ul>

			<div class="nav-icon"> <!-- Icones Menu -->
				<a href="#"><i class='bx bx-search'></i></a>
				<a href="../usuario/perfil_do_usuario.php"><i class='bx bx-user' id="user-icon"></i></a>
				<a href="#"><i class='bx bx-cart'></i></a>
			</div> <!-- Fim Icones Menu -->

			<nav class="menu-hamburguer">
				<input type="checkbox" class="menu-checkbox"/>

				<div class="bx bx-menu" id="menu-icon"></div>
				<ul>
					<li><a href="../index.php">Home</a></li>
					<li><a href="produto.php">Produtos</a></li>
					<li><a href="../FAQ/faq.html">FAQ</a></li>
					<!--<li><a href="forum/forum.html">Fórum</a></li>-->
					<li><a href="../empresa/empresa.html">Sobre Nós</a></li>

					<li><a href="../usuario/perfil_do_usuario.php"><?=utf8_encode($_SESSION['nome']); ?></a></li>
					<li><a href="../login/logout.php">Logout</a></li>
				</ul>
			</nav>
		</header> <!--Fim Header -->