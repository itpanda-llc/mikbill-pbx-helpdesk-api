<?php

/**
 * Файл из репозитория MikBill-VPBX-HelpDesk-API
 * @link https://github.com/itpanda-llc/mikbill-vpbx-helpdesk-api
 */

namespace Panda\MikBill\Vpbx\HelpDeskApi;

/**
 * Class Type
 * @package Panda\MikBill\Vpbx\HelpDeskApi
 * Тип запроса/тикета
 */
class Type
{
    /**
     * Опрос
     */
    public const OPINION = 'opinion';

    /**
     * Обратный звонок
     */
    public const CALLBACK = 'callback';
}
