<?php
use PHPUnit\Framework\TestCase;
use App\Customers;

class CustomersTest extends TestCase {
    public function testSaveCustomerDataToDatabase() {
        $customer = new Customers(null, "Test Name", "Test Address", "1234567890");
        $customer->saveCustomerDataToDatabase();
        $this->assertNotNull($customer->id);
    }
}
