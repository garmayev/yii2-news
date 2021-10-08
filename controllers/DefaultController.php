<?php

namespace garmayev\news\controllers;

use yii\filters\AccessControl;
use yii\web\Controller;

/**
 * Default controller for the `post` module
 */
class DefaultController extends Controller
{
	public function behaviors()
	{
		return array_merge(parent::behaviors(), [
			'access' => [
				'class' => AccessControl::class,
				'rules' => [
					[
						'allow' => true,
						'roles' => ['@']
					]
				],
				'denyCallback' => function ($rule, $action) {
					return $this->redirect('user/login');
				}
			]
		]);
	}
}
