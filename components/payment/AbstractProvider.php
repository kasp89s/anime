<?php
namespace app\components\payment;

use app\models\Order;
use app\models\OrderStatus;
use app\models\OrderHistory;
use app\models\User;
use app\models\PaymentTransaction;
use yii\base\Exception;

/**
 * Class AbstractProvider при подключении новой платежной системы необходимо наследовать данный класс.
 *
 * Пример получаения внутренего идентификатора платежной транзакции.
 *
 * $provider = new WebmoneyProvider();
 * $transactionId = $provider->createTransaction($order);
 *
 * Пример использывания платежного провайдера WebmoneyProvider extends AbstractProvider для подтверждения транзакции:
 *
 * $provider = new WebmoneyProvider();
 *
 * $transaction = $provider->notification($_POST);
 *
 * if (!empty($transaction)) {
 *      $provider->completeTransaction($transaction)
 * }
 *
 * @package app\components\payment
 */
abstract class AbstractProvider
{
    /**
     * Процесс проверки подписи от платежной системы.
     *
     * Необходимо реализовать проверку подписи от ПС в случае успеха вернуть екземпляр платежной транзакции.
     *
     * @param $data
     *
     * @return PaymentTransaction $transaction|bull
     */
    abstract public function notification($data);

    /**
     * Создает новую платежную транзакцию
     *
     * @param Order $order Модель заказа.
     *
     * @return string Идентификатор платежной транзакции.
     *
     * @throws Exception
     */
    public final function createTransaction(Order $order)
    {
        $transaction = new PaymentTransaction();
        $transaction->attributes = [
            'customerId' => $order->customerId,
            'orderId' => $order->id,
            'paymentMethodId' => $order->paymentId,
            'amount' => $order->total->amount,
            'dateCreated' => date('Y-m-d H:i:s', time()),
        ];

        if (!$transaction->validate()) {
            throw new Exception('Ошибка создания транзакции');
        }

        $transaction->save();

        return $transaction->id;
    }

    /**
     * Подтверждает оплату по транзакцие и переводит заказ в статус оплаченого.
     *
     * @param PaymentTransaction $transaction Модель транзакции.
     *
     * @throws Exception
     */
    public final function completeTransaction(PaymentTransaction $transaction)
    {
        $statusPaid = OrderStatus::find()->where('isPaid = 1')->one();

        if (empty($statusPaid)) {
            throw new Exception('Не определен статус оплаченого заказа (isPaid)');
        }

        $transaction->status = 'success';
        $transaction->dateComplete = date('Y-m-d H:i:s', time());
        $transaction->save();

        $transaction->order->orderStatus = $statusPaid->statusCode;

        $historyModel = new OrderHistory();
        $historyModel->orderId = $transaction->order->id;
        $historyModel->createUserId = User::DEFAULT_USER;
        $historyModel->orderStatus = $statusPaid->statusCode;
        $historyModel->save();

        $isRecalculate = false;
        if ($statusPaid->isAway($transaction->order->status)) {
            $transaction->order->awayProducts();
        }

        if ($statusPaid->isReturn($transaction->order->status)) {
            $transaction->order->returnProducts();
        }

        if ($statusPaid->isRecalculateGroup($transaction->order->status)) {
            $isRecalculate = true;
        }

        if ($isRecalculate) {
            $transaction->order->recalculateGroup();
        }

        $transaction->order->save();
    }

    /**
     * Отменяет оплату по транзакцие и переводит заказ в статус отмененного.
     *
     * @param PaymentTransaction $transaction Модель транзакции.
     *
     * @throws Exception
     */
    public final function cancelTransaction(PaymentTransaction $transaction)
    {
        $statusCancel = OrderStatus::find()->where('isPenalty = 1')->one();

        if (empty($statusCancel)) {
            throw new Exception('Не определен статус отмененного заказа (isPenalty)');
        }

        $transaction->status = 'error';
        $transaction->dateComplete = date('Y-m-d H:i:s', time());
        $transaction->save();

        $historyModel = new OrderHistory();
        $historyModel->orderId = $transaction->order->id;
        $historyModel->createUserId = User::DEFAULT_USER;
        $historyModel->orderStatus = $statusCancel->statusCode;
        $historyModel->save();

        $transaction->order->orderStatus = $statusCancel->statusCode;
        $transaction->order->save();
    }
}

