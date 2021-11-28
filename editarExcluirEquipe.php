<!DOCTYPE html>
<html lang="pt-br">
<head>
<title>AjudaCão | Campo Limpo</title>
<meta charset="UTF-8"/>
<link rel="stylesheet" type="text/css" href="_css/home.css"/>
<link rel="stylesheet" type="text/css" href="_css/vestibulinho.css"/>
<link rel="stylesheet" type="text/css" href="_css/responsive.css"/>
<script language="javascript" src="_javascript/funcoes.js"></script>
</head>

<body onload="slide1()">
	
	<header>
		<input type="checkbox" id="barranav">
		<label for="barranav">
		<div><span class="menuham"></span></div>
		
		<nav class="menusuperior"> 
		
		<a href="index.html"><img src="_imagens/_logos/logomenor.png" id="logotipoetec"/></a>
		
		<div class="menunavegacao">
		<ul>
			<li><a href="index.html" data-text="HOME">HOME</a></li>
			<li><a href="animal.html" data-text="Animais">Animais</a></li>
			<li><a href="adotante.html" data-text="Adotantes">Adotantes</a></li>
			<li><a href="voluntario.html" data-text="Volutários">Voluntários</a></li>
			<li><a href="castracao.html" data-text="castracao">Castração</a></li>
		</ul>
		</div>
		</nav>	
		<div class="menusocial">
		<ul>
			<li><a href="https://www.linkedin.com" target="_blank"><img src="_imagens/_logos/Linkedin.png"/></a></li>
			<li><a href="https://www.facebook.com.br" target="_blank"><img src="_imagens/_logos/Facebook.png"/></a></li>
			<li><a href="https://www.instagram.com" target="_blank"><img src="_imagens/_logos/Instagram.png"/></a></li>
			<li><a href="index.html" target="_blank"><img src="_imagens/_logos/Contato.png"/></a></li>
		</ul>
		</div>
	</header>


	
	<div class="vestibulinho" align="center">
        <div id="alterar"> 
            <?php
                include_once 'conexao.php';
                $etec = new Etec();
                $etec->carregarEditarEquipe();
            ?>
        </div>
	</div>









		
	</body>
	</html>