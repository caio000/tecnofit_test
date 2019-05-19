<?php

namespace app\controllers;

use Yii;
use app\models\Order;
use app\models\Product;
use app\models\OrderProduct;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;

/**
 * OrderController implements the CRUD actions for Order model.
 */
class OrderController extends Controller
{
    /**
     * Lists all Order models.
     * @return mixed
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Order::find(),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Order model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => OrderProduct::find()->where(['idOrder' => $id])->all(),
        ]);
    }

    /**
     * Creates a new Order model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Order();
        $products = Product::find()->all();

        if ($request = Yii::$app->request->post()) {
            $connection = Yii::$app->db;
            $transaction = $connection->beginTransaction();
            try {
              $model->save();

              foreach ($request['Order']['products'] as $idProduct) {
                $orderProduct = new OrderProduct();

                $orderProduct->idOrder = $model->id;
                $orderProduct->idProduct = $idProduct;
                $orderProduct->save();
              }

              $transaction->commit();

              $redirectTo = ['view', 'id' => $model->id];
            } catch (\Exception $e) {
              $transaction->rollback();
              $redirectTo = ['index'];
            }
            return $this->redirect($redirectTo);
        }

        return $this->render('create', [
            'model' => $model,
            'products' => ArrayHelper::map($products, 'id', 'name'),
        ]);
    }

    /**
     * Updates an existing Order model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $model->products = array_map(function ($order){
          return $order->product->id;
        }, $model->orderProducts);
        $products = Product::find()->all();

        if ($request = Yii::$app->request->post()) {
            $connection = Yii::$app->db;
            $transaction = $connection->beginTransaction();
            try {

              $model->save();
              OrderProduct::deleteAll("idOrder = {$model->id}");

              foreach ($request['Order']['products'] as $idProduct) {
                $orderProduct = new OrderProduct();

                $orderProduct->idOrder = $model->id;
                $orderProduct->idProduct = $idProduct;
                $orderProduct->save();
              }

              $transaction->commit();

              $redirectTo = ['view', 'id' => $model->id];
            } catch (\Exception $e) {
              $transaction->rollback();
              $redirectTo = ['index'];
            }
            return $this->redirect($redirectTo);
        }

        return $this->render('update', [
            'model' => $model,
            'products' => ArrayHelper::map($products, 'id', 'name'),
        ]);
    }

    /**
     * Deletes an existing Order model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        OrderProduct::deleteAll("idOrder = {$id}");
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Order model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Order the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Order::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
