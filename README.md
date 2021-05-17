# MikBill-PBX-HelpDesk-API

API для интеграции биллинговой системы ["MikBill"](https://mikbill.pro) с PBX-системами

[![Packagist Downloads](https://img.shields.io/packagist/dt/itpanda-llc/mikbill-pbx-helpdesk-api)](https://packagist.org/packages/itpanda-llc/mikbill-pbx-helpdesk-api/stats)
![Packagist License](https://img.shields.io/packagist/l/itpanda-llc/mikbill-pbx-helpdesk-api)
![Packagist PHP Version Support](https://img.shields.io/packagist/php-v/itpanda-llc/mikbill-pbx-helpdesk-api)

## Ссылки

* [Разработка](https://github.com/itpanda-llc)
* [О проекте (MikBill)](https://mikbill.pro)
* [Документация (MikBill)](https://wiki.mikbill.pro)

## Возможности

* Создание тикета "Опрос" / СМС-уведомление
* Создание тикета "Обратный вызов" / СМС-уведомление

## Требования

* PHP >= 7.2
* JSON
* libxml
* PDO
* SimpleXML
* [itpanda-llc/smspilot-messenger-sdk](https://github.com/itpanda-llc/smspilot-messenger-sdk)
* [itpanda-llc/yandex-translate-sdk](https://github.com/itpanda-llc/yandex-translate-sdk)

## Установка

```shell script
composer require itpanda-llc/mikbill-pbx-helpdesk-api
```

## Конфигурация

Указание в файлах

* Параметров тикетов в ["Ticket"](src/Ticket)
* Параметров СМС-уведомлений в ["Notice"](src/Notice)
* Параметров аутентификации в ["Auth.php"](src/Auth.php)
* Параметров сервиса ["Yandex Cloud"](https://cloud.yandex.ru) в ["Cloud.php"](src/Cloud.php)
* Параметров сервиса ["SMSPILOT.RU"](https://smspilot.ru) в ["Pilot.php"](src/Pilot.php)
* Путей к [конфигурационному файлу](https://wiki.mikbill.pro/billing/config_file) и интерфейсам в ["index.php"](examples/www/mikbill/admin/api/pbx/helpdesk/index.php), предварительно размещенного в каталоге веб-сервера

## Примеры запросов к интерфейсу

### Создание тикета "Опрос" / СМС-уведомление

```text
%URL%?secret=%SECRET%&type=opinion&c_id=%C_ID%
```

### Создание тикета "Обратный вызов" / СМС-уведомление

```text
%URL%?secret=%SECRET%&type=callback&c_id=%C_ID%
```
