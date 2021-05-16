<?php

/**
 * Файл из репозитория MikBill-VPBX-HelpDesk-API
 * @link https://github.com/itpanda-llc/mikbill-vpbx-helpdesk-api
 */

declare(strict_types=1);

namespace Panda\MikBill\Vpbx\HelpDeskApi;

use Panda\SmsPilot\MessengerSdk;
use Panda\Yandex\TranslateSdk;

/**
 * Class Logic
 * @package Panda\MikBill\Vpbx\HelpDeskApi
 * Проверка запроса и формирование ответа
 */
class Logic
{
    /**
     * @var string|null Секрет
     */
    private $secret;

    /**
     * @var string|null Тип запроса
     */
    private $type;

    /**
     * @var string|null Язык
     */
    private $lang;

    /**
     * @var string|null Номер телефона
     */
    private $cId;

    /**
     * @var string Статус ответа
     */
    public $status = Status::OK_200;

    /**
     * @var string|null Контент
     */
    public $content;

    public function __construct()
    {
        $query = (empty($_GET)) ? $_POST : $_GET;

        $this->secret = (!empty($query[Param::SECRET]))
            ? $query[Param::SECRET]
            : null;
        $this->type = (!empty($query[Param::TYPE]))
            ? $query[Param::TYPE]
            : null;
        $this->lang = (!empty($query[Param::LANG]))
            ? $query[Param::LANG]
            : null;
        $this->cId = (!empty($query[Param::C_ID]))
            ? $query[Param::C_ID]
            : null;
    }

