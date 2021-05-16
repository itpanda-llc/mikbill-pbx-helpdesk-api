<?php

/**
 * Файл из репозитория MikBill-VPBX-HelpDesk-API
 * @link https://github.com/itpanda-llc/mikbill-vpbx-helpdesk-api
 */

declare(strict_types=1);

namespace Panda\MikBill\Vpbx\HelpDeskApi\Notice;

/**
 * Class Param
 * @package Panda\MikBill\Vpbx\HelpDeskApi\Notice
 * Параметры сообщений
 */
class Param
{
    /**
     * Наименование оператора
     */
    public const COMPANY_NAME = '***';

    /**
     * URL-адрес кабинета
     */
    public const CABINET_URL = '***';

    /**
     * Языковой параметр кабинета (Русский)
     */
    public const RU_CABINET_LANG = 'ru_RU';

    /**
     * Языковой параметр кабинета (Английский)
     */
    public const EN_CABINET_LANG = 'en_GB';

    /**
     * Текст ошибки отправки
     */
    public const ERROR_TEXT = 'Не отправлено';

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
