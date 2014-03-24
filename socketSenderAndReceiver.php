<?php
	error_reporting(E_ALL);//mostra
	$meuSocket = socket_create(AF_INET,SOCK_STREAM,SOL_TCP);//solicita ao S.O. a criação do socket
	if($meuSocket){//se o S.O. fornecer o socket
		$conexao = socket_connect($meuSocket, "127.0.0.1", 8080);//tenta conectar
		if($conexao){//se o Host responder
			header("Refresh: 1");//manda um "header refressh 'n'" para que o proprio browser atualize a página a cada 'n' segundos.
			header("conten-type: text");//manda um header "content-type text" para ele mostrar o texto bruto recebido.
			$mensagem = '['.date('H:i:s').'] '."Ola, meu nome eh Bravo!\r\n";//cria uma mensagem de texto com a hora do sistema local e uma identificacao.
			socket_write($meuSocket, $mensagem, strlen($mensagem));//manda a mensagem criada anteriormente
			while ($resposta = socket_read($meuSocket, 2048)) {//enquanto tiver caractere de resposta. a funcao socket_read bloqueia o processo e espera pela chegada de algum caractere. dessa forma, deve-se atentar para o tempo que demora a resposta e o tempo maximo de execucao do PHP no servidor que esta executando. Se o Host terminar a conexao, a funcao socket_read retorna falso e o laco se acaba.
				echo $resposta;//manda para o browser do cliente o que foi recebido pelo socket.
			}
			socket_close($meuSocket);//encerra o socket, 'devolvendo-o' ao S.O..
		}else{//se o Host nao responder
			echo "O Host não aceitou a conexão.";
		}
	}else{//se o S.O. nao fornecer o socket
		echo "Não foi possível criar o socket.";
	}
?>
