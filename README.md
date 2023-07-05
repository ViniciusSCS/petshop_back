# Sistema de Petshop

Este é um sistema de gerenciamento de petshop desenvolvido usando Laravel 8.

## Recursos Principais

- Cadastro de clientes
- Cadastro de animais
- Agendamento de consultas
- Cadastro de medicamentos
- Controle de estoque de produtos
- Geração de relatórios

## Requisitos do Sistema

- PHP 7.3 ou superior
- Composer
- Laravel 8
- Servidor de banco de dados (por exemplo, MySQL)

## Instalação

1. Clone o repositório ou faça o download do código-fonte do projeto.
2. Navegue até o diretório do projeto via terminal.
3. Execute o comando `composer install` para instalar as dependências do projeto.
4. Renomeie o arquivo `.env.example` para `.env` e configure as variáveis de ambiente, como as credenciais do banco de dados.
5. Execute o comando `php artisan key:generate` para gerar a chave do aplicativo.
6. Execute o comando `php artisan migrate` para criar as tabelas no banco de dados.
7. Execute o comando `php artisan serve` para iniciar o servidor de desenvolvimento.

## Uso

Acesse o sistema através do navegador utilizando a URL fornecida pelo servidor de desenvolvimento. Você será redirecionado para a página de login.

- Faça login usando suas credenciais ou crie uma nova conta.
- Após o login, você terá acesso às funcionalidades do sistema.
- Navegue pelas diferentes seções do sistema para gerenciar clientes, animais, agendamentos de consultas, medicamentos e estoque de produtos.
- Utilize as opções de menu para acessar as diferentes funcionalidades do sistema.

## Contribuição

Contribuições são bem-vindas! Se você encontrar algum problema ou tiver sugestões de melhorias, fique à vontade para abrir uma issue ou enviar um pull request.

## Licença

Este projeto está licenciado sob a [MIT License](https://opensource.org/licenses/MIT).
