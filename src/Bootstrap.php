<?php

namespace garmayev\news;

use Yii;
use yii\authclient\Collection;
use yii\base\Application;
use yii\i18n\PhpMessageSource;

class Bootstrap implements \yii\base\BootstrapInterface
{

	/**
	 * @inheritDoc
	 */
	public function bootstrap($app)
	{
		/**
		 * @var $module Module
		 */
		if ( $app->hasModule('news') && ($module = $app->getModule('news') instanceof Module) ) {
			$configUrlRule = [
				'prefix' => $module->urlPrefix,
				'rules'  => $module->urlRules,
			];

			if ($module->urlPrefix != 'user') {
				$configUrlRule['routePrefix'] = 'user';
			}

			$configUrlRule['class'] = 'yii\web\GroupUrlRule';
			$rule = Yii::createObject($configUrlRule);

			$app->urlManager->addRules([$rule], false);
		}

		if (!isset($app->get('i18n')->translations['news*'])) {
			$app->get('i18n')->translations['news*'] = [
				'class' => PhpMessageSource::className(),
				'basePath' => __DIR__ . '/messages',
				'sourceLanguage' => 'en-US'
			];
		}
	}
}