<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model garmayev\news\models\Post */

$this->title = Yii::t('news', 'Update Post: {name}', [
    'name' => $model->title,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('news', 'Posts'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $model->title;
?>
<div class="post-update">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
