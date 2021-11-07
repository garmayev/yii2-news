<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model garmayev\news\models\Tag */

$this->title = Yii::t('news', 'New tag');
$this->params["breadcrumbs"][] = ["label" => Yii::t("news", "Posts"), "url" => ['post/index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tag-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
