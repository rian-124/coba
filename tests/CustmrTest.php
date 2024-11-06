<?php
use PHPUnit\Framework\TestCase;
use App\Custmr;

class CustmrTest extends TestCase {
    public function testSaveCustomerDataToDatabase() {
        $customer = new Custmr(null, "Test Name", "Test Address", "1234567890");
        $customer->saveCustomerDataToDatabase();
        $this->assertNotNull($customer->id);
    }
}
