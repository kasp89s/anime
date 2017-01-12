<?php

namespace app\models;

use Yii;

/**
 * Модель таблицы "order".
 *
 * @property string  $id           Идентификатор.
 * @property string  $customerId   Ссылка на клиента.
 * @property string  $shippingId   Ссылка на способ доставки.
 * @property string  $paymentId    Ссылка на способ оплаты.
 * @property string  $currencyCode Код валюты.
 * @property string  $orderStatus  Статус заказа.
 * @property string  $couponCode   Код купона.
 * @property integer $createTime   Время создания.
 * @property integer $updateTime   Время обновления.
 * @property integer $isFinished   Флаг завершенного заказа.
 *
 * @property ShippingMethod      $shipping     Модель доставки.
 * @property Customer            $customer     Модель клиента.
 * @property PaymentMethod       $payment      Модель платежного метода.
 * @property OrderCustomerInfo[] $customerInfo Модель информации о клиенте.
 * @property OrderHistory[]      $orderHistory Модель истории заказа.
 * @property OrderPostBarcode[]  $postBarcode  Модель штрихкода.
 * @property OrderProduct[]      $products     Модель продукта.
 * @property OrderTotal[]        $total        Модель окончательной стоимости заказа.
 * @property OrderStatus[]       $status       Модель статуса заказа.
 *
 * @package app\models
 */
class Order extends \yii\db\ActiveRecord
{
    const CURRENCY_CODE = 'грн';
    /**
     * @inheritdoc
     */

    public $_totalWithoutCommission = false;

