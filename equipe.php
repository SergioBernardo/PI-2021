<!DOCTYPE html>
<html lang="pt-br">

<head>
	<title>ETEC | Taboão da Serra</title>
	<meta charset="UTF-8" />
	<link rel="stylesheet" type="text/css" href="_css/home.css" />
	<link rel="stylesheet" type="text/css" href="_css/institucional.css" />
	<link rel="stylesheet" type="text/css" href="_css/responsive.css" />
	<link rel="stylesheet" type="text/css" href="_css/equipe.css" />
	<link rel="shortcut icon" type="image/x-icon" href="_imagens/iconeluizgustavo.png" />
	<script language="javascript" src="_javascript/funcoes.js"></script>

	
</head>

<body onload="slide1()">

	<header>
		<input type="checkbox" id="barranav">
		<label for="barranav">
			<div><span class="menuham"></span></div>

			<nav class="menusuperior">

				<a href="index.html"><img src="_imagens/_logos/taboaologo_menor.jpg" id="logotipoetec" /></a>

				<div class="menunavegacao">
					<ul>
						<li><a href="home.html" data-text="HOME">HOME</a></li>
						<li><a href="institucional.html" data-text="ETEC">ETEC</a></li>
						<li><a href="cursos.html" data-text="CURSOS">CURSOS</a></li>
						<li><a href="alunos.html" data-text="ALUNOS">ALUNOS</a></li>
						<li><a href="#" data-text="SECRETARIA">SECRETARIA</a></li>
						<li><a href="vestibulinho.html" data-text="CONTATO">CONTATO</a></li>
						<li><a href="vestibulinho.html" data-text="MUITO +">MUITO +</a></li>
					</ul>
				</div>
			</nav>
			<div class="menusocial">
				<ul>
					<li><a href="https://www.linkedin.com" target="_blank"><img src="_imagens/_logos/Linkedin.png" /></a></li>
					<li><a href="https://www.facebook.com.br" target="_blank"><img src="_imagens/_logos/Facebook.png" /></a></li>
					<li><a href="https://www.instagram.com" target="_blank"><img src="_imagens/_logos/Instagram.png" /></a></li>
					<li><a href="contato.html" target="_blank"><img src="_imagens/_logos/Contato.png" /></a></li>
				</ul>
			</div>
	</header>

	<div class="principal">
		<section class="botoes">
			<ul>
				<li><button onclick="location.href='equipe.html'">EQUIPE</button></li>
				<li><button onclick="location.href='docentes.html'">DOCENTES</button></li>
				<li><button onclick="location.href='instituicoesinternas.html'">INSTITUIÇÕES INTERNAS</button></li>
				<li><button onclick="location.href='parcerias.html'">PARCERIAS</button></li>
				<li><button onclick="location.href='cps.html'">CPS</button></li>
				<li><button onclick="location.href='downloads.html'">DOWNLOADS</button></li>
			</ul>
		</section>

		<br><br><br><br>
		<section class="titulo" align="center">
			<p>Equipe ETEC Taboão da Serra</p>
		</section>
		<br><br><br><br>
		<section class="esquerdo">
			<?php
			include_once 'conexao.php';
			$etec = new Etec();
			$etec->carregarEquipe();
			?>

		</section>

	</div>







	<footer>
		<section class="menurodape">
			<ul>
				<li><a href="institucional.html">QUEM&nbspSOMOS</a> </li>
				<li><a href="#">CURSOS</a>
				<li><a href="contato.html">CONTATO</a></li>
				<li><a href="mapa.html">MAPA&nbspSITE</a></li>
			</ul>
		</section>

		<section class="iconrodape">
			<ul>
				<li><a href="https://www.linkedin.com" target="_blank"><img src="_imagens/_logos/Linkedin.png" /></a></li>
				<li><a href="https://www.facebook.com.br" target="_blank"><img src="_imagens/_logos/Facebook.png" /></a></li>
				<li><a href="https://www.instagram.com" target="_blank"><img src="_imagens/_logos/Instagram.png" /></a></li>
				<li><a href="#" target="_blank"><img src="_imagens/_logos/Contato.png" /></a></li>
			</ul>
		</section>

		<section class="logogov">
			<a href="https://www.cps.sp.gov.br/" target="_blank"><img src="_imagens/_logos/logo-cps.png" /></a>
			<a href="http://www.saopaulo.sp.gov.br/" target="_blank"><img src="_imagens/_logos/logo-estado-sp.png" /></a>
		</section>
		<section class="dev">
			<p id="copy">© Todos os direitos reservados | Desenvolvido por <a href="#">Turtle Enterprise</a></p>
		</section>
	</footer>

</body>

</html>