<?php

/**
 * Файл из репозитория MikBill-VPBX-HelpDesk-API
 * @link https://github.com/itpanda-llc/mikbill-vpbx-helpdesk-api
 */

namespace Panda\MikBill\Vpbx\HelpDeskApi\Ticket\Ru;

use Panda\MikBill\Vpbx\HelpDeskApi\Ticket;

/**
 * Class Opinion
 * @package Panda\MikBill\Vpbx\HelpDeskApi\Ticket\Ru
 * Параметры тикета (Опрос)
 */
class Opinion extends Ticket\Param
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
        'Вы помогаете нам стать лучше! Решен ли ваш вопрос? Как вы оцениваете работу специалиста? Ваши пожелания? Или задайте вопрос.',
        'Каждый день мы стараемся быть лучше! Как вы оцениваете работу специалиста? Ваши пожелания? Что мы можем сделать для вас?'
    ];

    /**
     * Интро
     */
    public const OUTRO = [
        'Спасибо!',
        'Благодарим!'
    ];
}
