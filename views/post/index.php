<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ListView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel garmayev\news\models\search\PostSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('news', 'Posts');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="post-index">

    <h1><?= Html::encode($this->title) ?></h1>

	<?php Pjax::begin(); ?>
	<?php echo $this->render('_search', ['model' => $searchModel]); ?>

	<?php
	echo Html::a(Yii::t("news", "New post"), ["/news/post/create"], ["class" => ["btn", "btn-success"]]);
	echo Html::a(Yii::t("news", "New tag"), ["/news/tag/create"], ["class" => ["btn", "btn-success"]]);
	echo Html::tag("hr");
	$currentMonth = 0;
	foreach ($dataProvider->getModels() as $post) {
		if ($currentMonth <> Yii::$app->formatter->asDate($post->created_at, "php:n")) {
			$currentMonth = Yii::$app->formatter->asDate($post->created_at, "php:n");
			echo Html::tag("span", Yii::$app->formatter->asDate($post->created_at, "LLLL Y"), ["class" => "month"]);
		}
		echo Html::beginTag("div", ["class" => "post"]);
		$dayOfWeek = Yii::$app->formatter->asDatetime($post->created_at, "php:D");
		$dayOfMoth = Yii::$app->formatter->asDatetime($post->created_at, "php:d");
		$time = Yii::$app->formatter->asDatetime($post->created_at, "php:H:i");
		?>
        <a href="<?= Url::to(["date/view/" . Yii::$app->formatter->asDate($post->created_at, "php:Y-m-d")]) ?>"
           class="target-date">
            <div class="date">
                <span class="day_of_week"><?= $dayOfWeek ?></span>
                <span class="day_of_month"><?= $dayOfMoth ?></span>
                <span class="time"><?= $time ?></span>
            </div>
        </a>
        <a href="<?= Url::to(["/news/post/$post->slug"]) ?>" class="target-content">
            <div class="post-content">
                <span class="post-title"><?= $post->title ?></span>
                <div class="post-description"><?= $post->content ?></div>
                <div class="post-tags">
                    <?php
                        $tags = [];
                        foreach ($post->tags as $tag) {
                            $tags[] = Html::a("#{$tag->title}", ["/news/tag/{$tag->slug}"]);
                        }
                    ?>
					<?= implode(", ", $tags); ?>
                </div>
            </div>
        </a>
		<?php
		echo Html::endTag("div");
	}
	Pjax::end();
	?>

</div>
