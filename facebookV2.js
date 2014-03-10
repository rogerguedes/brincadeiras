var xmlhttp = new XMLHttpRequest();
xmlhttp.onreadystatechange=function(){
	if(this.readyState == 4){
    var listaDePessoas = this.response.match(/\"list\":[\[\"0-9\,\]-]+/)[0];
		idDasPessoas = listaDePessoas.match(/\d+/g);
		console.log(idDasPessoas);
		
		function iniciaGets(vetorDePessoas,indice){
			var xmlhttp2 = new XMLHttpRequest();
			xmlhttp2.onreadystatechange=function(){
				if(this.response.match(/<a class=\"_8_2\"[\s>\w=\":\/\.]+/) != null && this.readyState == 4){
					tagComNome = this.response.match(/<a class=\"_8_2\"[\s>\w=\":\/\.]+/)[0];
					apenasNome=tagComNome.match(/>.+/)[0].substr(1);
					console.log(indice+": "+tagComNome);
				}
			}
			xmlhttp2.open("GET",vetorDePessoas[indice],true);
			xmlhttp2.send();
			indice++;
			return indice;
		}

		var cont=0;
		var myInterval = setInterval(function () {
			cont = iniciaGets(idDasPessoas,cont);
			if(cont >= idDasPessoas.length){
				console.log("Fim dos "+ cont+" GET's");
				window.clearInterval(myInterval);
			}
		}, 100);

	}
}
xmlhttp.open("GET","/",true);
xmlhttp.send();
