<?php namespace Reg2005\Widgets\Range;

use Backend\Classes\FormWidgetBase;

/**
 * Repeater Form Widget
 */
class Widget extends FormWidgetBase
{
    const INDEX_PREFIX = '___index_';

    //
    // Configurable properties
    //

    /**
     * @var array Form field configuration
     */
    public $form;

    public $min, $max, $step, $pips, $minMax, $mode, $customLabel, $default, $value;

    //
    // Object properties
    //

    /**
     * {@inheritDoc}
     */
    protected $defaultAlias = 'range';

    /**
     * {@inheritDoc}
     */
    public function init()
    {

        $this->fillFromConfig([
            'step',
            'minMax',
            'customLabel',
            'default'
        ]);

        $this->value = $this->getLoadValue();

        if (!$this->minMax) {
            $this->minMax = ['min' => 0, 'max' => 100];
        }

        if (!$this->min) {
            $this->min = isset($this->minMax['min'][0]) ? $this->minMax['min'][0] : 0;
        }

        if (!$this->max) {
            $this->max = isset($this->minMax['max'][0]) ? $this->minMax['max'][0] : 100;
        }

        if (!$this->step) {
            $this->step = 1;
        }

        if (!$this->pips) {
            $this->pips = [];
        }

        //http://refreshless.com/nouislider/pips/#section-range

        /*
         * Label
         */
        if(!$this->customLabel) {
            if(is_array($this->customLabel)){
                //if two elements
                if(count($this->customLabel) != 2) {
                    //first element get
                    $this->customLabel = array_shift($this->customLabel);
                }
            }
        }

        /*
         * Value
         */
        // If value is empty, - get default
        if(!$this->value) {
            if(is_array($this->default)){
                //if two elements
                if(count($this->default) == 2) {
                    $this->value = json_encode($this->default);
                }

            }else{
                $this->value = $this->default;
            }
        }

        $this->minMax   = json_encode($this->minMax);
        $this->pips     = json_encode($this->pips);

    }

    /**
     * {@inheritDoc}
     */
    public function render()
    {


        $this->prepareVars();
        return $this->makePartial($this->defaultAlias);
    }

    /**
     * Prepares the form widget view data
     */
    public function prepareVars()
    {

        $this->vars['name'] = $this->formField->getName();
        $this->vars['value'] = $this->value ?: $this->min;
        $this->vars['field'] = $this->formField;
        $this->vars['step'] = $this->step;
        $this->vars['min'] = $this->min;
        $this->vars['max'] = $this->max;
        $this->vars['pips'] = $this->pips;
        $this->vars['minMax'] = $this->minMax;
        $this->vars['mode'] = $this->mode;
        $this->vars['customLabel'] = $this->customLabel;
    }

    /**
     * {@inheritDoc}
     */
    public function getSaveValue($value)
    {
        return (array) $value;
    }

    /**
     * {@inheritDoc}
     */
    protected function loadAssets()
    {
        $this->addCss('nouislider.min.css', 'core');
        $this->addCss('my.css', 'core');
        $this->addJs('nouislider.min.js', 'core');
    }

}
