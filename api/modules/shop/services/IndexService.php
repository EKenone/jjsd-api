<?php


namespace api\modules\shop\services;


use api\modules\shop\models\Order;
use yii\db\Expression;
use yii\helpers\ArrayHelper;

class IndexService extends Service
{
    public function home()
    {
        $amountData = Order::find()
            ->select(['SUM(amount) amount', 'SUM(real_amount) real_amount'])
            ->notDelete()
            ->andWhere(['>=', 'created_at', strtotime(date('Y-m-d'))])
            ->one();

        $totalAmount = ArrayHelper::getValue($amountData, 'amount', 0);
        $totalRealAmount = ArrayHelper::getValue($amountData, 'real_amount', 0);

        $orderStatusNum = Order::find()
            ->select(['status', 'count(*) as num'])
            ->notDelete()
            ->andWhere(['>=', 'created_at', strtotime(date('Y-m-d'))])
            ->groupBy(['status'])
            ->asArray()
            ->all() ?: [];

        $orderNum = $orderDelivery = $orderCredit = 0;
        foreach ($orderStatusNum as $item) {
            if (in_array($item['status'], [2, 3, 4, 5])) {
                $orderDelivery += $item['num'];
            }
            if ($item['status'] == 4) {
                $orderCredit += $item['num'];
            }
            $orderNum += $item['num'];
        }

        // 近7日营业额数据
        $sevenDayAmountData = Order::find()
            ->select([new Expression('FROM_UNIXTIME(created_at, "%Y-%m-%d") as date'), 'SUM(amount) as amount', 'SUM(real_amount) real_amount'])
            ->notDelete()
            ->andWhere(['>=', 'created_at', strtotime(date('Y-m-d', strtotime('-6 day')))])
            ->asArray()
            ->groupBy(['date'])
            ->all();

        $sevenDayAmountData = ArrayHelper::index($sevenDayAmountData, 'date');

        $sevenDayAmount = [];
        for ($i = 6; $i >= 0; $i--) {
            $time = strtotime("-{$i} day");
            $date = date('Y-m-d', $time);
            $dateMd = date('m-d', $time);
            $sevenDayAmount[] = [
                '日期' => $dateMd,
                '营业额' => ArrayHelper::getValue($sevenDayAmountData, $date . '.amount', 0),
                '实收金额' => ArrayHelper::getValue($sevenDayAmountData, $date . '.real_amount', 0)
            ];
        }

        // 近7日订单数据
        $orderStatusNumData = Order::find()
            ->select([new Expression('FROM_UNIXTIME(created_at, "%Y-%m-%d") as date'), 'status', 'count(*) as num'])
            ->notDelete()
            ->andWhere(['>=', 'created_at', strtotime(date('Y-m-d', strtotime('-6 day')))])
            ->groupBy(['status', 'date'])
            ->asArray()
            ->all() ?: [];

        $orderData = [];
        foreach ($orderStatusNumData as $item) {
            if (!key_exists($item['date'], $orderData)) {
                $orderData[$item['date']] = ['num' => 0, 'delivery' => 0, 'credit' => 0];
            }

            if (in_array($item['status'], [2, 3, 4, 5])) {
                $orderData[$item['date']]['delivery'] += $item['num'];
            }

            if ($item['status'] == 4) {
                $orderData[$item['date']]['credit'] += $item['num'];
            }

            $orderData[$item['date']]['num'] += $item['num'];
        }
        $sevenDayOrder = [];
        for ($i = 6; $i >= 0; $i--) {
            $time = strtotime("-{$i} day");
            $date = date('Y-m-d', $time);
            $dateMd = date('m-d', $time);
            $sevenDayOrder[] = [
                '日期' => $dateMd,
                '下单数' => ArrayHelper::getValue($orderData, $date . '.num', 0),
                '配送完成数' => ArrayHelper::getValue($orderData, $date . '.delivery', 0),
                '未付款订单数' => ArrayHelper::getValue($orderData, $date . '.credit', 0),
            ];
        }

        $topThreeAmount = Order::find()
            ->select(['c.name name', 'c.phone phone', 'customer_id', 'SUM(amount) amount'])
            ->joinWith(['customer c'])
            ->notDelete()
            ->andWhere(['>=', Order::withDatabaseName('created_at'), strtotime(date('Y-m-d'))])
            ->orderBy('amount desc')
            ->groupBy('customer_id')
            ->asArray()
            ->all() ?: [];

        $topThreeAmountWeek = Order::find()
            ->select(['c.name name', 'c.phone phone', 'customer_id', 'SUM(amount) amount'])
            ->joinWith(['customer c'])
            ->notDelete()
            ->andWhere(['>=', Order::withDatabaseName('created_at'), strtotime(date('Y-m-d', strtotime('-6 day')))])
            ->orderBy('amount desc')
            ->groupBy('customer_id')
            ->asArray()
            ->all() ?: [];

        return [
            'total_amount' => number_format($totalAmount, 2),
            'total_real_amount' => number_format($totalRealAmount, 2),
            'order_num' => $orderNum,
            'order_delivery' => $orderDelivery,
            'order_credit' => $orderCredit,
            'seven_day_amount' => $sevenDayAmount,
            'seven_day_order' => $sevenDayOrder,
            'top_three_amount' => array_slice($topThreeAmount, 0, 3),
            'top_three_amount_week' => array_slice($topThreeAmountWeek, 0, 3),
        ];
    }
}