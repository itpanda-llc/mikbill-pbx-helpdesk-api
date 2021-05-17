<?php

/**
 * Файл из репозитория MikBill-PBX-HelpDesk-API
 * @link https://github.com/itpanda-llc/mikbill-pbx-helpdesk-api
 */

declare(strict_types=1);

namespace Panda\MikBill\Pbx\HelpDeskApi\Ticket;

/**
 * Class Param
 * @package Panda\MikBill\Pbx\HelpDeskApi\Ticket
 * Параметры тикетов
 */
class Param
{
    /**
     * Наименование категории
     */
    public const CATEGORY_NAME = 'Виртуальная АТС';

    /**
     * Описание категории
     */
    public const CATEGORY_DESCRIPTION = 'Автоматическая заявка (IP-телефония)';

    /**
     * Примечание
     */
    public const NOTE = 'Создан автоматически';

    /**
     * ID типа приоритета
     */
    public const PRIORITY_TYPE_ID = 2;

    /**
     * Показывать тикет пользователю
     */
    public const SHOW_TICKET_TO_USER = 1;

    /**
     * Не показывать тикет пользователю
     */
    public const NOT_SHOW_TICKET_TO_USER = 0;

    /**
     * @return string Случайное значение (Интро)
     */
    public static function getIntro(): string
    {
        return static::INTRO[array_rand(static::INTRO)];
    }

    /**
     * @return string Случайное значение (Сообщения)
     */
    public static function getSample(): string
    {
        return static::SAMPLES[array_rand(static::SAMPLES)];
    }

    /**
     * @return string Случайное значение (Аутро)
     */
    public static function getOutro(): string
    {
        return static::OUTRO[array_rand(static::OUTRO)];
    }
}
