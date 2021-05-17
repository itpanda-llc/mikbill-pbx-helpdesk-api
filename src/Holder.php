<?php

/**
 * Файл из репозитория MikBill-PBX-HelpDesk-API
 * @link https://github.com/itpanda-llc/mikbill-pbx-helpdesk-api
 */

namespace Panda\MikBill\Pbx\HelpDeskApi;

/**
 * Class Holder
 * @package Panda\MikBill\Pbx\HelpDeskApi
 * Наименования параметров (SQL-запросы)
 */
class Holder
{
    /**
     * Номер телефона пользователя
     */
    public const C_ID = ':cId';

    /**
     * Показывать тикет пользователю
     */
    public const SHOW_TICKET_TO_USER = ':showTicketToUser';

    /**
     * ID тикета
     */
    public const TICKET_ID = ':ticketId';

    /**
     * Примечание к тикету
     */
    public const TICKET_NOTE = ':ticketNote';

    /**
     * Сообщение тикета
     */
    public const TICKET_MESSAGE = ':ticketMessage';

    /**
     * ID пользователя
     */
    public const U_ID = ':uId';

    /**
     * Текст СМС-сообщения
     */
    public const SMS_TEXT = ':smsText';

    /**
     * Текст ошибки СМС-сообщения
     */
    public const SMS_ERROR_TEXT = ':smsErrorText';
}
