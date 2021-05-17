<?php

/**
 * Файл из репозитория MikBill-PBX-HelpDesk-API
 * @link https://github.com/itpanda-llc/mikbill-pbx-helpdesk-api
 */

declare(strict_types=1);

namespace Panda\MikBill\Pbx\HelpDeskApi;

/**
 * Class Response
 * @package Panda\MikBill\Pbx\HelpDeskApi
 * Формирование ответа
 */
class Response
{
    /**
     * @param int $code Код
     * @param string $message Сообщение
     * @return string JSON-контент
     */
    public static function getError(int $code,
                                    string $message): string
    {
        return json_encode([Key::CODE => $code,
            Key::MESSAGE => $message]);
    }
}
