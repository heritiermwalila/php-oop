<?php
namespace Core\Html\Form;
use Core\Helper;

/**
 * 
 */
class BootstrapForm extends FormFactory {

    protected $surround = '';

    /**
     * 
     */
    public function submit()
    {
        Helper::dd($this->data);
    }
    
}