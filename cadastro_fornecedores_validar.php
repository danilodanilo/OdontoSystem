<?php
session_start();
include 'conecta_banco.php';
include 'funcoes.php';



$var_controle = $_POST['var_controle'];

if($var_controle == 0){
	
$nomef = $_POST['nome_fornecedor'];
$_SESSION['fornecedor'] = $nomef;
$cnpj = $_POST['cnpj'];
$_SESSION['cnpj'] = $cnpj;
$ie = $_POST['ie'];
$_SESSION['ie'] = $ie;
$tel = $_POST['tel'];
$_SESSION['tel'] = $tel;
$email = $_POST['email'];
$_SESSION['email'] = $email;
$end = $_POST['endereco'];
$_SESSION['endereco'] = $end;
$bairro = $_POST['bairro'];
$_SESSION['bairro'] = $bairro;
$cidade = $_POST['cidade'];
$_SESSION['cidade'] = $cidade;
$estado = $_POST['estado'];
$_SESSION['estado'] = $estado;
$observacoes = $_POST['observacoes'];
$_SESSION['obs'] = $observacoes;

	if(!empty($nomef)){
		
		if (!empty($cnpj)){
			
			$ret_cnpj = isCNPJ($cnpj);
			if($ret_cnpj == false){//cnpj invalido
				
				?>
				<script language="javascript">
				alert("Preencha o campo CNPJ no formato 99.999.999/9999-99");
				window.history.go(-1);
				</script>
				<?php
			}else{
				
				if(!empty($ie)){
					
					if(!empty($tel)){
						
						if(!empty($email)){
							
							$ret_email = validaEmail($email);
							if ($ret_email == false){
								echo 'entrei aqui8';
								?>
										<script language="javascript">
										alert("Preencha o campo email no formato abcdef@abcdef.com.xx");
										window.history.go(-1);
										</script>
								<?php
							}
						}
						
							if (!empty($end)){
								
								if (!empty($bairro)){
								
									if(!empty($cidade)){
										
										if(!empty($estado) && $estado != 'nd'){
											
											
											$sql = mysql_query("insert into fornecedores values ('', '$nomef', '$cnpj', '$ie', '$end', '$bairro', '$cidade', '$estado', '$tel', '$email', '$observacoes', 0)");
											if($sql){
												unset($_SESSION['fornecedor']);
												unset($_SESSION['ie']);
												unset($_SESSION['cnpj']);
												unset($_SESSION['endereco']);
												unset($_SESSION['obs']);
												unset($_SESSION['email']);
												unset($_SESSION['bairro']);
												unset($_SESSION['cidade']);
												unset($_SESSION['estado']);
												unset($_SESSION['fornecedor']);
												unset($_SESSION['tel']);
												?>
												<script language="javascript">
												alert("Fornecedor Cadastrado");
												window.history.go(-1);
												</script>
												<?php
												
											}else{
												?>
													<script language="javascript">
													alert("Ocorreu um erro 2");
													window.history.go(-1);
													</script>
												<?php
											}
										
										}else{
											?>
											<script language="javascript">
											alert("Preencha o campo estado");
											window.history.go(-1);
											</script>
								<?php
										}
									}else{
										?>
										<script language="javascript">
										alert("Preencha o campo cidade");
										window.history.go(-1);
										</script>
								<?php
									}
								}else{
									?>
										<script language="javascript">
										alert("Preencha o campo bairro");
										window.history.go(-1);
										</script>
								<?php
								}
							}else{
								?>
										<script language="javascript">
										alert("Preencha o campo endereço");
										window.history.go(-1);
										</script>
								<?php
							}
						
					}else{
						?>
						<script language="javascript">
						alert("Preencha o campo telefone");
						window.history.go(-1);
						</script>
						<?php
					}
				}else{
					?>
					<script language="javascript">
					alert("Preencha o campo I.E");
					window.history.go(-1);
					</script>
					<?php
				}
			}
		}else{
			?>
			<script language="javascript">
			alert("Preencha o campo CNPJ");
			window.history.go(-1);
			</script>
		<?php
		}
	}else{
		?>
			<script language="javascript">
			alert("Preencha o campo nome do fornecedor");
			window.history.go(-1);
			</script>
		<?php
	}
}
else{
	$id_edit = $_POST['id_edit'];
	$nomef = $_POST['nome_fornecedor_edit'];
	$_SESSION['fornecedor'] = $nomef;
	$cnpj = $_POST['cnpj_edit'];
	$_SESSION['cnpj'] = $cnpj;
	$ie = $_POST['ie_edit'];
	$_SESSION['ie'] = $ie;
	$tel = $_POST['tel_edit'];
	$_SESSION['tel'] = $tel;
	$email = $_POST['email_edit'];
	$_SESSION['email'] = $email;
	$end = $_POST['endereco_edit'];
	$_SESSION['endereco'] = $end;
	$bairro = $_POST['bairro_edit'];
	$_SESSION['bairro'] = $bairro;
	$cidade = $_POST['cidade_edit'];
	$_SESSION['cidade'] = $cidade;
	$estado = $_POST['estado_edit'];
	$_SESSION['estado'] = $estado;
	$observacoes = $_POST['observacoes_edit'];
	$_SESSION['obs'] = $observacoes;
	
if(!empty($nomef)){
		
		if (!empty($cnpj)){
			
			$ret_cnpj = isCNPJ($cnpj);
			if($ret_cnpj == false){//cnpj invalido
				
				?>
				<script language="javascript">
				alert("Preencha o campo CNPJ no formato 99.999.999/9999-99");
				window.history.go(-1);
				</script>
				<?php
			}else{
				
				if(!empty($ie)){
					
					if(!empty($tel)){
						
						if(!empty($email)){
							
							$ret_email = validaEmail($email);
							if ($ret_email == false){
								echo 'entrei aqui8';
								?>
										<script language="javascript">
										alert("Preencha o campo email no formato abcdef@abcdef.com.xx");
										window.history.go(-1);
										</script>
								<?php
							}
						}
						
							if (!empty($end)){
								
								if (!empty($bairro)){
								
									if(!empty($cidade)){
										
										if(!empty($estado) && $estado != 'nd'){
											
											//echo 'entrei auqi';
											$sql3 = mysql_query("update fornecedores set nomef='$nomef', cnpj='$cnpj', ie='$ie', endereco='$end', bairro='$bairro', cidade='$cidade', estado='$estado', telefone='$tel',email='$email', observacoes='$observacoes', controle=0 where id='$id_edit'");
											//echo "update fornecedores set nomef='$nomef', cnpf='$cnpj', ie='$ie', endereco='$end', bairro='$bairro', cidade='$cidade', estado='$estado', telefone='$tel',email='$email', observacoes='$observacoes', controle='$var_controle' where id='$id_edit'";
											if($sql3){
												?>
												<script language="javascript">
												alert("Cadastro Atualizado");
												window.history.go(-1);
												</script>
												<?php
												unset($_SESSION['fornecedor']);
												unset($_SESSION['ie']);
												unset($_SESSION['cnpj']);
												unset($_SESSION['endereco']);
												unset($_SESSION['obs']);
												unset($_SESSION['email']);
												unset($_SESSION['bairro']);
												unset($_SESSION['cidade']);
												unset($_SESSION['estado']);
												unset($_SESSION['fornecedor']);
												unset($_SESSION['tel']);
											}else{
												?>
													<script language="javascript">
													alert("Ocorreu um erro 1");
													window.history.go(-1);
													</script>
												<?php
											}
										
										}else{
											?>
											<script language="javascript">
											alert("Preencha o campo estado");
											window.history.go(-1);
											</script>
								<?php
										}
									}else{
										?>
										<script language="javascript">
										alert("Preencha o campo cidade");
										window.history.go(-1);
										</script>
								<?php
									}
								}else{
									?>
										<script language="javascript">
										alert("Preencha o campo bairro");
										window.history.go(-1);
										</script>
								<?php
								}
							}else{
								?>
										<script language="javascript">
										alert("Preencha o campo endereço");
										window.history.go(-1);
										</script>
								<?php
							}
						
					}else{
						?>
						<script language="javascript">
						alert("Preencha o campo telefone");
						window.history.go(-1);
						</script>
						<?php
					}
				}else{
					?>
					<script language="javascript">
					alert("Preencha o campo I.E");
					window.history.go(-1);
					</script>
					<?php
				}
			}
		}else{
			?>
			<script language="javascript">
			alert("Preencha o campo CNPJ");
			window.history.go(-1);
			</script>
		<?php
		}
	}else{
		?>
			<script language="javascript">
			alert("Preencha o campo nome do fornecedor");
			window.history.go(-1);
			</script>
		<?php
	}
}