<?php
class BancodeDados
{
	//Informações do BD:
	private $host = "localhost"; //Nome ou IP do Servidor
	private $user = "root"; //Usuário do Servidor MySQL
	private $senha = ""; //Senha do Usuário MySQL
	private $banco = "etec"; //Nome do seu BD
	public $con;

	//Método Responsável para conexão a Base de Dados
	function conecta()
	{
		$this->con = @mysqli_connect($this->host, $this->user, $this->senha, $this->banco);
		//Conecta ao BD
		if (!$this->con) {
			//Caso ocorra um erro, exibe uma msg com o mesmo.
			die("Problemas com a conexão ao banco de dados!");
		}
	}

	//Método Responsável para fechar a conexão
	function fechar()
	{
		mysqli_close($this->con);
		return;
	}

	//Método para executar o SELECT (consultar.php, verexclusao.php, veralteracao.php)
	function sqlquery($string, $caminho)
	{
		//Executando Instrução SQL
		$resultdo = @mysqli_query($this->con, $string);
		if (!$resultado) {
			//echo '<input type = "button" onclick="window.location='."'cadastroUsuario.php'".';"value = "Voltar" <br/> <br/>';
			die('<b> Query Inválida: </b>' . @mysqli_error($this->con));
		} else {
			$num = @mysql_num_rows($resultado);
			if ($num == 0) {
				echo "<b>Código: </b> não localidado! <br/> <br/>";
				echo '<input type = "button" onclick "window.location=' . "'$caminho'" . ';" value="Voltar" <br/> <br/>';
				exit;
			} else {
				$dados = mysqli_fetc_array($resultado);
			}
		}
		$this->fechar(); //Chama o método que fecha a conexão
		return $dados;
	}

	//Método para executar o INSERT, UPDATE e DELETE(incluir.php, alterar.php, excluir.php)
	function sqlstring($string, $texto)
	{
		$resultado = @mysqli_query($this->con, $string);
		if (!$resultado) {
			echo '<input type="button" onclick="window.location=' . "'cadastroUsuario.php'" . ';"value="Voltar"><br/><br/>';
			die('<b>Query Inválida:</b>' . @mysqli_error($mysql->con));
		} else {
			echo "<b>$texto</b> - Realizada com sucesso!";
		}
		$this->fechar(); //Chama o método que fecha a conexão!
		return;
	}
}

class Etec
{

	function logado(){


	//	$log = $_COOKIE["logado"];

    //    if ($log != "true") {
	//		setcookie("logado", "false");
			// echo '<script type="text/javascript"> alert("Sua sessão expirou");
			// window.location="login.html </script>';
			
			
	//		die(header('location:login.html'));
          
      //  }


		

	}

	function cadastrar($nome, $cpf, $email, $senha)
	{

		$this->logado();

		if ($nome != "" && $cpf != "" && $email != "" && $senha != "") {


			include_once('conexao.php');
			//Criando o objeto MySql e conectando ao BD
			$mysql = new BancodeDados();
			$mysql->conecta();
			//Consultando o banco para conferir se algum cadastro com as mesmas informações existe
			$query = mysqli_query($mysql->con, "select * from tbUsuario where loginUsuario='" . $email . "' and senhaUsuario='" . $senha . "' or cpfUsuario='" . $cpf . "';");
			$resultado = mysqli_num_rows($query);


			if (!$query) {
				//vendo se s query naão ira dar erro
				echo '<input type="button" onclick="window.location=' . "'index.html'" . ';" value = "Voltar"<br/> <br/>';
				die('<b>Query Inválida:</b>' . @mysqli_error($mysql->con));
			} else if ($resultado > 0) {
				//resultado caso o usuario exista
				echo '<script>alert("Usuario Ja Existente");history.go(-1);</script>';
			} else if (strlen($senha) < 8) {
				//vendo se a senha digitada tem o numero de caracteres menor que 8
				echo ("<script>alert('A Senha deve ter no minimo 8 caracteres');history.go(-1)</script>");
			} else if ($resultado == 0) {
				//resultado caso o usuario não exista
				$query = mysqli_query($mysql->con, "insert into `Etec`.`tbUsuario` (`nomeUsuario`, `cpfUsuario`, `loginUsuario`, `senhaUsuario`, `usuarioAtivo`) VALUES ('" . $nome . "', '" . $cpf . "', '" . $email . "', '" . $senha . "', '1');");
				//fazendo a inserção no banco      
				echo '<script>alert("Usuario cadastrado com sucesso")</script>';
				header('location:index.html');
			} else {
				//msg de erro caso o usuario não preencha todos os campos
				echo '<script>alert("Preencha todos os campos");history.go(-1)</script>';
			}
		}
	}


	




