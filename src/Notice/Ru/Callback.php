<?php

/**
 * Файл из репозитория MikBill-VPBX-HelpDesk-API
 * @link https://github.com/itpanda-llc/mikbill-vpbx-helpdesk-api
 */

namespace Panda\MikBill\Vpbx\HelpDeskApi\Notice\Ru;

use Panda\MikBill\Vpbx\HelpDeskApi\Notice;

/**
 * Class Callback
 * @package Panda\MikBill\Vpbx\HelpDeskApi\Notice\Ru
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
