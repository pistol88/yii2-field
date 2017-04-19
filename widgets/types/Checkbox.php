<?php
namespace pistol88\field\widgets\types;

use yii\helpers\Html;
use yii;

class Checkbox extends \yii\base\Widget
{
    public $model = NULL;
    public $field = null;
    public $options = [];
    
    public function init()
    {
        \pistol88\field\assets\VariantsAsset::register($this->getView());
        parent::init();
    }

    public function run()
    {
        $variantsList = $this->field->variants;
        
        $this->options['class'] .= ' field-variants';
        $this->options['item'] = function($item, $index) {
            return $this->variant($item, $this->model->getFieldVariantIds($this->field->slug));
        };
        
        $variants = Html::ul($variantsList, $this->options);
        
        return $variants;
    }
    
    private function variant($item, $checked)
    {
        $return = [];

        if($checked) {
            $checked = in_array($item->id, $checked);
        }

        $return[] = Html::checkbox('variant', $checked, ['autocomplete' => 'off', 'id' => 'fieldvariant'.$item->id, 'data-id' => $item->id]);
        $return[] = ' ';
        $return[] = Html::label($item->value, 'fieldvariant'.$item->id);
        return Html::tag('li', implode('', $return));
    }
}
