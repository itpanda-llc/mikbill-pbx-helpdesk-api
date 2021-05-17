<?php

/**
 * Файл из репозитория MikBill-PBX-HelpDesk-API
 * @link https://github.com/itpanda-llc/mikbill-pbx-helpdesk-api
 */

declare(strict_types=1);

namespace Panda\MikBill\Pbx\HelpDeskApi;

/**
 * Class Query
 * @package Panda\MikBill\Pbx\HelpDeskApi
 * Запросы к БД
 */
class Query
{
    /**
     * @return bool Результат проверки наличия категории тикета
     */
    public static function checkCategory(): bool
    {
        $sth = Statement::query(Sql::CHECK_CATEGORY);

        return $sth->rowCount() !== 0;
    }

    /**
     * @return bool Результат добавления категории тикета
     */
    public static function addCategory(): bool
    {
        return Statement::exec(Sql::ADD_CATEGORY) !== 0;
    }

    /**
     * @param string $cId Номер телефона
     * @return array|null Результат запроса
     */
    public static function checkTicket(string $cId): ?array
    {
        return self::getResult(Sql::CHECK_TICKET, $cId);
    }

    /**
     * @param string $cId Номер телефона
     * @param int $showTicketToUser Показывать тикет пользователю
     * @return bool Результат добавления тикета
     */
    public static function addTicket(string $cId,
                                     int $showTicketToUser): bool
    {
        $sth = Statement::prepare(Sql::ADD_TICKET);

        $sth->bindParam(Holder::C_ID, $cId);
        $sth->bindParam(Holder::SHOW_TICKET_TO_USER,
            $showTicketToUser);

        Statement::execute($sth);

        return $sth->rowCount() !== 0;
    }

    /**
     * @param string $ticketId ID тикета
     * @param string $ticketNote Примечание
     * @return bool Результат добавления примечания
     */
    public static function addNote(string $ticketId,
                                   string $ticketNote): bool
    {
        $sth = Statement::prepare(Sql::ADD_NOTE);

        $sth->bindParam(Holder::TICKET_ID, $ticketId);
        $sth->bindParam(Holder::TICKET_NOTE, $ticketNote);

        Statement::execute($sth);

        return $sth->rowCount() !== 0;
    }

    /**
     * @param string $cId Номер телефона
     * @return array|null Результат запроса
     */
    public static function checkClient(string $cId): ?array
    {
        return self::getResult(Sql::CHECK_CLIENT, $cId);
    }

    /**
     * @param string $ticketId ID тикета
     * @param string $ticketMessage Сообщение
     * @return bool Результат добавления сообщения
     */
    public static function addMessage(string $ticketId,
                                      string $ticketMessage): bool
    {
        $sth = Statement::prepare(Sql::ADD_MESSAGE);

        $sth->bindParam(Holder::TICKET_ID, $ticketId);
        $sth->bindParam(Holder::TICKET_MESSAGE, $ticketMessage);

        Statement::execute($sth);

        return $sth->rowCount() !== 0;
    }

    /**
     * @param string $uId ID пользователя
     * @param string $phone Номер телефона
     * @param string $text Текст сообщения
     * @param string $errorText Текст ошибки
     * @return bool Результат добавления сообщения
     */
    public static function logMessage(string $uId,
                                      string $phone,
                                      string $text,
                                      string $errorText): bool
    {
        $sth = Statement::prepare(Sql::LOG_MESSAGE);

        $sth->bindParam(Holder::U_ID, $uId);
        $sth->bindParam(Holder::C_ID, $phone);
        $sth->bindParam(Holder::SMS_TEXT, $text);
        $sth->bindParam(Holder::SMS_ERROR_TEXT, $errorText);

        Statement::execute($sth);

        return $sth->rowCount() !== 0;
    }

    /**
     * @param string $statement Подготавливаемый запрос
     * @param string $cId Номер телефона
     * @return array|null Результат запроса
     */
    private static function getResult(string $statement,
                                      string $cId): ?array
    {
        $sth = Statement::prepare($statement);

        $sth->bindParam(Holder::C_ID, $cId);

        Statement::execute($sth);

        return (($result = $sth->fetch(\PDO::FETCH_ASSOC)) !== false)
            ? $result
            : null;
    }
}
