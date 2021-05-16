<?php

/**
 * Файл из репозитория MikBill-VPBX-HelpDesk-API
 * @link https://github.com/itpanda-llc/mikbill-vpbx-helpdesk-api
 */

declare(strict_types=1);

/**
 * Путь к конфигурационному файлу MikBill
 * @link https://wiki.mikbill.pro/billing/config_file
 */
const CONFIG =  '/var/www/mikbill/admin/app/etc/config.xml';

require_once '/var/mikbill/__ext/vendor/autoload.php';

use Panda\MikBill\Vpbx\HelpDeskApi;

header(HelpDeskApi\Content::APPLICATION_JSON);

$logic = new HelpDeskApi\Logic;

try {
    $logic->run();

    header($logic->status);
    print_r($logic->content);
} catch (HelpDeskApi\Exception\SystemException $e) {
    header(HelpDeskApi\Status::INTERNAL_500);
    print_r(HelpDeskApi\Response::getError(
        HelpDeskApi\Code::SYSTEM_ERROR,
        $e->getMessage()));
} catch (HelpDeskApi\Exception\DebugException $e) {
    header(HelpDeskApi\Status::INTERNAL_500);
    print_r(HelpDeskApi\Response::getError(
        HelpDeskApi\Code::DEBUG_ERROR,
        $e->getMessage()));
}
