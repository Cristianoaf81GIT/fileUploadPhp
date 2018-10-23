<?php

	//verifica se o arquivo chegou
	//$_FILES['imagem'] é um array
	if (isset($_FILES['imagem'])){
		
		//array para armazenar erros
		$erros = array(); 
		
		//armazena o nome do arquivo
		$nome_arquivo = $_FILES['imagem']['name'];
		
		//armazena o tamanho do arquivo 
		$tam_arquivo = $_FILES['imagem']['size'];
		
		//armazena o caminho do diretorio temporário
		//definido automaticamente pelo php
		$temp_arquivo = $_FILES['imagem']['tmp_name'];
		
		//armazena o tipo do arquivo MIME
		$tipo_arquivo = $_FILES['imagem']['type'];
		
				
		//armazena tipos de extencões de arquivos esperados 
		//no servidor
		$extencoes = array("image/jpeg","image/jpg","image/png");
		
		//-------------------------------------------------------
		
		//verifica se o arquivo possui extensão esperada
		//lanca um erro em $erros caso haja alguma disparidade
		if( in_array($tipo_arquivo, $extencoes) == false )
		{
			$erros[] = "extensão de arquivo não permitida,
			escolha um arquivo de extensão jpeg ou png";
			
		}
		
		//verifica se o tamanho do arquivo não excede
		//o maximo permitido 2mb
		if($tam_arquivo > 2097152)
		{
			$erros[]="O tamanho máximo de arquivo permitido é 2 MB";
		}

		//verifica se não existem erros
		//se não existirem translada o arquivo
		//do diretorio temporário para o diretório final
		if(empty($erros) == true)
		{
			move_uploaded_file($temp_arquivo,"img/".$nome_arquivo);
			echo "Arquivo enviado com sucesso!!!<br/><br/>";
			echo "nome do arquivo = ".$nome_arquivo."<br/>";
			echo "tipo de arquivo = ".$tipo_arquivo."<br/>";
		//--------------------------------------------------------------	
			//coleta e extensão do arquivo
			$ext = explode('.',$nome_arquivo);
			//mostra apenas a extenção do arquivo;
			echo "extensão do arquivo = ".$ext[1]."<br/>";
			
			//array com 
			$tamanhos = array("TB","GB","MB","KB","BYTES");
			$total = count($tamanhos);
			while ($total-- && $tam_arquivo > 1024) {
				$tam_arquivo /= 1024;
				echo "tamaho do arquivo = ".round($tam_arquivo,2)
				." $tamanhos[$total]<br/>";
			}	
			
			echo "Diretório temporário = ".$temp_arquivo."<br/>";
			echo "Diretório final + nome arquivo = "."img/"
			.$nome_arquivo."<br/>";
			
			
		}else{
			print_r($erros);
		}
		
    }

?>
