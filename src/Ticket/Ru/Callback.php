<?php

/**
 * Файл из репозитория MikBill-PBX-HelpDesk-API
 * @link https://github.com/itpanda-llc/mikbill-pbx-helpdesk-api
 */

namespace Panda\MikBill\Pbx\HelpDeskApi\Ticket\Ru;

use Panda\MikBill\Pbx\HelpDeskApi\Ticket;

/**
 * Class Callback
 * @package Panda\MikBill\Pbx\HelpDeskApi\Ticket\Ru
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
