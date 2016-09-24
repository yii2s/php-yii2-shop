<?php

use yii\helpers\Html;
use yii\web\JqueryAsset;

$this->title = 'zcShop商城系统';
?>
<?= Html::cssFile('public/frontend/menu/css/index.css')?>
<div class="jumbotron" style="background-color: #ffffff">
    <h1>Welcome to zcShop!</h1>
    <p></p>
    <p>欢迎来到zcShop商城系统(^o^)</p>
</div>
<div class="row" style="margin-top: 20px">
    <div class="col-lg-2">
        <div id="recommend-goods">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">相关推荐</h3>
                </div>
                <div class="panel-body">
                    <?php foreach((array)$commendGoods as $commend) { ?>
                    <div class="" style="width: 100%;">
                        <div class="thumbnail" style="border: #ffffff">
                            <img src="<?= $commend['ad_img']; ?>" onerror='this.src="public/common/images/1.jpg"' alt="<?= $commend['name']; ?>">
                            <div class="caption">
                                <h3 style="color: #E4393C">¥<?= $commend['sell_price'];?></h3>
                                <p><a href="<?= Yii::$app->urlManager->createUrl(['goods/detail','id'=>$commend['id']])?>" style="color: #333333"><?= $commend['name']; ?></a></p>
                            </div>
                        </div>
                    </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-10">
        <div class="row">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">热门商品</h3>
                </div>
                <div class="panel-body">
                    <?php foreach((array)$hotGoods as $hot) { ?>
                        <div class="col-sm-6 col-md-3">
                            <div class="thumbnail">
                                <img src="<?= $hot['ad_img']; ?>" onerror='this.src="public/common/images/buy1.jpg"'
                                     alt="<?= $hot['name']; ?>">
                                <div class="caption">
                                    <h3 style="color: #E4393C">¥<?= $hot['sell_price']; ?></h3>
                                    <p><a href="<?= Yii::$app->urlManager->createUrl(['goods/detail','id'=>$hot['id']])?>" style="color: #333333"><?= $hot['name']; ?></a></p>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">特价商品</h3>
                </div>
                <div class="panel-body">
                    <?php foreach((array)$bargainGoods as $bargain) { ?>
                        <div class="col-sm-6 col-md-3">
                            <div class="thumbnail">
                                <img src="<?= $bargain['ad_img']; ?>" onerror='this.src="public/common/images/buy1.jpg"'
                                     alt="<?= $bargain['name']; ?>">
                                <div class="caption">
                                    <h3 style="color: #E4393C">¥<?= $bargain['sell_price']; ?></h3>
                                    <p><a href="<?= Yii::$app->urlManager->createUrl(['goods/detail','id'=>$bargain['id']])?>" style="color: #333333"><?= $bargain['name']; ?></a></p>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">最新商品</h3>
                </div>
                <div class="panel-body">
                    <?php foreach((array)$newestGoods as $newest) { ?>
                        <div class="col-sm-6 col-md-3">
                            <div class="thumbnail">
                                <img src="<?= $newest['ad_img']; ?>" onerror='this.src="public/common/images/buy1.jpg"'
                                     alt="<?= $newest['name']; ?>">
                                <div class="caption">
                                    <h3 style="color: #E4393C">¥<?= $newest['sell_price']; ?></h3>
                                    <p style="height: 60px;overflow-y: hidden"><a href="<?= Yii::$app->urlManager->createUrl(['goods/detail','id'=>$newest['id']])?>" style="color: #333333">
                                            <?= $newest['name']; ?>
                                        </a>
                                    </p>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
$this->registerJsFile('@web/public/frontend/menu/js/index.js',
    ['depends' => [JqueryAsset::className()],'position'=>$this::POS_END]
);
?>
<?php $this->beginBlock('jquery') ?>

    $(function() {

    });

<?php $this->endBlock() ?>
<?php $this->registerJs($this->blocks['jquery'], \yii\web\View::POS_END); ?>