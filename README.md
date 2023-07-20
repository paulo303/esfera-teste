# 🧠 Como instalar

Certifique-se de que não existam outros containers rodando nas mesmas portas que este projeto.

## Passo a passo:

Clonar o repositório git:

```bash
git clone https://github.com/paulo303/esfera-teste.git
```

Acessar a pasta do projeto:

```bash
cd esfera-teste
```

Duplicar o arquivo .env.example:

```bash
cp .env.example .env
```

Colar o código abaixo no terminal, para instalar as dependências do Laravel Sail:

```bash
docker run --rm \
    -u "$(id -u):$(id -g)" \
    -v "$(pwd):/var/www/html" \
    -w /var/www/html \
    laravelsail/php82-composer:latest \
    composer install --ignore-platform-reqs
```

Iniciar o container com o código:

```bash
./vendor/bin/sail up -d
```

Instalar as dependências do Composer:

```bash
./vendor/bin/sail composer update
```

Instalar as dependências do Node:

```bash
./vendor/bin/sail npm install
```

Build:

```bash
./vendor/bin/sail npm run build
```

Rodar as Migrations e Seeders

```bash
./vendor/bin/sail artisan migrate:fresh --seed
```

## Tudo instalado!!!
Agora o sistema já está funcionando. 

## Executando os testes
É possível executar os testes feitos em PEST com o comando a seguir:

```bash
./vendor/bin/sail test
```

## Login no site

Para efetuar o login, acesse [http://localhost](http://localhost) e utilize os dados abaixo:

- E-mail: admin@email.com
- Senha: password


## Funcionalidades

- Temas dark e light
- Testes feitos em PEST
- Login de usuário
- Tipos de usuário: Administrador e Usuário
- Apenas um Administrador pode ver o formulário para cadastrar um usuário
- Apenas um Administrador pode ver o botão de excluir usuário
- Um Administrador não pode se excluir pela listagem de usuários (é possível excluir pela dela do Perfil, mas eu deixei bloqueado isso na tela para mostrar o uso de Policies do Laravel)
- Qualquer usuário pode editar as suas informações na tela de "Perfil"
- Qualquer usuário pode exluir a sua conta
- Validação se o e-mail já está cadastrado
- Validação se a senha é maior ou igual a 8 caracteres
- Validação se as senhas coincidem
- Máscara para o campo telefone
- Telefone é um campo opcional, podendo adicionar mais de um número
- Se a listagem tiver mais que 5 usuários, será feita uma paginação automaticamente
- Mensagem confirmando que o usuário foi criado
- Popup confirmando a exclusão de um usuário
- Mensagem confirmando que o usuário foi excluído




## Stack utilizada

**Front-end:** Blade, TailwindCSS, JQuery

**Back-end:** PHP, Laravel


## Autor

- [@paulo303](https://www.github.com/paulo303)

