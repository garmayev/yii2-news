<?php

namespace garmayev\news;

/**
 * post module definition class
 *
 * @property $urlPrefix string
 */
class Module extends \yii\base\Module
{
	public $user_class;

	public $urlRules = [
		'' => 'post/index',
		'<action:\w+>' => 'post/<action>',
		'<controller:\w+>/<action:\w+>' => '<controller>/<action>',
		'<id:\d+>-<slug:\S+>' => 'post/view',
		'tag/<slug:\S+>' => 'tag/view',
		'date/<date:\S+>' => 'date/view',
	];

	public $urlPrefix = 'news';

    /**
     * {@inheritdoc}
     */
    public $controllerNamespace = 'garmayev\news\controllers';

    /**
     * {@inheritdoc}
     */
    public function init()
    {
        parent::init();

	    if ( is_null($this->user_class) ) {
		    $this->user_class = "common\models\User";
	    }

		if ( is_null($this->urlPrefix) ) {
			$this->urlPrefix = "news";
		}
    }
}
