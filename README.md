# E-commerce MRP SOLUTION

### Back-end feito com laravel

### Arquitetura 

- PHP 8.1.17
- Laravel 10.10
- Composer 2.6.5

### Instalação - WINDOWS
```sh
git clone https://github.com/eduardohor/new-ecommerce.git
```

```sh
cd new-ecommerce
```

- Instalar as dependências

```sh
composer install
```

- Duplicar o arquivo **.env.example** e renomear a copia para **.env**
```sh
cp .env.example .env
```

- Com um editor altere os dados de banco no arquivo .env para os referente ao seu banco local

- Logo depois execute o comando abaixo para gerar uma nova chave
```PHP
php artisan key:generate
```
- Criar as tabelas no banco

```sh
php artisan migrate
```

- Criar um link simbólico para upload e consulta de imagens

```sh
php artisan storage:link
```

- Popular o banco de dados com seeders
  
```sh
php artisan db:seed
```

- Subir o servidor

```sh
php artisan serve
```

 Verificar se a aplicação está online acessando [http://localhost:8000](http://localhost:8000)