	function cadastrarCurso($titulo, $descricao, $detalhe)
	{

		$this->logado();

		if ($titulo != "" && $descricao != "") {


			include_once('conexao.php');
			//Criando o objeto MySql e conectando ao BD
			$mysql = new BancodeDados();
			$mysql->conecta();



			mysqli_query($mysql->con, "insert into `etec`.`tbCursos` (`tituloCursos`, `corpoCursos`, `descricaoCursos`, `ativoCurso`) VALUES ('" . $titulo . "', '" . $descricao . "', '" . $detalhe . "', '1');");
			//fazendo a inserção no banco      
			echo '<script>alert("Usuario cadastrado com sucesso")</script>';
			header('location:cursos.php');
		} else {
			//msg de erro caso o usuario não preencha todos os campos
			echo '<script>alert("Preencha todos os campos");history.go(-1)</script>';
		}
	}




	function carregarCurso()
	{


		include_once('conexao.php');
		//Criando o objeto MySql e conectando ao BD
		$mysql = new BancodeDados();
		$mysql->conecta();

		//ajustando a instrução select para ordenar por produto
		$query = mysqli_query($mysql->con, "select * from tbCursos");

		//caso ocorra algum tipo de erro na execução do select
		if (!$query) {
			echo '<input type="button" onclick="window.location=' . "'index.php'" . ';" value = "Voltar"<br/> <br/>';
			die('<b>Query Inválida:</b>' . @mysqli_error($mysql->con));
		}



		echo "<br><br><br>";
		$controle = 0;

		while ($dados = mysqli_fetch_array($query)) {
			if ($dados['ativoCurso'] == 1) {


				if ($controle == 0) {


					echo '<p align="center"><b>' . $dados['tituloCursos'] . '</b></p><br>';
					echo '<table align="center">';

					echo '<tr>';
					echo '<td align="justify">' . $dados['corpoCursos'] . '</td>
						
				</tr>
				<tr>
					<td>
						<br><br><br>
					</td>
				</tr>
				<tr>';
					echo '<td>' . $dados['descricaoCursos'] .


						'</td>
					</tr>
			</table>

			<br><br><br>';
				} else {

					echo '<hr color=black noshade="yes" size=2px>';
					echo "<br><br><br>";

					echo '<p align="center"><b>' . $dados['tituloCursos'] . '</b></p><br>';
					echo '<table align="center">';

					echo '<tr>';
					echo '<td align="justify">' . $dados['corpoCursos'] . '</td>
						
				</tr>
				<tr>
					<td>
						<br><br><br>
					</td>
				</tr>
				<tr>';
					echo '<td>' . $dados['descricaoCursos'] .


						'</td>
					</tr>
			</table>

			<br><br><br>';
				}

				$controle++;
			}
		}

		$mysql->fechar();
	}




	function carregarEditarCurso()
	{

		$this->logado();


		include_once('conexao.php');
		//Criando o objeto MySql e conectando ao BD
		$mysql = new BancodeDados();
		$mysql->conecta();

		//ajustando a instrução select para ordenar por produto
		$query = mysqli_query($mysql->con, "select * from tbCursos");

		//caso ocorra algum tipo de erro na execução do select
		if (!$query) {
			echo '<input type="button" onclick="window.location=' . "'index.php'" . ';" value = "Voltar"<br/> <br/>';
			die('<b>Query Inválida:</b>' . @mysqli_error($mysql->con));
		}



		echo "<br><br>";
		$controle = 0;

		echo '<h2 aling="center"><b>Edição de cursos</b></h2><br><br>';

		echo '<hr color=black noshade="yes" size=2px><br><br>';

		while ($dados = mysqli_fetch_array($query)) {

			if ($dados['ativoCurso'] == 1) {


				if ($controle == 0) {
					echo '<form name="form" class="cadastro" method="POST" action="editarCurso.php">
                <center><br>
                <ul>
                <li><input type="text" name="nomeCurso" id="nomeCurso" size="118px" placeholder="Digite o nome do curso" maxlength="600" value="' . $dados['tituloCursos'] . '"></li><br>
                <li><textarea name="descCurso" id="descCurso" rows="10" cols="120" placeholder="Digite a descrição do curso" maxlength="2000">' . $dados['corpoCursos'] . '</textarea></li><br><br>
                <li><textarea name="detalheCurso" id="detalheCurso" rows="10" cols="120" placeholder="Digite os detalhes do curso" maxlength="2000">' . $dados['descricaoCursos'] . '</textarea></li><br>
				<input type="hidden" name="codigo" id="codigo" value=' . $dados['idCursos'] . '>
				<li><input type="submit" class="bnt" name="editar" placeholder="Editar" value="Editar"> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				<input type="submit" class="bnt" name="excluir" placeholder="Excluir" value="Excluir"></li><br>
				
               </ul>
            </center>
            </form>

				

			<br>';
				} else {
					
					echo '<hr color=black noshade="yes" size=2px>';
					echo '<br><br>';
					echo '<form name="form" class="cadastro" method="POST" action="editarCurso.php">
                <center><br>
                <ul>
                <li><input type="text" name="nomeCurso" id="nomeCurso" size="118px" placeholder="Digite o nome do curso" maxlength="600" value="' . $dados['tituloCursos'] . '"></li><br>
                <li><textarea name="descCurso" id="descCurso" rows="10" cols="120" placeholder="Digite a descrição do curso" maxlength="2000">' . $dados['corpoCursos'] . '</textarea></li><br><br>
                <li><textarea name="detalheCurso" id="detalheCurso" rows="10" cols="120" placeholder="Digite os detalhes do curso" maxlength="2000">' . $dados['descricaoCursos'] . '</textarea></li><br>
				<input type="hidden" name="codigo" id="codigo" value=' . $dados['idCursos'] . '>
				<li><input type="submit" class="bnt" name="editar" placeholder="Editar" value="Editar"> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				<input type="submit" class="bnt" name="excluir" placeholder="Excluir" value="Excluir" ></li><br>
				
              </ul>
            </center>
            </form>

			<br><br><br>';
				}

				$controle++;
			}
		}

		$mysql->fechar();
	}


