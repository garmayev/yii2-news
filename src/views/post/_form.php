<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model garmayev\news\models\Post */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="post-form">

	<?php $form = ActiveForm::begin(); ?>

	<?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

	<?= $form->field($model, 'content')->textarea(['rows' => 6])->widget(\vova07\imperavi\Widget::className(), [
		'settings' => [
			'lang' => 'ru',
			'minHeight' => 200,
			'plugins' => [
				'fullscreen',
			],
		],

	]) ?>

    <!--    --><? //= $form->field($model, 'location_id')->textInput() ?>

    <div class="form-group">
		<?= Html::submitButton(Yii::t('news', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

	<?php ActiveForm::end(); ?>

</div>
