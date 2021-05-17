<?php

/**
 * Файл из репозитория MikBill-PBX-HelpDesk-API
 * @link https://github.com/itpanda-llc/mikbill-pbx-helpdesk-api
 */

namespace Panda\MikBill\Pbx\HelpDeskApi;

/**
 * Class Sql
 * @package Panda\MikBill\Pbx\HelpDeskApi
 * SQL-запросы
 */
class Sql
{
    /**
     * Проверка категории тикета
     */
    public const CHECK_CATEGORY = "
        SELECT
            `tickets_categories_list`.`categoryid`
        FROM
            `tickets_categories_list`
        WHERE
            `tickets_categories_list`.`categoryname`
                =
            '" . Ticket\Param::CATEGORY_NAME . "'
        LIMIT
            1";

    /**
     * Добавление категории тикета
     */
    public const ADD_CATEGORY = "
        INSERT INTO
            `tickets_categories_list` (
                `categoryname`,
                `description`
            )
        VALUES (
            '" . Ticket\Param::CATEGORY_NAME . "',
            '" . Ticket\Param::CATEGORY_DESCRIPTION . "'
        )";

    /**
     * Проверка тикета
     */
    public const CHECK_TICKET = "
        SELECT
            `tickets_tickets`.`ticketid` AS
                `" . Field::TICKET_ID . "`
        FROM
            `tickets_tickets`
        LEFT JOIN
            `tickets_categories_list`
                ON
                    `tickets_categories_list`.`categoryid`
                        =
                    `tickets_tickets`.`categoryid`
                        AND
                    `tickets_categories_list`.`categoryid` IS NOT NULL
                        AND
                    `tickets_categories_list`.`categoryname`
                        =
                    '" . Ticket\Param::CATEGORY_NAME . "'
        LEFT JOIN
            `users`
                ON
                    `users`.`uid` = `tickets_tickets`.`useruid`
        WHERE
            `tickets_tickets`.`creationdate` > DATE_SUB(
                NOW(),
                INTERVAL 3 MONTH
            )
                AND
            `tickets_tickets`.`created_by_stuffid` = 0
                AND
            `tickets_tickets`.`created_by_useruid` = 0
                AND
            `tickets_tickets`.`prioritytypeid`
                =
            " . Ticket\Param::PRIORITY_TYPE_ID . "
                AND
            " . Holder::C_ID . " IN (
                `tickets_tickets`.`phones`,
                `users`.`phone`,
                `users`.`mob_tel`,
                `users`.`sms_tel`
            )
        ORDER BY
            `tickets_tickets`.`creationdate`
        DESC
        LIMIT
            1";

    /**
     * Добавление тикета
     */
    public const ADD_TICKET = "
        INSERT INTO
            `tickets_tickets` (
                `useruid`,
                `fio`,
                `street`,
                `settlementname`,
                `neighborhoodname`,
                `house`,
                `apartment`,
                `housingname`,
                `houseblockname`,
                `phones`,
                `categoryid`,
                `prioritytypeid`,
                `show_ticket_to_user`,
                `dialogue`
            )
        VALUES (
            (
                SELECT
                    @uId :=
                    IF(
                        COUNT(
                            `users`.`uid`
                        ) = 0,
                        0,
                        `users`.`uid`
                    )
                FROM
                     `users`
                WHERE
                    (
                        @cId := " . Holder::C_ID . "
                    ) IN (
                        `users`.`phone`,
                        `users`.`mob_tel`,
                        `users`.`sms_tel`
                    )
                LIMIT
                    1
            ),
            '',
            '',
            '',
            '',
            '',
            '',
            '',
            '',
            IF(
                @uId = 0,
                @cId,
                ''
            ),
            (
                SELECT
                    `tickets_categories_list`.`categoryid`
                FROM
                    `tickets_categories_list`
                WHERE
                    `tickets_categories_list`.`categoryname`
                        =
                    '" . Ticket\Param::CATEGORY_NAME . "'
                LIMIT
                    1
            ),
            " . Ticket\Param::PRIORITY_TYPE_ID . ",
            " . Holder::SHOW_TICKET_TO_USER . ",
            1
        )";

    /**
     * Добавление примечания к тикету
     */
    public const ADD_NOTE = "
        INSERT INTO
            `tickets_notes` (
                `ticketid`,
                `stuffid`,
                `note`
            )
        VALUES (
            " . Holder::TICKET_ID . ",
            0,
            " . Holder::TICKET_NOTE . "
        )";

    /**
     * Проверка клиента
     */
    public const CHECK_CLIENT = "
        SELECT
            `users`.`uid` AS
                `" . Field::U_ID . "`,
            `users`.`user` AS
                `" . Field::LOGIN . "`,
            `users`.`password` AS
                `" . Field::PASSWORD . "`,
            SUBSTRING(
                `users`.`fio`,
                LOCATE(
                    ' ',
                    `users`.`fio`
                ) + 1
            ) AS
                `" . Field::NAME . "`
        FROM
            `users`
        WHERE
            " . Holder::C_ID . " IN (
                `users`.`phone`,
                `users`.`mob_tel`,
                `users`.`sms_tel`
            )
                AND
            `users`.`state` IN (
                1,
                2
            )
                AND
            '' NOT IN (
                `users`.`fio`,
                `users`.`user`,
                `users`.`password`
            )
                AND
            `users`.`password` != '*'
        LIMIT
            1";

    /**
     * Добавление сообщения тикета
     */
    public const ADD_MESSAGE = "
        INSERT INTO
            `tickets_messages` (
                `ticketid`,
                `stuffid`,
                `useruid`,
                `message`,
                `unread`
            )
        VALUES (
            " . Holder::TICKET_ID . ",
            0,
            0,
            " . Holder::TICKET_MESSAGE . ",
            1
        )";

    /**
     * Добавление СМС-сообщения
     */
    public const LOG_MESSAGE = "
        INSERT INTO
            `sms_logs` (
                `sms_type_id`,
                `uid`,
                `sms_phone`,
                `sms_text`,
                `sms_error_text`
            )
        VALUES (
            0,
            " . Holder::U_ID . ",
            " . Holder::C_ID . ",
            " . Holder::SMS_TEXT. ",
            " . Holder::SMS_ERROR_TEXT . "
        )";
}
