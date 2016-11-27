<?php

namespace app\controllers;

use app\models\BasketProduct;
use app\models\BasketProductAttribute;
use app\models\Product;
use app\models\WishList;
use Yii;
use yii\web\Response;

class AjaxController extends AbstractController
{
	private $_post;
	
	public function init()
	{
        parent::init();

        if (!Yii::$app->request->isAjax) {
			throw new \yii\web\NotFoundHttpException();
		}
		
		$this->_post = Yii::$app->request->post();
	}

	public function actionAddWish()
	{
        Yii::$app->response->format = Response::FORMAT_JSON;

	    $wish = WishList::find()->where([
	        'productId' => $this->_post['productId'],
	        'customerId' => $this->user->id,
        ])->one();

        if (!empty($wish)) {
            $wish->delete();
            return ['success' => 'remove'];
        }

        $wish = new WishList();
        $wish->customerId = $this->user->id;
        $wish->productId = $this->_post['productId'];
        $wish->save();

        return ['success' => 'add'];
	}

	public function actionSetBasketProductCount()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;

        $basketProduct = BasketProduct::find()->where(['id' => $this->_post['productId']])->one();

        if (empty($basketProduct)) {
            return ['error' => 'Товар не найден в корзине!'];
        }

        $newQuantity = $this->_post['count'] + (int) $this->_post['value'];
        if ($newQuantity <= 0) {
            $basketProduct->delete();
            return ['success' => 'remove'];
        }

        $basketProduct->quantity = $newQuantity;
        $basketProduct->save();

        return ['success' => 'update'];
    }

    public function actionAddProduct()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;

        $basketProducts = BasketProduct::find()
            ->where([
                'basketId' => $this->_basket->id,
                'productId' => $this->_post['productId']
            ])->all();

        if (empty($basketProducts)) {
            // В корзине нет такого продукта.
            $basketProduct = new BasketProduct();
            $basketProduct->basketId = $this->_basket->id;
            $basketProduct->productId = $this->_post['productId'];
            $basketProduct->quantity = Product::DEFAULT_QUANTITY;
            if (!$basketProduct->validate())
                return $basketProduct->getErrors();

            $basketProduct->save();
            if (!empty($this->_post['option'])) {
                foreach ($this->_post['option'] as $optionId => $optionValueId) {
                    $basketProductAttribute = new BasketProductAttribute();
                    $basketProductAttribute->basketProductId = $basketProduct->id;
                    $basketProductAttribute->productOptionId = $optionId;
                    $basketProductAttribute->productOptionValueId = $optionValueId;
                    if (!$basketProductAttribute->validate())
                        return $basketProductAttribute->getErrors();

                    $basketProductAttribute->save();
                }
            }
        } else {
            // В корзине есть продукт, но неизвестно есть ли с нужными атрибутами.
            // Если пользователь указал атрибуты, проверим есть ли в корзине товар с выбраными атрибутами
            if (!empty($this->_post['option'])) {

                $isFind = false;
                foreach ($basketProducts as $product) {
                    $attributes = [];
                    if (!empty($product->productAttributes)) {
                        foreach ($product->productAttributes as $productAttribute) {
                            $attributes[$productAttribute->productOptionId] = $productAttribute->productOptionValueId;
                        }
                    }

                    // Сравним атрибуты товара в корзине и переданые юзером.
                    $diff = array_diff($attributes, $this->_post['option']);

                    // Если нет различий найден товар с нужными атрибутами.
                    // Добавляем количество.
                    if (empty($diff)) {
                        $product->quantity+= Product::DEFAULT_QUANTITY;
                        $product->save();
                        $isFind = true;
                        break;
                    }
                }

                // Если нужный продукт небыл найден, добавим его в корзину.
                if (empty($isFind)) {
                    $basketProduct = new BasketProduct();
                    $basketProduct->basketId = $this->_basket->id;
                    $basketProduct->productId = $this->_post['productId'];
                    $basketProduct->quantity = Product::DEFAULT_QUANTITY;
                    $basketProduct->save();
                    foreach ($this->_post['option'] as $optionId => $optionValueId) {
                        $basketProductAttribute = new BasketProductAttribute();
                        $basketProductAttribute->basketProductId = $basketProduct->id;
                        $basketProductAttribute->productOptionId = $optionId;
                        $basketProductAttribute->productOptionValueId = $optionValueId;
                        $basketProductAttribute->save();
                    }
                }
            } else {
                // Если пользователь не указал атрибуты ищем товар без атрибутов.
                $isFind = false;
                foreach ($basketProducts as $product) {

                    // Найден товар без атрибутов добавим количество.
                    if (empty($product->productAttributes)) {
                        $product->quantity+= Product::DEFAULT_QUANTITY;
                        $product->save();
                        $isFind = true;
                        break;
                    }
                }

                // Если нужный продукт небыл найден, добавим его в корзину.
                if (empty($isFind)) {
                    $basketProduct = new BasketProduct();
                    $basketProduct->basketId = $this->_basket->id;
                    $basketProduct->productId = $this->_post['productId'];
                    $basketProduct->quantity = Product::DEFAULT_QUANTITY;
                    $basketProduct->save();
                }
            }
        }

        return ['success' => 'add'];
    }

    public function actionGetNumberField()
    {
        return $this->renderPartial('number-field', ['maskedValidator' => $this->_post['maskedValidator']]);
    }
}
