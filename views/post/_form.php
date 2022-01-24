<?php

use garmayev\news\models\Tag;
use yii\helpers\ArrayHelper;
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

	<?= $form->field($model, "tags")->widget(\kartik\select2\Select2::class, [
		"data" => ArrayHelper::map(Tag::find()->all(), "title", "title"),
		"name" => "tags[]",
		"options" => [
			"multiple" => true,
		],
		"pluginOptions" => [
			"allowClear" => true,
			'tokenSeparators' => [',', ' '],
			"multiple" => true,
		]
	])->label(Yii::t("news", "Tags")); ?>

    <div class="form-group">
		<?= Html::submitButton(Yii::t('news', 'Save'), ['class' => 'btn btn-success']) ?>
		<?php
		if ($model->isNewRecord) {
			echo Html::a(Yii::t("news", "Cancel"), ["post/index"], ["class" => ["btn", "btn-danger"]]);
		} else {
			echo Html::a(Yii::t("news", "Delete"), ["post/delete", "id" => $model->id], ["class" => ["btn", "btn-danger"]]);
		}
		?>
    </div>
    <script>
        document.addEventListener("DOMContentLoaded", () => {
            let datalist = jQuery('datalist');
            let options = jQuery('datalist option');
            let optionsarray = jQuery.map(options, function (option) {
                return option.value;
            });
            let input = jQuery('input[list]');
            let inputcommas = (input.val().match(/,/g) || []).length;
            let separator = ',';

            function filldatalist(prefix) {
                if (input.val().indexOf(separator) > -1 && options.length > 0) {
                    datalist.empty();
                    for (i = 0; i < optionsarray.length; i++) {
                        if (prefix.indexOf(optionsarray[i]) < 0) {
                            datalist.append('<option value="' + prefix + optionsarray[i] + '">');
                        }
                    }
                }
            }

            input.bind("change paste keyup", function () {
                let inputtrim = input.val().replace(/^\s+|\s+$/g, "");
                //console.log(inputtrim);
                let currentcommas = (input.val().match(/,/g) || []).length;
                //console.log(currentcommas);
                if (inputtrim != input.val()) {
                    if (inputcommas != currentcommas) {
                        let lsIndex = inputtrim.lastIndexOf(separator);
                        let str = (lsIndex != -1) ? inputtrim.substr(0, lsIndex) + ", " : "";
                        filldatalist(str);
                        inputcommas = currentcommas;
                    }
                    input.val(inputtrim);
                }
            });
        })
    </script>
	<?php ActiveForm::end(); ?>

</div>
