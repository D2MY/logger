# config/app.php

В массив providers в провайдеры пакетов добавить:

``` php
  D2my\Logger\Providers\LoggerServiceProvider::class,
```

# Опубликовать конфиг

```
  php artisan vendor:publish --tag=logger
```

# config/logger.php

Заполнить конфиг

# config/logging.php

Вставить нужным каналам обработчик в поле 'via'

```php
  'via' => \D2my\Logger\Logger::class
```
