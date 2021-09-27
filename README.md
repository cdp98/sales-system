# Sistema de vendas

## Creating tables
```
php artisan migrate
```

## Inserts

### products
```
INSERT INTO `products` (`id`, `name`, `reference`, `price`, `created_at`, `updated_at`) VALUES
(1, 'Caderno', 'CADE', '17.00', '2021-09-25 15:04:21', '2021-09-25 15:04:21'),
(2, 'Caneta', 'CANE', '2.50', '2021-09-25 15:04:58', '2021-09-25 15:04:58'),
(3, 'Lápis', 'LAP', '1.25', '2021-09-25 15:05:31', '2021-09-25 15:05:31'),
(4, 'Borracha', 'BORR', '1.15', '2021-09-25 15:04:21', '2021-09-25 15:07:35');

```

### product_providers
```
INSERT INTO `product_providers` (`id`, `product_id`, `provider_id`, `created_at`, `updated_at`) VALUES
(1, 4, 1, '2021-09-25 15:17:40', '2021-09-25 15:17:40'),
(2, 4, 4, '2021-09-25 15:17:40', '2021-09-25 15:17:40'),
(3, 1, 3, '2021-09-25 15:18:13', '2021-09-25 15:18:13'),
(4, 1, 4, '2021-09-25 15:18:13', '2021-09-25 15:18:13'),
(5, 2, 2, '2021-09-25 15:18:41', '2021-09-25 15:18:41');
```

### providers
```
INSERT INTO `providers` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Fornecedor1', '2021-09-25 15:08:35', '2021-09-25 15:08:35'),
(2, 'Fornecedor2', '2021-09-25 15:08:35', '2021-09-25 15:08:35'),
(3, 'Fornecedor3', '2021-09-25 15:11:33', '2021-09-25 15:11:33'),
(4, 'Fornecedor4', '2021-09-25 15:12:09', '2021-09-25 15:12:09');

```


## How to use

Add the products to the sales table, at the end inform the zip code and the date of sale