	function excluirEditarCurso($tipo, $titulo, $descricao, $detalhe, $id)
	{
		$this->logado();

		if ($tipo == "editar") {



			if ($titulo != "" && $descricao != "") {


				include_once('conexao.php');
				//Criando o objeto MySql e conectando ao BD
				$mysql = new BancodeDados();
				$mysql->conecta();



				mysqli_query($mysql->con, "UPDATE `etec`.`tbcursos` SET `tituloCursos` = '$titulo', `corpoCursos` = '$descricao', `descricaoCursos` = '$detalhe' WHERE (`idCursos` = '$id');");
				//fazendo a inserção no banco      
				echo '<script>alert("Alteração efetuada com sucesso")</script>';
				header('location:cursos.php');
			} else {
				//msg de erro caso o usuario não preencha todos os campos
				echo '<script>alert("Preencha todos os campos");history.go(-1)</script>';
			}
		} else if ($tipo == "excluir") {
			if ($titulo != "" && $descricao != "") {


				include_once('conexao.php');
				//Criando o objeto MySql e conectando ao BD
				$mysql = new BancodeDados();
				$mysql->conecta();




				mysqli_query($mysql->con, "UPDATE `etec`.`tbcursos` SET `ativoCurso` = '0' WHERE (`idCursos` = '$id');");
				//fazendo a inserção no banco      
				echo '<script>alert("Alteração efetuada com sucesso")</script>';
				header('location:cursos.php');
			} else {
				//msg de erro caso o usuario não preencha todos os campos
				echo '<script>alert("Preencha todos os campos");history.go(-1)</script>';
			}
		}
		$mysql->fechar();
	}















	function carregarEquipe()
	{


		include_once('conexao.php');
		//Criando o objeto MySql e conectando ao BD
		$mysql = new BancodeDados();
		$mysql->conecta();

		//ajustando a instrução select para ordenar por produto
		$query = mysqli_query($mysql->con, "select * from tbequipe");

		//caso ocorra algum tipo de erro na execução do select
		if (!$query) {
			echo '<input type="button" onclick="window.location=' . "'index.html'" . ';" value = "Voltar"<br/> <br/>';
			die('<b>Query Inválida:</b>' . @mysqli_error($mysql->con));
		}

		

		while ($dados = mysqli_fetch_array($query)) {
			if ($dados['ativoEquipe'] == 1) {


				echo '<table>';
				echo '<tr><td>Nome:</td><td>' . $dados['nomeEquipe'] . '</td></tr>';
				echo '<tr><td>CPF:</td><td>' . $dados['cpfEquipe'] . '</td></tr>';
				echo '<tr><td>Telefone:</td><td>' . $dados['telEquipe'] . '</td></tr>';
				echo '<tr><td>Endereço:</td><td>' . $dados['endEquipe'] . '</td></tr>';
				echo '</table>';
				echo '<br><br><br>';
			}
		}

		$mysql->fechar();
	}



