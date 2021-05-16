<?php

/**
 * Файл из репозитория MikBill-VPBX-HelpDesk-API
 * @link https://github.com/itpanda-llc/mikbill-vpbx-helpdesk-api
 */

namespace Panda\MikBill\Vpbx\HelpDeskApi;

/**
 * Class Cloud
 * @package Panda\MikBill\Vpbx\HelpDeskApi
 * Параметры сервиса "Яндекс.Облако"
 */
class Cloud
{
    /**
     * API-ключ
     * @link @link https://cloud.yandex.ru/docs/iam/concepts/authorization/api-key
     */
    public const API_KEY = '***';

    /**
     * OAuth-токен
     * @link https://cloud.yandex.ru/docs/iam/operations/iam-token/create
     */
    public const OAUTH_TOKEN = '***';

    /**
     * ID каталога
     * @link https://cloud.yandex.ru/docs/speechkit/tts/request
     */
    public const FOLDER_ID = '***';
}
