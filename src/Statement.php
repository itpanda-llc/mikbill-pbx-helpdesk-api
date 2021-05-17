<?php

/**
 * Файл из репозитория MikBill-PBX-HelpDesk-API
 * @link https://github.com/itpanda-llc/mikbill-pbx-helpdesk-api
 */

declare(strict_types=1);

namespace Panda\MikBill\Pbx\HelpDeskApi;

/**
 * Class Statement
 * @package Panda\MikBill\Pbx\HelpDeskApi
 * Операции с запросами к БД
 */
class Statement
{
    /**
     * Подготовление запроса не удалось
     */
    private const PREPARE_EXCEPTION_MESSAGE = 'Request preparation failed';

    /**
     * Выполнение запроса не удалось
     */
    private const LAUNCH_EXCEPTION_MESSAGE = 'Query launch failed';

    /**
     * @param string $statement Подготавливаемый запрос
     * @return \PDOStatement Объект для работы с запросом
     */
    public static function prepare(string $statement): \PDOStatement
    {
        try {
            if (($sth = Db::connect()->prepare($statement)) === false)
                throw new Exception\SystemException(self::PREPARE_EXCEPTION_MESSAGE);

            return $sth;
        } catch (\PDOException $e) {
            throw new Exception\DebugException($e->getMessage());
        }
    }

    /**
     * @param \PDOStatement $sth Объект для работы с запросом
     */
    public static function execute(\PDOStatement $sth): void
    {
        try {
            if (($sth = $sth->execute()) === false)
                throw new Exception\SystemException(self::LAUNCH_EXCEPTION_MESSAGE);
        } catch (\PDOException $e) {
            throw new Exception\DebugException($e->getMessage());
        }
    }

    /**
     * @param string $statement Запрос
     * @return \PDOStatement Объект для работы с запросом
     */
    public static function query(string $statement): \PDOStatement
    {
        try {
            if (($sth = Db::connect()->query($statement)) === false)
                throw new Exception\SystemException(self::LAUNCH_EXCEPTION_MESSAGE);

            return $sth;
        } catch (\PDOException $e) {
            throw new Exception\DebugException($e->getMessage());
        }
    }

    /**
     * @param string $statement Запрос
     * @return int Количество строк
     */
    public static function exec(string $statement): int
    {
        try {
            if (($result = Db::connect()->exec($statement)) === false)
                throw new Exception\SystemException(self::LAUNCH_EXCEPTION_MESSAGE);

            return $result;
        } catch (\PDOException $e) {
            throw new Exception\DebugException($e->getMessage());
        }
    }
}