	function cadastrarEquipe($nomeEquipe, $cpfEquipe, $telEquipe, $endEquipe)
	{
		$this->logado();



		if ($nomeEquipe != "" && $cpfEquipe != "" && $telEquipe != "" && $endEquipe != "") {


			include_once('conexao.php');
			//Criando o objeto MySql e conectando ao BD
			$mysql = new BancodeDados();
			$mysql->conecta();


			mysqli_query($mysql->con, "insert into `etec`.`tbequipe` (`nomeEquipe`, `cpfEquipe`, `telEquipe`, `endEquipe`, `ativoEquipe`) VALUES ('" . $nomeEquipe . "', '" . $cpfEquipe . "', '" . $telEquipe . "', '" . $endEquipe . "', '1');");
			//fazendo a inserção no banco      
			echo '<script>alert("Novo voluntário cadastrado com sucesso");history.go(-1)</script>';
			//header('location:cursos.php');
		} else {
			//msg de erro caso o usuario não preencha todos os campos
			echo '<script>alert("Preencha todos os campos");history.go(-1)</script>';
		}
	}





	function carregarEditarEquipe()
	{
		$this->logado();


		include_once('conexao.php');
		//Criando o objeto MySql e conectando ao BD
		$mysql = new BancodeDados();
		$mysql->conecta();

		//ajustando a instrução select para ordenar por produto
		$query = mysqli_query($mysql->con, "select * from tbequipe");


		echo "<br><br>";

		$controle=0;
		echo '<h2 aling="center"><b>Voluntários</b></h2><br><br>';

		echo '<hr color=black noshade="yes" size=2px><br><br>';


		while ($dados = mysqli_fetch_array($query)) {

			if ($dados['ativoEquipe'] == 1) {


				if ($controle == 0) {

				echo '<form name="form" enctype="multipart/form-data" action="editarEquipe.php" class="cadastro" method="POST">';
				echo '<center>';

				echo '<ul>
				<p>Nome:</p>';
				echo '<li><input type="text" name="nomeEquipe" id="nomeEquipe" placeholder="Digite o nome" maxlength="500" size="40px" value="' . $dados['nomeEquipe'] . '"></li><br>';
				echo '<p>Informe o CPF:</p>';
				echo '<li><input type="text" name="cpfEquipe" id="cpfEquipe" placeholder="Digite o CPF" maxlength="400"  size="40px"  value="' . $dados['cpfEquipe'] . '"></li><br>';
				echo '<p>Informe o telefone:</p>
				<li><input type="text" name="telEquipe" id="telEquipe" placeholder="Digite o telefone" maxlength="1000" size="40px" value="' . $dados['telEquipe'] . '"></li><br>';
				echo '<p>Informe o endereço:</p>
				<li><input type="text" name="endEquipe" id="endEquipe" placeholder="Digite o endereço" maxlength="300" size="40px" value="' . $dados['endEquipe'] . '"></li>
				<br><br><br>';
				echo '<input type="hidden" name="id" value="' . $dados['idEquipe'] . '">
				<li><input type="submit" id="editar" name="editar" placeholder="Editar" value="Editar">  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
				echo '<input type="submit" id="excluir" name="excluir" placeholder="Excluir" value="Excluir"></li><br><br>
            	</ul>
            	</center>
				</form>';

				
				}else{


					echo '<hr color=black noshade="yes" size=2px>';

					echo '<br><br><br>';

					echo '<form name="form" enctype="multipart/form-data" action="editarEquipe.php" class="cadastro" method="POST">';
				echo '<center>';

				echo '<ul>
				<p>Nome:</p>';
				echo '<li><input type="text" name="nomeEquipe" id="nomeEquipe" placeholder="Digite o nome" maxlength="500" size="40px" value="' . $dados['nomeEquipe'] . '"></li><br>';
				echo '<p>Informe o CPF:</p>';
				echo '<li><input type="text" name="cpfEquipe" id="cpfEquipe" placeholder="Digite o CPF" maxlength="400"  size="40px"  value="' . $dados['cpfEquipe'] . '"></li><br>';
				echo '<p>Informe o telefone:</p>
				<li><input type="text" name="telEquipe" id="telEquipe" placeholder="Digite o telefone" maxlength="1000" size="40px" value="' . $dados['telEquipe'] . '"></li><br>';
				echo '<p>Informe o endereço:</p>
				<li><input type="text" name="endEquipe" id="endEquipe" placeholder="Digite o endereço" maxlength="300" size="40px" value="' . $dados['endEquipe'] . '"></li>
				<br><br><br>';
				echo '<input type="hidden" name="id" value="' . $dados['idEquipe'] . '">
				<li><input type="submit" id="editar" name="editar" placeholder="Editar" value="Editar">  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
				echo '<input type="submit" id="excluir" name="excluir" placeholder="Excluir" value="Excluir"></li><br><br>
            	</ul>
            	</center>
				</form>';

				echo '<br><br>';
				}
				$controle++;
			}
		}

		$mysql->fechar();
	}







