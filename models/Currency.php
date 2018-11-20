<?php 

namespace app\models;

/**
 * модель таблицы валют ... 
 * 
 * @property string $id первичный ключик 
 * @property string $name Наименование валюты
 * @property float $rate курс валюты по отношению к рублю
 */
class Currency extends \yii\db\ActiveRecord {}
