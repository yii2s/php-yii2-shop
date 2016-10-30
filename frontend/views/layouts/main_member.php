<?php
use backend\assets\AdminLteAsset;
use yii\helpers\Html;

/* @var $this \yii\web\View */
/* @var $content string */

if (class_exists('frontend\assets\AppAsset')) {
    backend\assets\AppAsset::register($this);
}

AdminLteAsset::register($this);
$directoryAsset = Yii::$app->assetManager->getPublishedUrl('@public/common/dist');

$controller = $this->context;
$menus = isset($controller->module->menus) ? $controller->module->menus : [];

?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>"/>
    <!--<meta name="viewport" content="width=device-width, initial-scale=1">-->
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body class="hold-transition skin-blue sidebar-mini">
<?php $this->beginBody() ?>
<div class="wrapper">

    <?= $this->render(
        'header.php',
        ['directoryAsset' => $directoryAsset]
    ) ?>

    <?= $this->render(
        'left.php',
        ['menus' => $menus, 'directoryAsset' => $directoryAsset]
    )
    ?>

    <?= $this->render(
        'content.php',
        ['content' => $content, 'directoryAsset' => $directoryAsset]
    ) ?>

</div>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>