    public function run(): void
    {
        try {
            $secrets = (new \ReflectionClass(Auth::class))->getConstants();
        } catch (\ReflectionException $e) {
            throw new Exception\DebugException($e->getMessage());
        }

        if (!in_array($this->secret, $secrets, true)) {
            $this->status = Status::FORBIDDEN_403;
            $this->content = Response::getError(Code::REQUEST_ERROR,
                Message::SECRET_ERROR);

            return;
        }

        try {
            $types = (new \ReflectionClass(Type::class))->getConstants();
        } catch (\ReflectionException $e) {
            throw new Exception\DebugException($e->getMessage());
        }

        if (!in_array($this->type, $types, true)) {
            $this->status = Status::BAD_REQUEST_400;
            $this->content = Response::getError(Code::REQUEST_ERROR,
                Message::TYPE_ERROR);

            return;
        }

        if (is_null($this->cId)) {
            $this->status = Status::BAD_REQUEST_400;
            $this->content = Response::getError(Code::REQUEST_ERROR,
                Message::C_ID_ERROR);

            return;
        }

        if (($this->type === Type::OPINION)
            && (is_null(Query::checkClient($this->cId))))
        {
            $this->content = Response::getError(Code::DEFAULT,
                Message::TICKET_EXISTS_NOT_REQUIRED);

            return;
        }

        if ((!is_null($this->lang)) && ($this->lang !== 'ru')) {
            try {
                $cloud = (defined('\Panda\MikBill\Vpbx\HelpDeskApi\Cloud::API_KEY'))
                    ? TranslateSdk\Cloud::createApi(Cloud::API_KEY)
                    : new TranslateSdk\Cloud(Cloud::OAUTH_TOKEN, Cloud::FOLDER_ID);

                $response = json_decode($cloud->request(new TranslateSdk\Languages));
            } catch (TranslateSdk\Exception\ClientException | \TypeError $e) {
                throw new Exception\DebugException($e->getMessage());
            }

            $langs = array_map(function(\stdClass $a) { return $a->code; },
                    $response->languages);

            if (!in_array($this->lang, $langs, true)) {
                $this->status = Status::BAD_REQUEST_400;
                $this->content = Response::getError(Code::REQUEST_ERROR,
                    Message::LANG_ERROR);

                return;
            }
        }

        if (!is_null(Query::checkTicket($this->cId))) {
            $this->content = Response::getError(Code::DEFAULT,
                Message::TICKET_EXISTS_NOT_REQUIRED);

            return;
        }

        if ((!Query::checkCategory()) && (!Query::addCategory())) {
            $this->status = Status::INTERNAL_500;
            $this->content = Response::getError(Code::SYSTEM_ERROR,
                Message::CREATE_TICKET_CATEGORY_ERROR);

            return;
        }

        Transaction::begin();

        if ((!Query::addTicket($this->cId,
                ((!is_null(Query::checkClient($this->cId)))
                    ? Ticket\Param::SHOW_TICKET_TO_USER
                    : Ticket\Param::NOT_SHOW_TICKET_TO_USER)))
            || (is_null($ticket = Query::checkTicket($this->cId))))
        {
            Transaction::rollBack();

            $this->status = Status::INTERNAL_500;
            $this->content = Response::getError(Code::SYSTEM_ERROR,
                Message::CREATE_TICKET_ERROR);

            return;
        }

        if (!Query::addNote($ticket[Field::TICKET_ID], Ticket\Param::NOTE)) {
            Transaction::rollBack();

            $this->status = Status::INTERNAL_500;
            $this->content = Response::getError(Code::SYSTEM_ERROR,
                Message::CREATE_TICKET_NOTE_ERROR);

            return;
        }

        if (!is_null($client = Query::checkClient($this->cId))) {
            switch (true) {
                case ($this->type === Type::OPINION):
                    $message = sprintf("%s %s! %s %s",
                        Ticket\Ru\Opinion::getIntro(),
                        $client[Field::NAME],
                        Ticket\Ru\Opinion::getSample(),
                        Ticket\Ru\Opinion::getOutro());

                    break;

                case ($this->type === Type::CALLBACK):
                    $message = sprintf("%s %s! %s",
                        Ticket\Ru\Callback::getIntro(),
                        $client[Field::NAME],
                        Ticket\Ru\Callback::getSample());
            }

            if ((!is_null($this->lang)) && ($this->lang !== 'ru')) {
                try {
                    $translate = new TranslateSdk\Translate($message, $this->lang);

                    $response = json_decode($cloud->request($translate));
                } catch (TranslateSdk\Exception\ClientException $e) {
                    throw new Exception\DebugException($e->getMessage());
                }

                $message = (string) $response->translations[0]->text;
            }

            if ((!Query::addMessage($ticket[Field::TICKET_ID], $message))) {
                Transaction::rollBack();

                $this->status = Status::INTERNAL_500;
                $this->content = Response::getError(Code::SYSTEM_ERROR,
                    Message::CREATE_TICKET_MESSAGE_ERROR);

                return;
            }

            Transaction::commit();

            $link = sprintf("%s?l=%s&p=%s&lang=%s",
                Notice\Param::CABINET_URL,
                $client[Field::LOGIN],
                $client[Field::PASSWORD],
                ($this->lang !== 'en')
                    ? Notice\Param::RU_CABINET_LANG
                    : Notice\Param::EN_CABINET_LANG);

            switch (true) {
                case ($this->type === Type::OPINION):
                    $message = sprintf("%s, %s %s. %s %s",
                        $client[Field::NAME],
                        Notice\Ru\Opinion::getSample(),
                        Notice\Param::COMPANY_NAME,
                        Notice\Ru\Opinion::getOutro(),
                        $link);

                    break;

                case ($this->type === Type::CALLBACK):
                    $message = sprintf("%s, %s %s. %s %s",
                        $client[Field::NAME],
                        Notice\Ru\Callback::getSample(),
                        Notice\Param::COMPANY_NAME,
                        Notice\Ru\Callback::getOutro(),
                        $link);
            }

            if ((!is_null($this->lang)) && ($this->lang !== 'ru')) {
                try {
                    $translate = new TranslateSdk\Translate($message, $this->lang);

                    $response = json_decode($cloud->request($translate));
                } catch (TranslateSdk\Exception\ClientException $e) {
                    throw new Exception\DebugException($e->getMessage());
                }

                $message = (string) $response->translations[0]->text;
            }

            $pilot = new MessengerSdk\Pilot(Pilot::API_KEY);

            $singleton = new MessengerSdk\Singleton($message,
                $this->cId,
                Pilot::SENDER_NAME);

            $singleton->setFormat(MessengerSdk\Format::JSON);

            if ($this->type === Type::OPINION) {
                try {
                    $dateTime = new \DateTime("now");

                    $dateTime->add(new \DateInterval('PT5M'));
                } catch (\Exception $e) {
                    throw new Exception\DebugException($e->getMessage());
                }

                $singleton->setSendDatetime($dateTime->format('Y-m-d H:i:s'));
            }

            try {
                $j = json_decode($pilot->request($singleton));
            } catch (MessengerSdk\Exception\ClientException $e) {
                $error = Notice\Param::ERROR_TEXT;
            }

            $error = $error ?? $j->error->description ?? '';

            if (!Query::logMessage($client[Field::U_ID],
                $this->cId, $message, $error))
            {
                $this->status = Status::INTERNAL_500;
                $this->content = Response::getError(Code::SYSTEM_ERROR,
                    Message::LOG_SMS_MESSAGE_ERROR);

                return;
            }
        } else
            Transaction::commit();

        $this->content = Response::getError(Code::DEFAULT,
            Message::CREATE_TICKET_OK);
    }
}