	function excluirEditarEquipe($tipo, $id, $nome, $cargo, $atividade, $titulacao)
	{


		$this->logado();

		if ($tipo == "editar") {


			if ($nome != "" && $cargo != "" && $atividade != "" && $titulacao != "") {


				include_once('conexao.php');
				//Criando o objeto MySql e conectando ao BD
				$mysql = new BancodeDados();
				$mysql->conecta();



				mysqli_query($mysql->con, "UPDATE `etec`.`tbequipe` SET `nomeEquipe` = '$nome', `cpfEquipe` = '$cargo', `telEquipe` = '$atividade', `endEquipe` = '$titulacao' WHERE (`idEquipe` = '$id');");
				//fazendo a inserção no banco      
				echo '<script>alert("Alteração efetuada com sucesso");history.go(-1)</script>';
				//header('location:cursos.php');
			} else {
				//msg de erro caso o usuario não preencha todos os campos
				echo '<script>alert("Preencha todos os campos");history.go(-1)</script>';
			}
		} else if ($tipo == "excluir") {
			if ($nome != "" && $cargo != "" && $atividade != "" && $titulacao != "") {


				include_once('conexao.php');
				//Criando o objeto MySql e conectando ao BD
				$mysql = new BancodeDados();
				$mysql->conecta();




				mysqli_query($mysql->con, "UPDATE `etec`.`tbequipe` SET `ativoEquipe` = '0' WHERE (`idEquipe` = '$id');");
				//fazendo a inserção no banco      
				echo '<script>alert("Exclusão efetuada com sucesso");history.go(-1)</script>';
				//header('location:cursos.php');
			} else {
				//msg de erro caso o usuario não preencha todos os campos
				echo '<script>alert("Preencha todos os campos");history.go(-1)</script>';
			}
		}
		$mysql->fechar();
	}









	





	function cadastrarAdotante($nomeEquipe, $cpfEquipe, $telEquipe, $endEquipe)
	{
		$this->logado();



		if ($nomeEquipe != "" && $cpfEquipe != "" && $telEquipe != "" && $endEquipe != "") {


			include_once('conexao.php');
			//Criando o objeto MySql e conectando ao BD
			$mysql = new BancodeDados();
			$mysql->conecta();


			mysqli_query($mysql->con, "insert into `etec`.`tbadotante` (`nomeAdo`, `cpfAdo`, `telAdo`, `endAdo`, `ativoEquipe`) VALUES ('" . $nomeEquipe . "', '" . $cpfEquipe . "', '" . $telEquipe . "', '" . $endEquipe . "', '1');");
			//fazendo a inserção no banco      
			echo '<script>alert("Novo voluntário cadastrado com sucesso");history.go(-1)</script>';
			//header('location:cursos.php');
		} else {
			//msg de erro caso o usuario não preencha todos os campos
			echo '<script>alert("Preencha todos os campos");history.go(-1)</script>';
		}
	}



	function carregarAdotante()
	{


		include_once('conexao.php');
		//Criando o objeto MySql e conectando ao BD
		$mysql = new BancodeDados();
		$mysql->conecta();

		//ajustando a instrução select para ordenar por produto
		$query = mysqli_query($mysql->con, "select * from tbadotante");

		//caso ocorra algum tipo de erro na execução do select
		if (!$query) {
			echo '<input type="button" onclick="window.location=' . "'index.html'" . ';" value = "Voltar"<br/> <br/>';
			die('<b>Query Inválida:</b>' . @mysqli_error($mysql->con));
		}

		

		while ($dados = mysqli_fetch_array($query)) {
			if ($dados['ativoEquipe'] == 1) {


				echo '<table>';
				echo '<tr><td>Nome:</td><td>' . $dados['nomeAdo'] . '</td></tr>';
				echo '<tr><td>CPF:</td><td>' . $dados['cpfAdo'] . '</td></tr>';
				echo '<tr><td>Telefone:</td><td>' . $dados['telAdo'] . '</td></tr>';
				echo '<tr><td>Endereço:</td><td>' . $dados['endAdo'] . '</td></tr>';
				echo '</table>';
				echo '<br><br><br>';
			}
		}

		$mysql->fechar();
	}






