<?php
namespace Core\Html\Form;
use Core\Helper;

class FormFactory implements FormFactoryInterface{

    protected $surround = 'p';

    protected $data;


    public function __construct($data)
    {
        $this->data = $data;
    }

    private function getSurround($html)
    {
        if(empty($this->surround)){
            return $html;
        }
        return "<$this->surround>" . $html . "</$this->surround>";
    }

    public function input(string $name, string $label, $options=[])
    {
        $type = isset($options['type']) ? $options['type'] : 'text';
        $cssClass = isset($options['class']) ? $options['class'] : '';
        $html = '<label for="' . $name . '" class="form-control-label">' . $label . '</label>';
        $html .= '<input type="' . $type . '"class="' . $cssClass . '" name="' . $name . '" />';

        return $this->getSurround($html);
    }
    
}