<?php

namespace Carro\Controller;

use Carro\Form\CarroForm;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class CarroController extends AbstractActionController {

    private $table;

    public function __construct($table) {
        $this->table = $table;
    }

    public function indexAction() {
       
        if(isset($_GET['q'])){
            $q = $_GET['q'];
           
            if(empty($q)){
                return new ViewModel(['carros' => $this->table->getAll()]);
            }else{
                return new ViewModel(['carros' => $this->table->getCarrosByNome($q)]);
            }
        }else{
            return new ViewModel(['carros' => $this->table->getAll()]);
        }
    }

    public function adicionarAction() {

        $form = new CarroForm();
        $form->get('submit')->setValue('Adicionar');
        $request = $this->getRequest();
        if (!$request->isPost()) {
            return new ViewModel(['form' => $form]);
        }
        $carro = new \Carro\Model\Carro();
        $form->setData($request->getPost());
        if (!$form->isValid()) {
            return new ViewModel(['form' => $form]);
        }
        $carro->exchangeArray($form->getData());
        $this->table->salvarCarro($carro);
        return $this->redirect()->toRoute('carro');
    }

    public function editarAction() {
        $id = (int) $this->params()->fromRoute('id', 0);
        if (0 === $id) {
            return $this->redirect()->toRoute('carro', ['action' => 'adicionar']);
        }
        try {
            $carro = $this->table->getCarro($id);
        } catch (Exception $exc) {
            return $this->redirect()->toRoute('carro', ['action' => 'index']);
        }
        $form = new CarroForm();
        $form->bind($carro);
        $form->get('submit')->setAttribute('value', 'Salvar');
        $request = $this->getRequest();
        $viewData = ['id' => $id, 'form' => $form];
        if (!$request->isPost()) {
            return $viewData;
        }
        $form->setData($request->getPost());
        if (!$form->isValid()) {
            return $viewData;
        }
        $this->table->salvarCarro($form->getData());
        return $this->redirect()->toRoute('carro');
    }

    public function removerAction() {
        $id = (int) $this->params()->fromRoute('id', 0);
        if (0 === $id) {
            return $this->redirect()->toRoute('carro');
        }
        $request = $this->getRequest();
        if ($request->isPost()) {
            $del = $request->getPost('del','Não');
            if ($del == 'Sim') {
                $id = (int) $request->getPost('id');
                $this->table->deletarCarro($id);
            }
            return $this->redirect()->toRoute('carro');
        }
        return ['id' => $id, 'carro' => $this->table->getCarro($id)];
    }
}