	function carregarEditarAdotante()
	{
		$this->logado();


		include_once('conexao.php');
		//Criando o objeto MySql e conectando ao BD
		$mysql = new BancodeDados();
		$mysql->conecta();

		//ajustando a instrução select para ordenar por produto
		$query = mysqli_query($mysql->con, "select * from tbadotante");


		echo "<br><br>";

		$controle=0;
		echo '<h2 aling="center"><b>Adotantes</b></h2><br><br>';

		echo '<hr color=black noshade="yes" size=2px><br><br>';


		while ($dados = mysqli_fetch_array($query)) {

			if ($dados['ativoEquipe'] == 1) {


				if ($controle == 0) {

				echo '<form name="form" enctype="multipart/form-data" action="editarAdotante.php" class="cadastro" method="POST">';
				echo '<center>';

				echo '<ul>
				<p>Nome:</p>';
				echo '<li><input type="text" name="nomeEquipe" id="nomeEquipe" placeholder="Digite o nome" maxlength="500" size="40px" value="' . $dados['nomeAdo'] . '"></li><br>';
				echo '<p>Informe o CPF:</p>';
				echo '<li><input type="text" name="cpfEquipe" id="cpfEquipe" placeholder="Digite o CPF" maxlength="400"  size="40px"  value="' . $dados['cpfAdo'] . '"></li><br>';
				echo '<p>Informe o telefone:</p>
				<li><input type="text" name="telEquipe" id="telEquipe" placeholder="Digite o telefone" maxlength="1000" size="40px" value="' . $dados['telAdo'] . '"></li><br>';
				echo '<p>Informe o endereço</p>
				<li><input type="text" name="endEquipe" id="endEquipe" placeholder="Digite o endereço" maxlength="300" size="40px" value="' . $dados['endAdo'] . '"></li>
				<br><br><br>';
				echo '<input type="hidden" name="id" value="' . $dados['idAdo'] . '">
				<li><input type="submit" id="editar" name="editar" placeholder="Editar" value="Editar">  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
				echo '<input type="submit" id="excluir" name="excluir" placeholder="Excluir" value="Excluir"></li><br><br>
            	</ul>
            	</center>
				</form>';

				
				}else{


					echo '<hr color=black noshade="yes" size=2px>';

					echo '<br><br><br>';

					echo '<form name="form" enctype="multipart/form-data" action="editarAdotante.php" class="cadastro" method="POST">';
				echo '<center>';

				echo '<ul>
				<p>Nome:</p>';
				echo '<li><input type="text" name="nomeEquipe" id="nomeEquipe" placeholder="Digite o nome" maxlength="500" size="40px" value="' . $dados['nomeAdo'] . '"></li><br>';
				echo '<p>Informe o CPF:</p>';
				echo '<li><input type="text" name="cpfEquipe" id="cpfEquipe" placeholder="Digite o CPF" maxlength="400"  size="40px"  value="' . $dados['cpfAdo'] . '"></li><br>';
				echo '<p>Informe o telefone:</p>
				<li><input type="text" name="telEquipe" id="telEquipe" placeholder="Digite o telefone" maxlength="1000" size="40px" value="' . $dados['telAdo'] . '"></li><br>';
				echo '<p>Informe o endereço</p>
				<li><input type="text" name="endEquipe" id="endEquipe" placeholder="Digite o endereço" maxlength="300" size="40px" value="' . $dados['endAdo'] . '"></li>
				<br><br><br>';
				echo '<input type="hidden" name="id" value="' . $dados['idAdo'] . '">
				<li><input type="submit" id="editar" name="editar" placeholder="Editar" value="Editar">  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
				echo '<input type="submit" id="excluir" name="excluir" placeholder="Excluir" value="Excluir"></li><br><br>
            	</ul>
            	</center>
				</form>';

				echo '<br><br>';
				}
				$controle++;
			}
		}

		$mysql->fechar();
	}




	function excluirEditarAdotante($tipo, $id, $nome, $cargo, $atividade, $titulacao)
	{


		$this->logado();

		if ($tipo == "editar") {


			if ($nome != "" && $cargo != "" && $atividade != "" && $titulacao != "") {


				include_once('conexao.php');
				//Criando o objeto MySql e conectando ao BD
				$mysql = new BancodeDados();
				$mysql->conecta();



				mysqli_query($mysql->con, "UPDATE `etec`.`tbadotante` SET `nomeAdo` = '$nome', `cpfAdo` = '$cargo', `telAdo` = '$atividade', `endAdo` = '$titulacao' WHERE (`idAdo` = '$id');");
				//fazendo a inserção no banco      
				echo '<script>alert("Alteração efetuada com sucesso");history.go(-1)</script>';
				//header('location:cursos.php');
			} else {
				//msg de erro caso o usuario não preencha todos os campos
				echo '<script>alert("Preencha todos os campos");history.go(-1)</script>';
			}
		} else if ($tipo == "excluir") {
			if ($nome != "" && $cargo != "" && $atividade != "" && $titulacao != "") {


				include_once('conexao.php');
				//Criando o objeto MySql e conectando ao BD
				$mysql = new BancodeDados();
				$mysql->conecta();




				mysqli_query($mysql->con, "UPDATE `etec`.`tbadotante` SET `ativoEquipe` = '0' WHERE (`idAdo` = '$id');");
				//fazendo a inserção no banco      
				echo '<script>alert("Exclusão efetuada com sucesso");history.go(-1)</script>';
				//header('location:cursos.php');
			} else {
				//msg de erro caso o usuario não preencha todos os campos
				echo '<script>alert("Preencha todos os campos");history.go(-1)</script>';
			}
		}
		$mysql->fechar();
	}








