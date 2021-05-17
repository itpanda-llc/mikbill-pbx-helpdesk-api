<?php

/**
 * Файл из репозитория MikBill-PBX-HelpDesk-API
 * @link https://github.com/itpanda-llc/mikbill-pbx-helpdesk-api
 */

namespace Panda\MikBill\Pbx\HelpDeskApi;

/**
 * Class Param
 * @package Panda\MikBill\Pbx\HelpDeskApi
 * Наименования параметров запроса
 */
class Param
{
    /**
     * Секрет
     */
    public const SECRET = 'secret';

    /**
     * Тип
     */
    public const TYPE = 'type';

    /**
     * Формат ответа
     */
    public const FORMAT = 'format';

    /**
     * Язык
     */
    public const LANG = 'lang';

    /**
     * Номер телефона
     */
    public const C_ID = 'c_id';
}
