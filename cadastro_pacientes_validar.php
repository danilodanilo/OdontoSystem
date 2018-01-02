<?php
session_start();
//$nome_paciente = $_POST['nome_paciente'];

//include 'globais.php';
include ('conecta_banco.php');
include 'funcoes.php';
echo '<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">';



$var_controle = $_POST['var_controle'];



if($var_controle == 0){
	$nome_paciente = $_POST['nome_paciente'];
	$_SESSION['nome_paciente'] = $nome_paciente;
	$email = $_POST['email'];
	$_SESSION['email'] = $email;
	$data_nascimento = $_POST['dt_nasc'];
	$_SESSION['dt_nasc'] = $data_nascimento;
	$cpf = $_POST['cpf'];
	$_SESSION['cpf'] = $cpf;
	$rg = $_POST['rg'];
	$_SESSION['rg'] = $rg;
	$endereco = $_POST['endereco'];
	$_SESSION['endereco'] = $endereco;
	$bairro = $_POST['bairro'];
	$_SESSION['bairro'] = $bairro;
	$cidade = $_POST['cidade'];
	$_SESSION['cidade'] = $cidade;
	$estado = $_POST['estado'];
	$_SESSION['estado'] = $estado;
	$telefone = $_POST['tel'];
	$_SESSION['tel'] = $telefone;
	$celular = $_POST['cel'];
	$_SESSION['cel'] = $celular;
	$profissao = $_POST['profissao'];
	$_SESSION['profissao'] = $profissao;
	if(!empty($nome_paciente))
	{
		if(!empty($email)){
			$ret_email = validaEmail($email);
					if($ret_email == false){
							?>
									<script language="javascript">
									alert("Preencha o campo email no formato abcdef@abcdef.com.xx");
									window.history.go(-1);
									</script>
							<?php
					}
					
			if(!empty($telefone)){
				//$ret = validaTelefone($telefone);//verificar a esta funcao
				$ret = true;
				if($ret == false){
					?>
					<script language="javascript">
						alert("Telefone Inválido");
						window.history.go(-1);
					</script>
					<?php
				}
				if(!empty($celular)){
					
					if(!empty($cpf)){
						$ret_cpf = validaCPF($cpf);
						if($ret_cpf == false){
							?>
							<script language="javascript">
									alert("Preencha o campo CPF no formato 999.999.99-99");
									window.history.go(-1);
									</script>
							<?php
						}
	
						
	
							if(!empty($rg)){
								if(!empty($data_nascimento)){
									$ret_data = validaData($data_nascimento);
									if($ret_data == false){
									?>
										<script language="javascript">
										alert("Preencha o campo Data no formato DD/MM/AAAA");
										window.history.go(-1);
										</script>
									<?php
									}
									$data_formatada = explode("/", $data_nascimento);
									$data_nasc = $data_formatada[2].'-'.$data_formatada[1].'-'.$data_formatada[0];//formatar data
									if(!empty($profissao)){
										if(!empty($endereco)){
											if(!empty($bairro)){
												if(!empty($cidade)){
													if(!empty($estado) || $estado != 'nd'){
														$sql = mysql_query("INSERT INTO pacientes values (' ', '$nome_paciente','$endereco', '$telefone', '$celular', '$email', '$data_nasc', '$cpf', '$rg', '$bairro', '$cidade', '$estado','$profissao',0)");
																			if($sql){
																				unset($_SESSION['nome_paciente']);
																				unset($_SESSION['email']);
																				unset($_SESSION['dt_nasc']);
																				unset($_SESSION['cpf']);
																				unset($_SESSION['rg']);
																				unset($_SESSION['endereco']);
																				unset($_SESSION['bairro']);
																				unset($_SESSION['cidade']);
																				unset($_SESSION['tel']);
																				unset($_SESSION['cel']);
																				unset($_SESSION['profissao']);
																				?>
																					<script language="javascript">
																							alert("Paciente cadastrado");
																							window.history.go(-1);
																						</script>
																				<?php
																			}
																		
																		else{
																			?>
																				<script language="javascript">
																							alert("Ocorreu um erro");
																							window.history.go(-1);
																						</script>
																			<?php
																		}
													}else{
														//estado vazio
																?>
															<script language="javascript">
															alert("Preencha o campo Estado");
															window.history.go(-1);
															</script>
														<?php
									}
													}else{//cidade vazia
													?>
														<script language="javascript">
														alert("Preencha o campo Cidade");
														window.history.go(-1);
														</script>
													<?php
									}
													}else {
														?>
														<script language="javascript">
														alert("Preencha o campo Bairro");
														window.history.go(-1);
														</script>
													<?php
													}
												}else{
													?>
														<script language="javascript">
														alert("Preencha o campo Endereço");
														window.history.go(-1);
														</script>
													<?php
												}
												
											}else{//profissao vazia
												?>
														<script language="javascript">
														alert("Preencha o campo Profissão");
														window.history.go(-1);
														</script>
													<?php
											}
										}else{//data vazia
											?>
														<script language="javascript">
														alert("Preencha o campo Data de Nascimento");
														window.history.go(-1);
														</script>
													<?php
										}
									
								}else{
									//rg vazio
									?>
	<script language="javascript">
												alert("Preencha o campo RG");
												window.history.go(-1);
												</script>
									<?php
								}
	
							
	
						}else{
							//CPF vazio
							?>
	<script language="javascript">
									alert("Preencha o campo CPF no formato 999.999.99-99");
									window.history.go(-1);
									</script>
							<?php
						}
							
					}else{
						//celular vazio
						?>
	<script language="javascript">
								alert("Preencha o campo Celular");
								window.history.go(-1);
								</script>
						<?php
					}
				}else{
					//cpf vazio
					?>
	<script language="javascript">
							alert("Preencha o campo Telefone");
							window.history.go(-1);
						</script>
					<?php
				}
			}else{
				//email vazio
				?>
	<script language="javascript">
							alert("Preencha o campo E-mail");
							window.history.go(-1);
						</script>
				<?php
	
			}
		
}else{
	?>
<script language="javascript">
		alert("Preencha o campo Nome do Paciente");
		window.history.go(-1);
	</script>
	<?php
}
}else{
	$id_edit = $_POST['id_edit'];
	$nome_paciente_edit = $_POST['nome_paciente_edit'];
	$_SESSION['nome_paciente'] = $nome_paciente_edit;
	$email_edit = $_POST['email_edit'];
	$_SESSION['email_edit'] = $email_edit;
	$data_nascimento_edit = $_POST['dt_nasc_edit'];
	$_SESSION['dt_nasc'] = $data_nascimento_edit;
	$cpf_edit = $_POST['cpf_edit'];
	$_SESSION['cpf'] = $cpf_edit;
	$rg_edit = $_POST['rg_edit'];
	$_SESSION['rg'] = $rg_edit;
	$endereco_edit = $_POST['endereco_edit'];
	$_SESSION['endereco'] = $endereco_edit;
	$bairro_edit = $_POST['bairro_edit'];
	$_SESSION['bairro'] = $bairro_edit;
	$cidade_edit = $_POST['cidade_edit'];
	$_SESSION['cidade'] = $cidade_edit;
	$estado_edit = $_POST['estado_edit'];
	$_SESSION['estado'] = $estado_edit;
	$telefone_edit = $_POST['tel_edit'];
	$_SESSION['tel'] = $telefone_edit;
	$celular_edit = $_POST['cel_edit'];
	$_SESSION['cel'] = $celular_edit;
	$profissao_edit = $_POST['profissao_edit'];
	$_SESSION['profissao'] = $profissao_edit;
	if(!empty($nome_paciente_edit))
	{
		if(!empty($email_edit)){
			$ret_email= validaEmail($email_edit);
					if($ret_email == false){
							?>
									<script language="javascript">
									alert("Preencha o campo email no formato abcdef@abcdef.com.xx");
									window.history.go(-1);
									</script>
							<?php
					}
					
			if(!empty($telefone_edit)){
				//$ret = validaTelefone($telefone_edit);//verificar essa funcao
				$ret = true;
				if($ret == false){
					?>
					<script language="javascript">
						alert("Telefone Inválido");
						window.history.go(-1);
					</script>
					<?php
				}
				if(!empty($celular_edit)){
					
					if(!empty($cpf_edit)){
						$ret_cpf = validaCPF($cpf_edit);
						if($ret_cpf == false){
							?>
							<script language="javascript">
									alert("Preencha o campo CPF no formato 999.999.99-99");
									window.history.go(-1);
									</script>
							<?php
						}
	
						
	
							if(!empty($rg_edit)){
								if(!empty($data_nascimento_edit)){
									$ret_data = validaData($data_nascimento_edit);
									if($ret_data == false){
									?>
										<script language="javascript">
										alert("Preencha o campo Data no formato DD/MM/AAAA");
										window.history.go(-1);
										</script>
									<?php
									}
									$data_formatada = explode("/", $data_nascimento_edit);
									$data_nasc_edit = $data_formatada[2].'-'.$data_formatada[1].'-'.$data_formatada[0];//formatar data
									if(!empty($profissao_edit)){
										if(!empty($endereco_edit)){
											if(!empty($bairro_edit)){
												if(!empty($cidade_edit)){
													if(!empty($estado_edit) || $estado_edit != 'nd'){
														$sql = mysql_query("update pacientes set nome='$nome_paciente_edit', endereco='$endereco_edit', telefone='$telefone_edit', celular='$celular_edit', email='$email_edit', dt_nasc='$data_nasc_edit', cpf='$cpf_edit', rg='$rg_edit', bairro='$bairro_edit', cidade='$cidade_edit', estado='$estado_edit', profissao='$profissao_edit' where id='$id_edit' ");
																			if($sql){
																				unset($_SESSION['nome_paciente']);
																				unset($_SESSION['email']);
																				unset($_SESSION['dt_nasc']);
																				unset($_SESSION['cpf']);
																				unset($_SESSION['rg']);
																				unset($_SESSION['endereco']);
																				unset($_SESSION['bairro']);
																				unset($_SESSION['cidade']);
																				unset($_SESSION['tel']);
																				unset($_SESSION['cel']);
																				unset($_SESSION['profissao']);
																				?>
																					<script language="javascript">
																							alert("Informações salvas com sucesso");
																							window.history.go(-1);
																						</script>
																				<?php
																			}
																		
																		else{
																			?>
																				<script language="javascript">
																							alert("Ocorreu um erro");
																							window.location.href = 'novo_pacientes.php';;
																						</script>
																			<?php
																		}
													}else{
														//estado vazio
																?>
															<script language="javascript">
															alert("Preencha o campo Estado");
															window.history.go(-1);
															</script>
														<?php
									}
													}else{//cidade vazia
													?>
														<script language="javascript">
														alert("Preencha o campo Cidade");
														window.history.go(-1);
														</script>
													<?php
									}
													}else {
														?>
														<script language="javascript">
														alert("Preencha o campo Bairro");
														window.history.go(-1);
														</script>
													<?php
													}
												}else{
													?>
														<script language="javascript">
														alert("Preencha o campo Endereço");
														window.history.go(-1);
														</script>
													<?php
												}
												
											}else{//profissao vazia
												?>
														<script language="javascript">
														alert("Preencha o campo Profissão");
														window.history.go(-1);
														</script>
													<?php
											}
										}else{//data vazia
											?>
														<script language="javascript">
														alert("Preencha o campo Data de Nascimento");
														window.history.go(-1);
														</script>
													<?php
										}
									
								}else{
									//rg vazio
									?>
	<script language="javascript">
												alert("Preencha o campo RG");
												window.history.go(-1);
												</script>
									<?php
								}
	
							
	
						}else{
							//CPF vazio
							?>
	<script language="javascript">
									alert("Preencha o campo CPF no formato 999.999.99-99");
									window.history.go(-1);
									</script>
							<?php
						}
							
					}else{
						//celular vazio
						?>
	<script language="javascript">
								alert("Preencha o campo Celular");
								window.history.go(-1);
								</script>
						<?php
					}
				}else{
					//cpf vazio
					?>
	<script language="javascript">
							alert("Preencha o campo Telefone");
							window.history.go(-1);
						</script>
					<?php
				}
			}else{
				//email vazio
				?>
	<script language="javascript">
							alert("Preencha o campo E-mail");
							window.history.go(-1);
						</script>
				<?php
	
			}
		
	}else{
		?>
	<script language="javascript">
			alert("Preencha o campo Nome do Paciente");
			window.history.go(-1);
		</script>
		<?php
}
}