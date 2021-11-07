<?php

namespace garmayev\news;

/**
 * post module definition class
 */
class Module extends \yii\base\Module
{
	public $user_class;

	public $urlRules = [
		'' => 'post/index',
		'post/delete' => 'post/delete',
		'post/create' => 'post/create',
		'tag/create' => 'tag/create',
		'tag/<slug:\S+>' => 'tag/view',
		'date/<date:\S+>' => 'date/view',
		'post/<slug:\S+>' => 'post/update',
	];

	public $urlPrefix = 'news';

    /**
     * {@inheritdoc}
     */
    public $controllerNamespace = 'garmayev\news\controllers';

    /**
     * Initialize first settings
     *
     * {@inheritdoc}
     */
    public function init()
    {
        parent::init();

	    if ( is_null($this->user_class) ) {
		    $this->user_class = "common\models\User";
	    }

//		\Yii::$app->bootstrap[] = Bootstrap::class;
    }
}
