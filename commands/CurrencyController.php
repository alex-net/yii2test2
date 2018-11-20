<?php 

namespace app\commands;

use Yii;
use app\models\Currency;
use \yii\console\ExitCode;
use \yii\helpers\Console;

/**
 * работа с курсами валют ..  
 */

class CurrencyController extends \yii\console\Controller
{
	/**
	 * запрос данных по курсам валют 
	 *
	 * Запрос осуществляется с хоста http://www.cbr.ru/scripts/XML_daily.asp
	 * @return int Код возврата
	 */
	public function actionIndex()
	{
		try{
			$xml=file_get_contents(Yii::$app->params['currencyUrl']);
			$xml=simplexml_load_string($xml);
			if (empty($xml->Valute))
				throw new \yii\console\Exception("Ошибка в файле\n");
		}catch(\Exception $e){
			echo $this->ansiFormat('Ошибка! ',Console::FG_RED).$e->getMessage();
			return ExitCode::DATAERR;
		}

			
		Currency::deleteAll();
		foreach($xml->Valute as $v)
			(new Currency([
				'id'=>(string)$v->CharCode,
				'name'=>(string)$v->Name,
				'rate'=>floatval(str_replace(',', '.', (string)$v->Value)),
			]))->save();
		echo $this->ansiFormat("Импорт выполнен успешно. Загружено записей: ",Console::FG_GREEN);
		echo $this->ansiFormat(count($xml->Valute)."\n",Console::FG_GREEN,Console::BOLD);
		
		return ExitCode::OK;
	}

}