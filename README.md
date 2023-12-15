# Bankys

Este SDK serve como facilitador para utilização das funcionalidades disponíveis na AP [Bankys](https://documenter.getpostman.com/view/15468772/2s8YmPs1dU#e82a66ad-8409-4ed2-9b36-9e66fc7b655e).

## Funcionalidades

- Gerar PIX dinâmico
- Gerar PIX estático
- Gerar PIX estático com valor
- Consultar chave PIX
- Consultar extrato
- Consultar transação de pix out

## Instalação

```bash
composer require cjchamado/bankys-php-sdk
```

## Exemplo rápido

Para mais informações sobre o uso da API [clique aqui](https://documenter.getpostman.com/view/15468772/2s8YmPs1dU#e82a66ad-8409-4ed2-9b36-9e66fc7b655e).

```php
<?php

use Bankys\Bankys;

$bankys = new Bankys(
    $authUsername,
    $authPassword,
    $clientId,
    $clientSecret,
    # $token // optional (LEIA: Recomendações sobre tokens)
);

$pixKey = $bankys->getPixKey('your-pix-key');

var_dump($pixKey);
```

> Consulte o diretório "samples" para obter mais exemplos de uso.

## Recomendações sobre tokens

Para evitar chamadas sequenciais para geração de token da api, é recomendado que você utilize algum mecanismo de cacheamento do mesmo, passando seu valor no construtor da instância Bankys (argumento 5), nas utilizações subsequentes.

Desta forma, o recurso entende que deve utilizar o token fornecido e não efetua a chamada de geração do token.

Para obter o token gerado na primeira chamada, utilize:

```php
$token = $bankys->getToken();
```

Atualmente, os tokens possuem duração de 120 minutos (2 horas).

## Recomendações sobre exceções e respostas

As exceções lançadas pelas requisições deste sdk, não são transformadas para uma exceção personalizada, sendo necessário seu tratamento em nível de aplicação.

Em alguns casos, quando uma operação resulta em insucesso, não são lançadas exceções, ao invés disso, a api responde com um valor "false", na chave "Success" do JSON retornado.

Exemplo:

```json
{
  "Success":"false",
  "Message":"Erro: Não foi possivel consultar a transaçãoo. Entre em contato com o suporte."
}
```

Desta forma, é necessário que em toda operação, seja verificado o valor da chave informada, a fim de garantir que a mesma realmente ocorreu e com sucesso.
