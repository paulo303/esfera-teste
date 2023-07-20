## Como instalar

Certifique-se de que não existam outros containers rodando nas mesmas portas que este projeto.

## Passo a passo:

Clonar o repositório git:

```
git clone https://github.com/paulo303/esfera-teste.git
```

Acessar a pasta do projeto e duplicar o arquivo .env.example:

```
cd esfera-teste ; cp .env.example .env;
```

Colar o código abaixo no terminal, para instalar as dependências do Laravel Sail:

```
docker run --rm \
    -u "$(id -u):$(id -g)" \
    -v "$(pwd):/var/www/html" \
    -w /var/www/html \
    laravelsail/php82-composer:latest \
    composer install --ignore-platform-reqs
```

Iniciar o container com o código:

```
./vendor/bin/sail up -d
```

Instalar as dependências do Composer:

```
./vendor/bin/sail composer update
```

Instalar as dependências do Node:

```
./vendor/bin/sail npm install
```

Build:

```
./vendor/bin/sail npm run build
```

Rodar as Migrations e Seeders

```
./vendor/bin/sail artisan migrate:fresh --seed
```

Testes

```
./vendor/bin/sail test
```

