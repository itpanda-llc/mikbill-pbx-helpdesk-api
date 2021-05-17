<?php

/**
 * Файл из репозитория MikBill-PBX-HelpDesk-API
 * @link https://github.com/itpanda-llc/mikbill-pbx-helpdesk-api
 */

namespace Panda\MikBill\Pbx\HelpDeskApi\Notice\Ru;

use Panda\MikBill\Pbx\HelpDeskApi\Notice;

/**
 * Class Opinion
 * @package Panda\MikBill\Pbx\HelpDeskApi\Notice\Ru
 * Параметры сообщения (Опрос)
 */
class Opinion extends Notice\Param
{
    /**
     * Сообщения
     */
    public const SAMPLES = [
        'для нас важно мнение каждого. Несколько вопросов, если это вам удобно.',
        'мы прислушиваемся ко всем обращениям. Расскажите нам и вы?'
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
