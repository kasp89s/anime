<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "order".
 *
 * @property string $id
 * @property string $customerId
 * @property string $shippingId
 * @property string $paymentId
 * @property string $currencyCode
 * @property string $orderStatus
 * @property string $couponCode
 * @property integer $createTime
 * @property integer $updateTime
 * @property integer $isFinished
 *
 * @property ShippingMethod $shipping
 * @property Customer $customer
 * @property PaymentMethod $payment
 * @property OrderCustomerInfo[] $customerInfo
 * @property OrderHistory[] $orderHistory
 * @property OrderPostBarcode[] $postBarcode
 * @property OrderProduct[] $products
 * @property OrderTotal[] $total
 * @property OrderStatus[] $status
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

    public function calculateAmountWithCommission()
    {
        return $this->totalWithoutCommission -
        $this->getDiscountByCoupon() -
        $this->customer->getDiscountByOrderAmount($this->totalWithoutCommission) +
        $this->payment->calculateIncrease($this->totalWithoutCommission) +
        $this->shipping->calculateIncrease($this->totalWithoutCommission);
    }

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

    public function awayProducts()
    {
        foreach ($this->products as $product) {
            $product->product->quantityInStock-= $product->productQuantity;
            $product->product->quantityOfSold+= $product->productQuantity;
            $product->product->save();
        }
    }

    public function returnProducts()
    {
        foreach ($this->products as $product) {
            $product->product->quantityInStock+= $product->productQuantity;
            $product->product->quantityOfSold-= $product->productQuantity;
            $product->product->save();
        }
    }

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

    public function recalculateTotal()
    {
        $totalWithCommission = $this->calculateAmountWithCommission();
        $this->total->amount = $totalWithCommission;
        $this->total->save();
    }
}