    public static function tableName()
    {
        return 'order';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['customerId', 'shippingId', 'paymentId', 'currencyCode', 'orderStatus'], 'required'],
            [['customerId', 'shippingId', 'paymentId', 'isFinished'], 'integer'],
            [['currencyCode'], 'string', 'max' => 3],
            [['orderStatus'], 'string', 'max' => 2],
            [['couponCode'], 'string', 'max' => 255],
            [['createTime', 'updateTime'], 'safe'],
            [['shippingId'], 'exist', 'skipOnError' => true, 'targetClass' => ShippingMethod::className(), 'targetAttribute' => ['shippingId' => 'id']],
            [['customerId'], 'exist', 'skipOnError' => true, 'targetClass' => Customer::className(), 'targetAttribute' => ['customerId' => 'id']],
            [['paymentId'], 'exist', 'skipOnError' => true, 'targetClass' => PaymentMethod::className(), 'targetAttribute' => ['paymentId' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'Номер заказа',
            'customerId' => 'Покупатель',
            'shippingId' => 'Доставка',
            'paymentId' => 'Оплата',
            'currencyCode' => 'Currency Code',
            'orderStatus' => 'Статус заказа',
            'couponCode' => 'Купон',
            'createTime' => 'Дата заказа',
            'updateTime' => 'Изменен',
            'isFinished' => 'Закончен',
            'fullName' => 'Имя и фамилия',
        ];
    }
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getShipping()
    {
        return $this->hasOne(ShippingMethod::className(), ['id' => 'shippingId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPayment()
    {
        return $this->hasOne(PaymentMethod::className(), ['id' => 'paymentId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCustomer()
    {
        return $this->hasOne(Customer::className(), ['id' => 'customerId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCustomerInfo()
    {
        return $this->hasOne(OrderCustomerInfo::className(), ['orderId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStatus()
    {
        return $this->hasOne(OrderStatus::className(), ['statusCode' => 'orderStatus']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrderHistory()
    {
        return $this->hasMany(OrderHistory::className(), ['orderId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPostBarcode()
    {
        return $this->hasOne(OrderPostBarcode::className(), ['orderId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProducts()
    {
        return $this->hasMany(OrderProduct::className(), ['orderId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTotal()
    {
        return $this->hasOne(OrderTotal::className(), ['orderId' => 'id']);
    }


    public function getFullName()
    {
        return $this->customerInfo->fullName;
    }

    /**
     * Возвращает скидку по купону.
     *
     * @return float|int|mixed
     */
    public function getDiscountByCoupon()
    {
        $coupon = Coupon::find()->where(['code' => $this->couponCode])->one();

        if (empty($coupon))
            return 0;

        if ($coupon->type == Coupon::TYPE_PERCENT) {
            return round($this->totalWithoutCommission / 100 * $coupon->value);
        }elseif ($coupon->type == Coupon::TYPE_VALUE) {
            return $coupon->value;
        }
    }

    /**
     * Возвращает стоимость с учётом коммисий.
     *
     * @return mixed
     */
    public function calculateAmountWithCommission()
    {
        return $this->totalWithoutCommission -
        $this->getDiscountByCoupon() -
        $this->customer->getDiscountByOrderAmount($this->totalWithoutCommission) +
        $this->payment->calculateIncrease($this->totalWithoutCommission) +
        $this->shipping->calculateIncrease($this->totalWithoutCommission);
    }

    /**
     * Возвращает стоимость без учёта комисий.
     *
     * @return bool|int|string
     */
    public function getTotalWithoutCommission()
    {
        if ($this->_totalWithoutCommission !== false) {
            return $this->_totalWithoutCommission;
        }

        $total = 0;
        foreach ($this->products as $product)
        {
            $total+= $product->productPrice * $product->productQuantity;
        }

        return $total;
    }

    /**
     * Возвращает форматированую дату.
     *
     * @param string $date
     *
     * @return bool|string
     */
    public static function getDate($date)
    {
        $time = strtotime($date);
        $monthData = [
            '01' => 'Января',
            '02' => 'Февраля',
            '03' => 'Марта',
            '04' => 'Апреля',
            '05' => 'Мая',
            '06' => 'Июня',
            '07' => 'Июля',
            '08' => 'Августа',
            '09' => 'Сентября',
            '10' => 'Октября',
            '11' => 'Ноября',
            '12' => 'Декабря'
        ];

        $month = $monthData[date('m', $time)];

        return date("d {$month} Y г.", $time);
    }

    /**
     * Выполняет отгрузку подуктов заказа со склада.
     */
    public function awayProducts()
    {
        foreach ($this->products as $product) {
            $product->product->quantityInStock-= $product->productQuantity;
            $product->product->quantityOfSold+= $product->productQuantity;
            $product->product->save();
        }
    }

    /**
     * Выполняет возврат продуктов заказа на склад.
     */
    public function returnProducts()
    {
        foreach ($this->products as $product) {
            $product->product->quantityInStock+= $product->productQuantity;
            $product->product->quantityOfSold-= $product->productQuantity;
            $product->product->save();
        }
    }

    /**
     * Выполняет пересчет скидки для клиента на основании сумарной стоимости выполненых заказов.
     */
    public function recalculateGroup()
    {
        // Считаем сумму покупок.
        $finishedStatuses = OrderStatus::find()->select('statusCode')->where(['isFinished' => 1])->asArray()->one();
        $purchaseAmount = Order::find()
            ->select('SUM(amount) as sum, order.id')
            ->joinWith('total', false)
            ->where([
                'order.customerId' => $this->customerId,
                'order.orderStatus' => $finishedStatuses
            ])
            ->asArray()->one();

        // Находим автогруппу с подходящим лимитом.
        $suitableGroup = CustomerGroup::find()
            ->where([
                'isAutomaticGroup' => 1,
                'isActive' => 1,
            ])
            ->andWhere('groupAccumulatedLimit <= :amount', [':amount' => $purchaseAmount['sum']])
            ->orderBy('groupAccumulatedLimit desc')
            ->one();

        // устанавливаем текущей если найдена.
        if (!empty($suitableGroup))
        {
            $this->customer->customerGroupId = $suitableGroup->id;
            $this->customer->save();
        }
    }

    /**
     * Выполняет пересчёт сумарной стоимости заказа.
     */
    public function recalculateTotal()
    {
        $totalWithCommission = $this->calculateAmountWithCommission();
        $this->total->amount = $totalWithCommission;
        $this->total->save();
    }
}
