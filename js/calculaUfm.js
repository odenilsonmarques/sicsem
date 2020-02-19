/*
Essa código executa a função calcularImc disparada atraves do evento onclick quando 
o usuário clica no link calcular.
*/

function calcularUFM(){//Função  
	//recupera o formulario atraves do Id,a variavel criada é para fazer referencia ao formulario e acessar o outros campos do formulario 
	var frminfracao = document.getElementById("frminfracao");
	
	/*Nessa parte chama-se a variavel formulario criada acima,depois recupera o campo chamando
	apenas o nome do mesmo,devido o uso do campo (name),depois recupera o valor inserido no
	campo, a variavel valor_ufm é atribuida para armazenar o valor.O uso do operador unario + 
	garante a conversao para  o tipo correto de dado,não causando nenhum bug no programa, na hora 
	hora de calcular a altura*/
	var valor_infracao = +frminfracao.valor_infracao.value;
	
	
	
	/*Nessa parte do código é necessario criar uma variavel para calcular a altura
	No entanto,a variavel altura é multiplicada por 100 e somada com os centimetros,*/
	var valor_reais = (valor_infracao * 2.40);
	
	
	
	/*Nessa parte é atribuido um valor ao valor campo,o metodo toFixed serve para fixar quantas
	casas aparecerão depois da vigula*/
	frminfracao.valor_reais.value = valor_reais.toFixed(2);
	
}

