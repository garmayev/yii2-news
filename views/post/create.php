<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model garmayev\news\models\Post */

$this->title = Yii::t('news', 'Create Post');
$this->params['breadcrumbs'][] = ['label' => Yii::t('news', 'Posts'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="post-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
