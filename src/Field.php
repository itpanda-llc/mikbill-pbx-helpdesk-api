<?php

/**
 * Файл из репозитория MikBill-VPBX-HelpDesk-API
 * @link https://github.com/itpanda-llc/mikbill-vpbx-helpdesk-api
 */

namespace Panda\MikBill\Vpbx\HelpDeskApi;

/**
 * Class Field
 * @package Panda\MikBill\Vpbx\HelpDeskApi
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
