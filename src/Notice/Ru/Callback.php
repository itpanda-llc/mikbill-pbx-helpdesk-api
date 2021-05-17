<?php

/**
 * Файл из репозитория MikBill-PBX-HelpDesk-API
 * @link https://github.com/itpanda-llc/mikbill-pbx-helpdesk-api
 */

namespace Panda\MikBill\Pbx\HelpDeskApi\Notice\Ru;

use Panda\MikBill\Pbx\HelpDeskApi\Notice;

/**
 * Class Callback
 * @package Panda\MikBill\Pbx\HelpDeskApi\Notice\Ru
 * Параметры сообщения (Обратный вызов)
 */
class Callback extends Notice\Param
{
    /**
     * Сообщения
     */
    public const SAMPLES = [
        'приглашаем к диалогу в ваш личный кабинет.',
        'пообщаемся в вашем личном кабинете?'
    ];

    /**
     * Аутро
     */
    public const OUTRO = [
        'Ответить:',
        'Войти:',
        'Начать:'
    ];
}
