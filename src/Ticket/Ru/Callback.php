<?php

/**
 * Файл из репозитория MikBill-VPBX-HelpDesk-API
 * @link https://github.com/itpanda-llc/mikbill-vpbx-helpdesk-api
 */

namespace Panda\MikBill\Vpbx\HelpDeskApi\Ticket\Ru;

use Panda\MikBill\Vpbx\HelpDeskApi\Ticket;

/**
 * Class Callback
 * @package Panda\MikBill\Vpbx\HelpDeskApi\Ticket\Ru
 * Параметры тикета (Обратный вызов)
 */
class Callback extends Ticket\Param
{
    /**
     * Интро
     */
    public const INTRO = [
        'Приветствуем,',
        'Здравствуйте,',
        'Добро пожаловать,'
    ];

    /**
     * Сообщения
     */
    public const SAMPLES = [
        'Спасибо, что пользуетесь нашими услугами! Какой у вас вопрос?',
        'От вас есть пропущенный вызов. Пообщаемся здесь?'
    ];
}
