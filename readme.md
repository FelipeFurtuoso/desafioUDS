## API REST Laravel 

## Como Usar

Para Cadastrar Cliente:

	Enviar um Post com os campos (endpoint:/customer):

		name = string;
		cpf = string; (deve ser um cpf válido para teste sugiro usar algum gerador de cpf);
		birthdate = no formato Y/M/D (exemplo: 2018-04-15);

Para Cadastrar um Produto:

	Enviar um Post com os campos (endpoint:/product):

		code = string;
		name = string;
		price = valor;

Para Cadastrar um Pedido

	Enviar um Post com os campos (endpoint:/order):

		customer_id = deverá ser enviado (poderá ser resgato na consulta do cliente);

Para Cadastrar um ItemPedido

	Enviar um Post com os campos (endpoint:/orderProduct):
	
		order_id = poderá ser resgatado no get de pedidos;
		product_id = poderá ser resgatado no get dos produtos;
		quantity = valor inteiro;
		discount = deverá ser percentual;



## Em Breve
	....




