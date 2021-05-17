<?php

/**
 * Файл из репозитория MikBill-PBX-HelpDesk-API
 * @link https://github.com/itpanda-llc/mikbill-pbx-helpdesk-api
 */

namespace Panda\MikBill\Pbx\HelpDeskApi;

/**
 * Class Type
 * @package Panda\MikBill\Pbx\HelpDeskApi
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