	function cadastrarAnimal($cadNomeAnimal, $cadTipoAnimal, $cadRacaAnimal, $cadCorAnimal)
	{

		$this->logado();

		if ($cadNomeAnimal != "" && $cadTipoAnimal != "" && $cadRacaAnimal != "" && $cadCorAnimal != "") {


			include_once('conexao.php');
			//Criando o objeto MySql e conectando ao BD
			$mysql = new BancodeDados();
			$mysql->conecta();
			//Consultando o banco para conferir se algum cadastro com as mesmas informações existe
			$query = mysqli_query($mysql->con, "select * from tbanimal where nomeAnimal='" . $cadNomeAnimal . "' and racaAnimal='" . $cadRacaAnimal . "' and corAnimal='" . $cadCorAnimal . "';");
			$resultado = mysqli_num_rows($query);


			if (!$query) {
				//vendo se s query naão ira dar erro
				echo '<input type="button" onclick="window.location=' . "'index.html'" . ';" value = "Voltar"<br/> <br/>';
				die('<b>Query Inválida:</b>' . @mysqli_error($mysql->con));
			} else if ($resultado > 0) {
				//resultado caso o usuario exista
				echo '<script>alert("Animal já existente");history.go(-1);</script>';
			}  else if ($resultado == 0) {
				//resultado caso o usuario não exista
				$query = mysqli_query($mysql->con, "insert into `Etec`.`tbanimal` (`nomeAnimal`, `tipoAnimal`, `racaAnimal`, `corAnimal`, `ativoEquipe`) VALUES ('" . $cadNomeAnimal . "', '" . $cadTipoAnimal . "', '" . $cadRacaAnimal . "', '" . $cadCorAnimal . "', '1');");
				//fazendo a inserção no banco      
				echo '<script>alert("Animal cadastrado com sucesso");history.go(-1)</script>';
				header('location:index.html');
			} else {
				//msg de erro caso o usuario não preencha todos os campos
				echo '<script>alert("Preencha todos os campos");history.go(-1)</script>';
			}
		}
	}




	function carregarAnimal()
	{


		include_once('conexao.php');
		//Criando o objeto MySql e conectando ao BD
		$mysql = new BancodeDados();
		$mysql->conecta();

		//ajustando a instrução select para ordenar por produto
		$query = mysqli_query($mysql->con, "select * from tbanimal");

		//caso ocorra algum tipo de erro na execução do select
		if (!$query) {
			echo '<input type="button" onclick="window.location=' . "'index.html'" . ';" value = "Voltar"<br/> <br/>';
			die('<b>Query Inválida:</b>' . @mysqli_error($mysql->con));
		}

		

		while ($dados = mysqli_fetch_array($query)) {
			if ($dados['ativoEquipe'] == 1) {


				echo '<table>';
				echo '<tr><td>Nome:</td><td>' . $dados['nomeAnimal'] . '</td></tr>';
				echo '<tr><td>Tipo:</td><td>' . $dados['tipoAnimal'] . '</td></tr>';
				echo '<tr><td>Raça:</td><td>' . $dados['racaAnimal'] . '</td></tr>';
				echo '<tr><td>Cor:</td><td>' . $dados['corAnimal'] . '</td></tr>';
				echo '</table>';
				echo '<br><br><br>';
			}
		}

		$mysql->fechar();
	}







