<?php

/**
 * Файл из репозитория MikBill-VPBX-HelpDesk-API
 * @link https://github.com/itpanda-llc/mikbill-vpbx-helpdesk-api
 */

namespace Panda\MikBill\Vpbx\HelpDeskApi;

/**
 * Class Param
 * @package Panda\MikBill\Vpbx\HelpDeskApi
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
