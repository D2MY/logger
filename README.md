# config/app.php

В массив providers в провайдеры пакетов добавить:

``` php
  D2my\Incidents\Providers\IncidentsServiceProvider::class,
```

# Опубликовать конфиг

php artisan vendor:publish --tag=incidents

# config/incidents.php

В массиве channels каждому каналу приписать свой handler, который обязательно должен имплементировать D2my\Incidents\Contracts\IncidentHandler

```php
  'blocker' => [
      'handler' => \App\Services\Handler::class
  ],
```

# Запуск:

Incident::send('channel', 'message');