	function carregarEditarAnimal()
	{
		$this->logado();


		include_once('conexao.php');
		//Criando o objeto MySql e conectando ao BD
		$mysql = new BancodeDados();
		$mysql->conecta();

		//ajustando a instrução select para ordenar por produto
		$query = mysqli_query($mysql->con, "select * from tbanimal");


		echo "<br><br>";

$controle=0;
		echo '<h2 aling="center"><b>Edição de animais</b></h2><br><br>';

		echo '<hr color=black noshade="yes" size=2px><br><br>';


		while ($dados = mysqli_fetch_array($query)) {

			if ($dados['ativoEquipe'] == 1) {


				if ($controle == 0) {

				echo '<form name="form" enctype="multipart/form-data" action="editarAnimal.php" class="cadastro" method="POST">';
				echo '<center>';

				echo '<ul>
				<p>Nome:</p>';
				echo '<li><input type="text" name="nomeEquipe" id="nomeEquipe" placeholder="Digite o nome" maxlength="500" size="40px" value="' . $dados['nomeAnimal'] . '"></li><br>';
				echo '<p>Informe o tipo:</p>';
				echo '<li><input type="text" name="cargoEquipe" id="cargoEquipe" placeholder="Digite o tipo" maxlength="400"  size="40px"  value="' . $dados['tipoAnimal'] . '"></li><br>';
				echo '<p>Informe a raça:</p>
				<li><input type="text" name="atividadeEquipe" id="atividadeEquipe" placeholder="Digite a raça" maxlength="1000" size="40px" value="' . $dados['racaAnimal'] . '"></li><br>';
				echo '<p>Informe a cor:</p>
				<li><input type="text" name="titulacaoEquipe" id="titulacaoEquipe" placeholder="Digite a cor" maxlength="300" size="40px" value="' . $dados['corAnimal'] . '"></li>
				<br><br><br>';
				echo '<input type="hidden" name="id" value="' . $dados['idAnimal'] . '">
				<li><input type="submit" id="editar" name="editar" placeholder="Editar" value="Editar">  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
				echo '<input type="submit" id="excluir" name="excluir" placeholder="Excluir" value="Excluir"></li><br><br>
               </ul>
            </center>
			</form>';

				
				}else{


					echo '<hr color=black noshade="yes" size=2px>';

					echo '<br><br><br>';

					echo '<form name="form" enctype="multipart/form-data" action="editarAnimal.php" class="cadastro" method="POST">';
				echo '<center>';

				echo '<ul>
				<p>Nome:</p>';
				echo '<li><input type="text" name="nomeEquipe" id="nomeEquipe" placeholder="Digite o nome" maxlength="500" size="40px" value="' . $dados['nomeAnimal'] . '"></li><br>';
				echo '<p>Informe o tipo:</p>';
				echo '<li><input type="text" name="cargoEquipe" id="cargoEquipe" placeholder="Digite o cargo" maxlength="400"  size="40px"  value="' . $dados['tipoAnimal'] . '"></li><br>';
				echo '<p>Informe a raça:</p>
				<li><input type="text" name="atividadeEquipe" id="atividadeEquipe" placeholder="Digite a atividade" maxlength="1000" size="40px" value="' . $dados['racaAnimal'] . '"></li><br>';
				echo '<p>Informe a cor:</p>
				<li><input type="text" name="titulacaoEquipe" id="titulacaoEquipe" placeholder="Digite a titulação" maxlength="300" size="40px" value="' . $dados['corAnimal'] . '"></li>
				<br><br><br>';
				echo '<input type="hidden" name="id" value="' . $dados['idAnimal'] . '">
				<li><input type="submit" id="editar" name="editar" placeholder="Editar" value="Editar">  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
				echo '<input type="submit" id="excluir" name="excluir" placeholder="Excluir" value="Excluir"></li><br><br>
               </ul>
            </center>
			</form>';

				echo '<br><br>';
				}
				$controle++;
			}
		}

		$mysql->fechar();
	}







	function excluirEditarAnimal($tipo, $id, $nome, $cargo, $atividade, $titulacao)
	{


		$this->logado();

		if ($tipo == "editar") {
		//	echo '<script>alert("'.$nome.','.$cargo.','.$atividade.','.$titulacao.'");history.go(-1)</script>';

			if ($nome != "" && $cargo != "" && $atividade != "" && $titulacao != "") {


				include_once('conexao.php');
				//Criando o objeto MySql e conectando ao BD
				$mysql = new BancodeDados();
				$mysql->conecta();



				mysqli_query($mysql->con, "UPDATE `etec`.`tbanimal` SET `nomeAnimal` = '$nome', `tipoAnimal` = '$cargo', `racaAnimal` = '$atividade', `corAnimal` = '$titulacao' WHERE (`idAnimal` = '$id');");
				//fazendo a inserção no banco      
				echo '<script>alert("Alteração efetuada com sucesso");history.go(-1)</script>';
				//header('location:cursos.php');
			} else {
				//msg de erro caso o usuario não preencha todos os campos
				echo '<script>alert("Preencha todos os campos");history.go(-1)</script>';
			}
		} else if ($tipo == "excluir") {
			if ($nome != "" && $cargo != "" && $atividade != "" && $titulacao != "") {


				include_once('conexao.php');
				//Criando o objeto MySql e conectando ao BD
				$mysql = new BancodeDados();
				$mysql->conecta();




				mysqli_query($mysql->con, "UPDATE `etec`.`tbanimal` SET `ativoEquipe` = '0' WHERE (`idAnimal` = '$id');");
				//fazendo a inserção no banco      
				echo '<script>alert("Animal excluído com sucesso");history.go(-1)</script>';
				//header('location:cursos.php');
			} else {
				//msg de erro caso o usuario não preencha todos os campos
				echo '<script>alert("Preencha todos os campos");history.go(-1)</script>';
			}
		}
		$mysql->fechar();
	}




}
?>