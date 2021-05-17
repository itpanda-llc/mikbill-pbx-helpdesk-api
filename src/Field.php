<?php

/**
 * Файл из репозитория MikBill-PBX-HelpDesk-API
 * @link https://github.com/itpanda-llc/mikbill-pbx-helpdesk-api
 */

namespace Panda\MikBill\Pbx\HelpDeskApi;

/**
 * Class Field
 * @package Panda\MikBill\Pbx\HelpDeskApi
 * Наименования полей (SQL-запросы)
 */
class Field
{
    /**
     * Имя пользователя
     */
    public const TICKET_ID = 'ticket_id';

    /**
     * Имя пользователя
     */
    public const NAME = 'name';

    /**
     * ID пользователя
     */
    public const U_ID = 'uId';

    /**
     * Логин пользователя
     */
    public const LOGIN = 'login';

    /**
     * Пароль пользователя
     */
    public const PASSWORD = 'password';
}
