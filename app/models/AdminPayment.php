<?php

class AdminPayment
{
    private $db;

    public function __construct()
    {
        $this->db = Mysqldb::getInstance()->getDatabase();
    }

    public function PaymentMethodCreate($data){

        $response = false;

            $sql = 'INSERT INTO payments(name) 
                VALUES (:name)';
            $params = [
                ':name' => $data['name'],
               
            ];
            $query = $this->db->prepare($sql);
            $response = $query->execute($params);

        

        return $response;
    }
    public function PaymentMethodUpdate($data){

    
    
        $errors = [];

        $sql = 'UPDATE payments SET name=:name  ';

        $params = [
            ':name' => $data['name'],
        ];

        $query = $this->db->prepare($sql);

        if ( ! $query->execute($params)) {
            array_push($errors, 'Error al borrar el producto');
        }

        return $errors;
    
    }

    public function getPaymentsById($id)
    {
        $sql = 'SELECT * FROM payments WHERE id=:id';
        $query = $this->db->prepare($sql);
        $query->execute([':id' => $id]);

        return $query->fetch(PDO::FETCH_OBJ);
    }
    public function getPayments()
    {
        $sql = 'SELECT * FROM payments';
        $query = $this->db->prepare($sql);
        $query->execute();
        return $query->fetchAll(PDO::FETCH_OBJ);
    }

}