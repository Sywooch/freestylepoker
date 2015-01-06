<?php

/**
 * @link https://github.com/himiklab/yii2-sortable-grid-view-widget
 * @copyright Copyright (c) 2014 HimikLab
 * @license http://opensource.org/licenses/MIT MIT
 */

namespace himiklab\sortablegrid;

use yii\base\Behavior;
use yii\db\ActiveRecord;
use yii\base\InvalidConfigException;

/**
 * Behavior for sortable Yii2 GridView widget.
 *
 * For example:
 *
 * ```php
 * public function behaviors()
 * {
 *    return [
 *       'sort' => [
 *           'class' => SortableGridBehavior::className(),
 *           'sortableAttribute' => 'sortOrder'
 *       ],
 *   ];
 * }
 * ```
 *
 * @author HimikLab
 * @package himiklab\sortablegrid
 */
class SortableGridBehavior extends Behavior {

    /** @var string database field name for row sorting */
    public $sortableAttribute = 'sortOrder';

    public function events() {
        return [ActiveRecord::EVENT_BEFORE_INSERT => 'beforeInsert'];
    }

    public function gridSort($items) {
        /** @var ActiveRecord $model */
        $model = $this->owner;
        if (!$model->hasAttribute($this->sortableAttribute)) {
            throw new InvalidConfigException("Model does not have sortable attribute `{$this->sortableAttribute}`.");
        }

        $model::getDb()->transaction(function () use ($model, $items) {
            $i = 0;
            $t = 0;
            $l = false;
            $result = count($items);
//            $b = [$result => 6];
//            $items = \yii\helpers\ArrayHelper::merge($items, $b);
            foreach ($items as $item) {
                /** @var \yii\db\ActiveRecord $row */
//                $row = $model::findOne($item);
//                if ($row->{$this->sortableAttribute} != $i) {
//                    $row->updateAttributes([$this->sortableAttribute => $i]);
//                }
//                ++$i;

                $row = $model::findOne($item);
                $f = $row->{$this->sortableAttribute};
                $t++;
                if ($f > $i) {
                    if ($l === false) {
                        $i = $row->{$this->sortableAttribute};
                        $j = $row->{$this->sortableAttribute};
                        $it = $item;
                    } else {
                        $row3 = $model::findOne($it);
                        $row3->updateAttributes([$this->sortableAttribute => $j]);
                    }
                } else if ($f < $i) {
                    $row2 = $model::findOne($it);
                    if ($t === $result) {
                        $row2->updateAttributes([$this->sortableAttribute => $j]);
                    } else {
                        $row2->updateAttributes([$this->sortableAttribute => $f]);
                    }
                    $x = $row->{$this->sortableAttribute};
                    $it = $item;
                    $l = true;
                }


//                $row = $model::findOne($item);
//                if ($row->{$this->sortableAttribute} > $i) {
//                    if ($l === false) {
//                        $i = $row->{$this->sortableAttribute};
//                        $j = $row->{$this->sortableAttribute};
//                        $it = $item;
//                    } else {
//                        $row = $model::findOne($it);
//                        $row->updateAttributes([$this->sortableAttribute => $j]);
//                        $l = false;
//                    }
//                } else if ($row->{$this->sortableAttribute} < $i) {
//                    $atr = $row->{$this->sortableAttribute};
//                    $row->updateAttributes([$this->sortableAttribute => $i]);
//                    $i = $atr;
//                    $l = true;
//                }
//                
//                $row = $model::findOne($item);
//                if ($row->{$this->sortableAttribute} > $i) {
//                    if ($l === true) {
//                        $row->updateAttributes([$this->sortableAttribute => $i]);
//                        $row2 = $model::findOne($it);
//                        $row2->updateAttributes([$this->sortableAttribute => $row->{$this->sortableAttribute}]);
//                    } else {
//                        $i = $row->{$this->sortableAttribute};
//                        $it = $item;
//                    }
//                } else if ($row->{$this->sortableAttribute} < $i) {
//                    $l = true;
//                }
            }
        });
    }

    public function beforeInsert() {
        /** @var ActiveRecord $model */
        $model = $this->owner;
        if (!$model->hasAttribute($this->sortableAttribute)) {
            throw new InvalidConfigException("Invalid sortable attribute `{$this->sortableAttribute}`.");
        }

        $maxOrder = $model->find()->max($model->tableName() . '.' . $this->sortableAttribute);

        $model->{$this->sortableAttribute} = $maxOrder + 1;
    }

}
