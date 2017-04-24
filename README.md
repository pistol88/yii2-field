Внимание!
==========
Разработка модуля с 24.04.2017 ведется здесь: [dvizh/yii2-field](https://github.com/dvizh/yii2-field). Рекомендую устанавливать модуль из репозиторий Dvizh, именно там находится последняя версия.

Yii2-field
==========

С помощью данного модуля можно добавить поля для какой-то модели через веб-интерфейс и потом производить выборки по значению.

Типы полей на данный момент:

* Text
* Numeric
* Date
* Textarea
* Select
* Radio
* Checkbox
* Image (в разработке)

Для select, radio, checkbox можно заранее задавать в настройках варианты.

Установка
---------------------------------

Выполнить команду

```
php composer require pistol88/yii2-field "*"
```

Или добавить в composer.json

```
"pistol88/yii2-field": "*",
```

И выполнить

```
php composer update
```

Далее, мигрируем базу:

```
php yii migrate --migrationPath=vendor/pistol88/yii2-field/migrations
```

Подключение и настройка
---------------------------------

В конфигурационный файл приложения добавить модуль field, настроив его

```php
    'modules' => [
        //...
        'field' => [
            'class' => 'pistol88\field\Module',
            'relationModels' => [
                'common\models\User' => 'Пользователи',
                'pistol88\shop\models\Product' => 'Продукты',
            ],
            'adminRoles' => ['administrator'],
        ],
        //...
    ]
```

* relationModels - перечень моделей, к которым можно прикрепить поля

Все доступные CRUD для управления полями: ?r=field/defailt/index

Для модели, с которой будут работать поля, добавить поведение:

```php 
    function behaviors() {
        return [
            'field' => [
                'class' => 'pistol88\field\behaviors\AttachFields',
            ],
        ];
    }
```

Чтобы иметь возможность также фильтровать результаты Find, подменяем Query в модели:

```php
    public static function Find()
    {
        $return = new ProductQuery(get_called_class());
        return $return;
    }
```

В ProductQuery должно быть это поведение:

```php
    function behaviors()
    {
       return [
           'field' => [
               'class' => 'pistol88\field\behaviors\Filtered',
           ],
       ];
    }
```

Использование
---------------------------------

Значение поля для модели вызывается через getField(), которому передается код поля.

```php
echo $model->getField('field_name');
```

Выбрать все записи по значению значению поля:

```php
$productsFind = Product::find()->field('power', 100)->all(); //Все записи с power=100
$productsFind = Product::find()->field('power', 100, '>')->all(); //Все записи с power>100
$productsFind = Product::find()->field('power', 100, '<')->all(); //Все записи с power<100
```

Виджеты
---------------------------------

Блок выбора значений для для полей модели $model (вставлять в админке, рядом с формой редактирования):

```php
<?=\pistol88\field\widgets\Choice::widget(['model' => $model]);?>
```

Вывести все поля модели со значениями:
<?=pistol88\field\widgets\Show::widget(['model' => $model]);?>				
