Требования к программному обеспечению
------------

**PHP 7:**

Обычно PHP уже установлено в вашей операционной системе, или его можно установить пакетным менеджером таким как `apt` или `homebrew`.

Windows пользователи могут скачать последнюю версию интерпретатора по ссылке:
https://windows.php.net/download#php-7.3

Вы также можете скомпилировать интерпретатор из исходного кода,
его вы можете найти тут: https://www.php.net/downloads.php

**Composer:**

`Composer` это основной пакет PHP и инструмент управления зависимостями.

Вы можете скачать его по ссылке: https://getcomposer.org/download/

Как начать
---------------

Для начала этого тестирования установите зависимости и запустите `phpunit`:

```
cd php7
composer install
vendor/bin/phpunit
```

Если команда `"install"` не работает, попробуйте выполнить `composer update`.
Это позволит `composer`у обновить версии пакетов и их зависимости.

Если не удалось запустить, попробуйте более решительный метод:

```
composer remove phpunit/phpunit
composer require phpunit/phpunit
```

Для собственного тестирования кода, чтобы удостоверится что программа работает верно
используйте `texttest_fixture` скрипт.

```
php fixtures/texttest_fixture.php
```

Примечания
----

У PHPUnit есть детальная документация. Особенно полезно изучить раздел
[Data Providers](https://phpunit.readthedocs.io/ru/latest/annotations.html#dataprovider).
