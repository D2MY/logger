# config/app.php в массив providers в провайдеры пакетов добавить:

``` php
  D2my\Incidents\Providers\IncidentsServiceProvider::class,
```

# php artisan vendor:publish --tag=incidents

# config/incidents.php в массиве channels каждому каналу приписать свой handler, который обязательно должен исплементировать D2my\Incidents\Contracts\IncidentHandler

# Запуск:
