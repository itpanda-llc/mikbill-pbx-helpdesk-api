<?php

/**
 * Файл из репозитория MikBill-PBX-HelpDesk-API
 * @link https://github.com/itpanda-llc/mikbill-pbx-helpdesk-api
 */

declare(strict_types=1);

namespace Panda\MikBill\Pbx\HelpDeskApi;

/**
 * Class Transaction
 * @package Panda\MikBill\Pbx\HelpDeskApi
 * Операции с транзакциями в БД
 */
class Transaction
{
    /**
     * Инициализация транзакции не удалась
     */
    private const BEGIN_EXCEPTION_MESSAGE = 'Transaction initialization failed';

    /**
     * Фиксация транзакции не удалась
     */
    private const COMMIT_EXCEPTION_MESSAGE = 'Commit a transaction failed';

    /**
     * Откат транзакции не удался
     */
    private const ROLLBACK_EXCEPTION_MESSAGE = 'Rollback a transaction failed';

    public static function begin(): void
    {
        try {
            if (!Db::connect()->beginTransaction())
                throw new Exception\SystemException(self::BEGIN_EXCEPTION_MESSAGE);
        } catch (\PDOException $e) {
            throw new Exception\DebugException($e->getMessage());
        }
    }

    public static function commit(): void
    {
        try {
            if (!Db::connect()->commit())
                throw new Exception\SystemException(self::COMMIT_EXCEPTION_MESSAGE);
        } catch (\PDOException $e) {
            throw new Exception\DebugException($e->getMessage());
        }
    }

    public static function rollBack(): void
    {
        try {
            if (!Db::connect()->rollBack())
                throw new Exception\SystemException(self::ROLLBACK_EXCEPTION_MESSAGE);
        } catch (\PDOException $e) {
            throw new Exception\DebugException($e->getMessage());
        }
    }
}
