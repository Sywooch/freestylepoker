<?php

use yii\helpers\Html;

if ($status) :
    ?>
    <div class="bankroll">
        <div class="bankroll_title">Банкролл  бесплатно</div>
        <hr class="newclass">
        <div class="row">
            <?php
            foreach ($bankroll as $key => $value) {
                static $p = 0;
                $p++;
                ?>


                <div class="col-sm-4">
                    <div class="bankroll-item">
                        <?= Html::img('/statics/web/bankroll/images/' . $value['img'], ['style' => 'padding:0; width: 238px;']); ?>
                        <div class="bankroll_text">
                            <?= $value['text'] ?>
                            <div class="bankroll_lot">
                                <?= $value['lot'] ?>
                            </div>
                        </div>
                        <p class="bankroll_footer">
                            <?= Html::a('Подробнее', $value['link']) ?>
                        </p>
                    </div>
                </div>

            <?php } ?>
        </div>

    <?php endif; ?>
