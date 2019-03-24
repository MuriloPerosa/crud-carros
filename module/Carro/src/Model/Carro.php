<?php

namespace Carro\Model;

class Carro implements \Zend\Stdlib\ArraySerializableInterface{

    private $id;
    private $nome;
    private $marca;

    public function exchangeArray(array $data) {
        $this->id = !empty($data['id']) ? $data['id'] : null;
        $this->nome = !empty($data['nome']) ? $data['nome'] : null;
        $this->marca = !empty($data['marca']) ? $data['marca'] : null;
    }

    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function getNome() {
        return $this->nome;
    }

    public function setNome($nome) {
        $this->nome = $nome;
    }

    public function getMarca() {
        return $this->marca;
    }

    public function setMarca($marca) {
        $this->marca = $marca;
    }

    public function getArrayCopy(): array {
        return [
            'id' => $this->id,
            'nome' => $this->nome,
            'marca' => $this->marca,
        ];
    }
}
