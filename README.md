
## SOLUÇÃO

[rits.renatodev.com.br](http://rits.renatodev.com.br).

## SOBRE MIM

Olá! Me chamo Renato Souza de Oliveira, moro em Vitória da Conquista-BA, sou formado em Sistemas de Informação e sou desenvolvedor web full stack há vários anos. Minha Stack de trabalho hoje é Laravel (PHP), NodeJs (Javascript) para backend e VueJs, ReactJs no Frontend. Também já desenvolvi vários projetos mobile com react native. Além da minha stack atual, trabalhei vários anos com jquery e tecnologias de frontend não reativas.

Sobre minha experiência profissional, trabalhei por muito anos em SoftHouse's. Dentre elas a Agência Dona Graça (agência de desenvolvimento de software) e algumas outras. Na vida profissional, na maioria das agências, eu trabalhei com algumas plataformas de ecommerce. Na última agência eu participei ativamente do desenvolvimento de uma plataforma própria de loja virtual nos moldes da Loja Integrada. Também trabalhei no desenvolvimento de Software para Gestão de Empresas (ERP) dentre diversos outros ramos.

## DESAFIO RITS

Para o desafio da Rits, eu desenvolvi uma solução em laravel (no backend) e usei VueJs (no Frontend). O desafio era desenvolver uma ferramenta de pedidos para uma lanchonete. Pensando na problemática, visualizei que o sistema deveria obrigatoriamente intuitivo de e compatível com dispositivos mobile. Uma vez que a maioria das pessoas utilizam seus smartphones para realizar pedidos. 

Com isso foram desenvolvidos dois layouts. Um primeiro bem intuitivo para o cliente realizar os pedidos. Esse layout é totalmente responsivo. Já o segundo layout é para o administrador do sistema gerir os pedidos, produtos etc. Este segundo layout basicamente é um painel administrativo padrão.

## A SOLUÇÃO

- 1 - O cliente não precisará estar logado para iniciar um pedido. Obrigar o cliente a realizar o login acaba perdendo conversão de - vendas. Ele monta o pedido e quando for fechar que o sistema apresentará a tela de login/cadastro;
- 2 - O cliente poderá logar ou se cadastrar sem sair da tela de pedido. Isso também deixa o fluxo mais simples aumentando a conversão de vendas;
- 3 - Após logado, o usuário poderá visualizar os seus pedidos clicando no menu Meus Pedido;
- 4 - Na api foi utilizado o padrão Service Layer. As validações foram realizadas no controller e as rotas agrupadas de acordo a modularização proposto no desafio;
- 5 - Foi utilizado o passport do próprio laravel para o sistema de autenticação da api;
- 6 - Foi utilizado queue para colocar as ações de disparo de e-mails na fila;
- 7 - Todos os requisitos e validações propostos no desafio foram implementados.
- 8 - Tenho total domínio para implementar os diferenciais impostos no desafio, porém, visando entregar logo a solução com medo de outro candidato conquistar a vaga em minha frente, decidi não implementá-las. Trabalho com websocket e também já fiz integração com telegram. Não teria dificuldade em implementar os diferenciais;

## INSTALAÇÃO E EXECUÇÃO DO PROJETO

O projeto foi desenvolvido utilizando a última versão estável do laravel 7.*. A instalação da api é a mesma para qualquer projeto em laravel:

- 1 - rodar: composer install (instalar as dependências do laravel)
- 2 - php artisan migrate (criar as tabelas do banco)
- 3 - php artisan passport:install --force (criar as chaves de autenticação)
- 4 - criar um arquivo .env a partir do arquivo .env.example (alterando apenas credenciais do banco)
- 5 - rodar a fila: php artisan queue:work --timeout=0
- 6 - A variável de e-mail do arquivo .env solicitado no desafio se chama: MAIL_NEW_SALE=

Para instalar e rodar o front

- 1 - rodar: npm install
- 2 - inserir a url de acesso a api no arquivo .env.development
- 3 - rodar npm run serve

## CONSIDERAÇÕES

Acredito que posso contribuir muito com vocês. Sou dedicado e extremamente determinado. Qualquer dúvida ou observações, meu zap é: (77) 988045503 - E-mail: renatosistemas.vc@gmail.com

## REPOSITÓRIOS

- [Repositório API](https://github.com/renatosistemasvc/desafio-rits-api).
- [Repositório Web](https://github.com/renatosistemasvc/desafio-rits-web).