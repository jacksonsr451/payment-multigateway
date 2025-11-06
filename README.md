# payment-multigateway

Ambiente Laravel com MySQL e serviço de gateways mockados orquestrado por Docker Compose.

## Requisitos

- Docker e Docker Compose v2+
- Make (opcional, mas recomendado para usar os atalhos do Makefile)

## Instalação

```bash
cp .env.example .env
composer install    # opcional em ambiente local; no container é executado automaticamente
php artisan key:generate
```

> Observação: quando o container `app` inicia, ele executa `composer install` antes de servir a aplicação. Mesmo assim, manter as dependências instaladas localmente facilita ferramentas da IDE.

## Subindo o ambiente

```bash
make up
# ou
docker compose up -d --build
```

- API: http://localhost:8008  
- Gateways mockados: http://localhost:3001 e http://localhost:3002  
- Banco: MySQL 8 disponível em `localhost:3306` (usuário: root / senha: root / base: payment_multigateway)

## Fluxo de desenvolvimento

1. Suba os serviços (`make up`).
2. Rode as migrações/migrações + seeds conforme necessário, por exemplo `make seed`.
3. Adote TDD: escreva/ajuste seus testes antes, depois execute `make test`.
4. Gere documentação Swagger quando necessário (`make swagger`).
5. Use `make fix` para aplicar o formatador (Laravel Pint).

## Principais comandos

```bash
make up         # sobe e builda os containers
make down       # interrompe e remove os containers
make seed       # executa php artisan db:seed
make test       # executa php artisan test
make swagger    # gera documentação Swagger (ajuste conforme o pacote utilizado)
make fix        # roda o formatter Laravel Pint
```

Todos os comandos Make utilizam o container `app`, garantindo que as dependências PHP e o PHPUnit rodem em ambiente controlado.

## Rodando testes manualmente

Caso prefira executar direto via Docker Compose:

```bash
docker compose exec app php artisan test
```

## Encerrando o ambiente

```bash
make down
# ou
docker compose down
```
