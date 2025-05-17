# crud-docker-nginx-laravel

Este projeto Laravel utiliza Docker para facilitar o ambiente de desenvolvimento e produção, com containers para a aplicação (`app`), banco de dados MariaDB (`db`) e servidor web Nginx (`nginx`).

Para iniciar o ambiente, execute no terminal, na raiz do projeto:

```bash
docker-compose up -d --build
```

## Rodar migrations
Entre no container da aplicação com:

```bash
docker exec -it laravel_app bash
```

## Execute as migrations do Laravel:

```bash
php artisan migrate
```

## Acessar o banco de dados MariaDB
### Para abrir o cliente MySQL dentro do container db, rode:

```bash
docker exec -it laravel_db mysql -u laravel_user -p
```
### Quando solicitado, informe a senha:
> secret123


## Testar os endpoints da API
### As rotas estão definidas no arquivo routes/api.php e contemplam as models Customer e Product.

## Exemplo para o recurso Customer:

> Listar todos:
```bash
curl -X GET http://localhost:8080/api/customers
```

> Criar um novo registro:

```bash
curl -X POST http://localhost:8080/api/customers \
  -H "Content-Type: application/json" \
  -d '{"name": "João", "email": "joao@example.com"}'
```

> Atualizar um registro existente (exemplo ID 1):
```bash
curl -X PUT http://localhost:8080/api/customers/1 \
  -H "Content-Type: application/json" \
  -d '{"name": "João Silva"}'
```

> Deletar um registro (exemplo ID 1):
```bash
curl -X DELETE http://localhost:8080/api/customers/1
```

## Visualizar logs do Laravel
> Os logs da aplicação ficam no arquivo storage/logs/laravel.
```bash
docker exec -it laravel_app tail -f storage/logs/laravel.log
```