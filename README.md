# Sistema de Comentários - Seleção Back-End
Bem-vindo! Este é um sistema desenvolvido para gerenciar comentários sobre produtos. Apesar do objetivo inicial ser apenas a criação de uma API, desenvolvi um site completo para apresentar as funcionalidades. Ainda assim, acredito que o projeto se alinha ao cenário solicitado.

#### Pré-requisitos:
- Um gerenciador de banco de dados (como XAMPP ou similar);
- Composer instalado em sua máquina;
- PHP versão 7.3 ou superior.

#### O sistema já possui um usuário administrador pré-cadastrado:
- Email: admin@admin.com
- Senha: admin

#### Passo a passo para executar o projeto:
- Clone o repositório:
``` git clone <url-do-repositorio> ```
``` cd <pasta-do-projeto> ```
- Instale as dependências: 
``` composer install ```
- Verifique se o arquivo .env possui uma chave gerada no campo "APP_key". Caso não tenha, execute o comando abaixo para gerar uma:
``` php artisan key:generate ```
- No gerenciador de bancos de dados, crie um banco chamado "selecao";
- No terminal do projeto execute as migrations e os seeders:
- ``` php artisan migrate ``` 
- ``` php artisan db:seed ```
- Inicie o servidor utilizando o seguinte código: 
``` php artisan serve ```

### Funcionalidades do Sistema
#### Obrigatórias:
- Registro de usuários, login e gerenciamento de usuários (disponível apenas para administradores);
- Para a autenticação de usuários estou usando a biblioteca Livewire do Laravel;
- Ao acessar um produto do sistema é possível ver todos os comentarios inseridos e o formulario para envio de comentário, porém só será acessível se o usuario estiver logado no sistema;
- Junto do comentário está o nome do autor e a data em que o comentário foi postado/editado;

#### Desejáveis:
- Quando o usuario estiver logado será possivel editar/excluir os próprios comentários, além de também poder alterar suas informações de login clicando no botão "Meu usuario" na direita superior;
- O histórico dos comentários está disponivel a qualquer usuário clicando no botão acima do comentario com o icone de relógio;
- O usuário administrador pode excluir qualquer comentário além de poder tambem inativar ou excluir usuarios do sistema;
- Senhas dos usuários são armazenadas de forma criptografada;

### Com este projeto, espero atender às expectativas da seleção. Sinta-se à vontade para entrar em contato em caso de dúvidas ou sugestões.
