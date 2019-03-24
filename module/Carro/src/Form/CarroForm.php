<?php
namespace Carro\Form;

use Zend\Form\Form;
use Zend\InputFilter\InputFilter;

class CarroForm extends Form {
 
    public function __construct() {
        parent::__construct('carro', []);
        
        $filter = new InputFilter();
        $this->setInputFilter($filter);
        
        $this->add(new \Zend\Form\Element\Hidden('id'));
        $this->add(new \Zend\Form\Element\Text("nome",['label' => "Nome"], array('required' => true, 'validators' => array (array('name' => 'Zend\Validator\StringLength','options' => array('min' => 3,'max' => 155))))));
        $this->add(new \Zend\Form\Element\Text("marca",['label' => "Marca"]));
        
        $submit = new \Zend\Form\Element\Submit('submit');
        $submit->setAttributes(['value'=>'Salvar','id'=>'submitbutton']);
        $this->add($submit);
        
        $filter->add([
            'name' => 'nome',
            'required' => true,
            'filters' => [
                ['name'=> 'StringTrim'],
            ],
            'validators'=>[
                [
                    'name' => 'StringLength',
                    'options'=>[
                        'min'=> 2,
                        'max' => 155,
                    ],
                ],
            ],
        ]);

        $filter->add([
            'name' => 'marca',
            'required' => true,
            'filters' => [
                ['name'=> 'StringTrim'],
            ],
            'validators'=>[
                [
                    'name' => 'StringLength',
                    'options'=>[
                        'min'=> 2,
                        'max' => 155,
                    ],
                ],
            ],
        ]);
    }
    
}
