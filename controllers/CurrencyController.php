<?php 

namespace app\controllers;

use Yii;
use \app\models\Currency;

class CurrencyController extends \yii\rest\ActiveController
{
	public $modelClass=Currency::class;

	public function behaviors()
	{
		$bs=parent::behaviors();
		$bs['authenticator']=[
			'class'=>\yii\filters\auth\HttpBearerAuth::class,
		];
		return $bs;
	}

	public function init()
	{
		parent::init();
		Yii::$app->user->enableSession=false;
	}
}