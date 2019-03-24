<?php

namespace Carro\Model;

use Zend\Db\TableGateway\TableGatewayInterface;
use RuntimeException;

class CarroTable {

    private $tableGateway;

    public function __construct(TableGatewayInterface $tableGateway) {
        $this->tableGateway = $tableGateway;
    }

    //Retorna todos os registros da tabela
    public function getAll() {
        return $this->tableGateway->select();
    }

    //Retorna apenas o registro cujo id foi passado como parâmetro
    public function getCarro($id) {
        $id = (int) $id;
        $rowset = $this->tableGateway->select(['id' => $id]);
        $row = $rowset->current();
        if (!$row) {
            throw new RuntimeException(sprintf('Não foi encontrado o id %d', $id));
        }
        return $row;
    }

    //Salva um carro na tabela
    //Se (id == 0) - Insert
    //Se (id != 0) - Update
    public function salvarCarro(Carro $carro) {
        $data = [
            'nome' => $carro->getNome(),
            'marca' => $carro->getMarca(),
        ];

        $id = (int) $carro->getId();
        if ($id === 0) {
            $this->tableGateway->insert($data);
            return;
        }
        $this->tableGateway->update($data, ['id' => $id]);
    }

    //Remove da tabela o registro cujo id foi passado como parâmetro
    public function deletarCarro($id) {
        $this->tableGateway->delete(['id' => (int) $id]);
    }
}