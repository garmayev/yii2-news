<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model garmayev\news\models\Post */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('news', 'Posts'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="post-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
		<?= Html::a(Yii::t('news', 'Delete'), ['delete', 'id' => $model->id], [
			'class' => 'btn btn-danger',
			'data' => [
				'confirm' => Yii::t('news', 'Are you sure you want to delete this item?'),
				'method' => 'post',
			],
		]) ?>
    </p>

    <?php
        echo $this->render("_form", [
                "model" => $model
        ]);
    ?>
<!--	--><?//= DetailView::widget([
//		'model' => $model,
//		'attributes' => [
//			'id',
//			'title',
//			'content:ntext',
//			[
//				'attribute' => 'slug',
//                'content' => function ($model) {
//                    return $model->slug;
//                }
//			],
//			'created_at',
//			'updated_at',
//			'author_id',
//			'location_id',
//		],
//	]) ?>

</div>
