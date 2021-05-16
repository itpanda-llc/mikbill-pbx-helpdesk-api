<?php

/**
 * Файл из репозитория MikBill-VPBX-HelpDesk-API
 * @link https://github.com/itpanda-llc/mikbill-vpbx-helpdesk-api
 */

namespace Panda\MikBill\Vpbx\HelpDeskApi;

/**
 * Class Text
 * @package Panda\MikBill\Vpbx\HelpDeskApi
 * Сообщения ответов
 */
class Message
{
    /**
     * Тикет успешно создан
     * Код: 0
     */
    public const CREATE_TICKET_OK = 'Ticket created successfully';

    /**
     * Тикет уже существует или не требуется
     * Код: 0
     */
    public const TICKET_EXISTS_NOT_REQUIRED = 'Ticket already exists or is not required';

    /**
     * Неправильное значение параметра "Секрет"
     * Код: 1
     */
    public const SECRET_ERROR = 'Incorrect secret key option';

    /**
     * Неправильное значение параметра "Тип запроса"
     * Код: 1
     */
    public const TYPE_ERROR = 'Incorrect request type option';

    /**
     * Неправильное значение параметра "Язык"
     * Код: 1
     */
    public const LANG_ERROR = 'Incorrect language option';

    /**
     * Неправильное значение параметра "Номер телефона"
     * Код: 1
     */
    public const C_ID_ERROR = 'Incorrect phone number option';

    /**
     * Создание категории тикета не выполнено
     * Код: 2
     */
    public const CREATE_TICKET_CATEGORY_ERROR = 'Ticket category creation failed';

    /**
     * Создание тикета не выполнено
     * Код: 2
     */
    public const CREATE_TICKET_ERROR = 'Ticket creation failed';

    /**
     * Создание примечания для тикета не выполнено
     * Код: 2
     */
    public const CREATE_TICKET_NOTE_ERROR = 'Ticket note creation failed';

    /**
     * Создание сообщения для тикета не выполнено
     * Код: 2
     */
    public const CREATE_TICKET_MESSAGE_ERROR = 'Ticket message creation failed';

    /**
     * Запись СМС-сообщения не выполнена
     * Код: 2
     */
    public const LOG_SMS_MESSAGE_ERROR = 'SMS message logging failed';
}
