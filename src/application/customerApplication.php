<?php
$aa = 'aa';

require_once(__DIR__ . '/../model/customerModel.php');

class CustomerService
{
    private $customer_repository;

    function __construct()
    {
        $this->customer_repository = new CustomerDataSource();
    }

    public function addCustomer($customer)
    {
        $this->customer_repository->addCustomer($customer);
    }

    public function findCustomer($customer_id)
    {
        $this->customer_repository->findCustomer($customer_id);
    }

    public function modifiedCustomer($customer_id)
    {
        $this->customer_repository->modifiedCustomer($customer_id);
    }

    public function deleteCustomer($customer_id)
    {
        $this->customer_repository->deleteCustomer($customer_id);
    }
}
