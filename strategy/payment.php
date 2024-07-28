<?php
// Define the Strategy Interface for the payment method
interface PaymentStrategyInterface
{
    public function pay($amount);
}

// Implement Concrete Strategies for different payment methods
class CreditCardPayment implements PaymentStrategyInterface
{
    public function pay($amount)
    {
        print_r("<p>Paid $amount using Credit Card.</p>");
    }
}

class PayPalPayment implements PaymentStrategyInterface
{
    public function pay($amount)
    {
        print_r("<p>Paid $amount using PayPal.</p>");
    }
}

class BankTransferPayment implements PaymentStrategyInterface
{
    public function pay($amount)
    {
        print_r("<p>Paid $amount using Bank Transfer.</p>");
    }
}

// Create the Context Class
// Have a context class that uses the strategy.
class PaymentProcessor
{
    private $paymentStrategy;

    public function setPaymentStrategy(PaymentStrategyInterface $paymentStrategy) 
    {
        $this->paymentStrategy = $paymentStrategy;
    }

    public function processPayment($amount) 
    {
        $this->paymentStrategy->pay($amount);
    }
}

// Use the Strategy Pattern
// Here's how you can use the strategy pattern to dynamically change the payment method.
$paymentProcessor = new PaymentProcessor();

if (isset($_GET['method'])) {
    switch($_GET['method']) {
        case 'cc':
            $paymentProcessor->setPaymentStrategy(new CreditCardPayment());
            $paymentProcessor->processPayment(100);
        break;
        case 'pp':
            $paymentProcessor->setPaymentStrategy(new PayPalPayment());
            $paymentProcessor->processPayment(200);
        break;
        case 'bt':
            $paymentProcessor->setPaymentStrategy(new BankTransferPayment());
            $paymentProcessor->processPayment(300);
        break;
    }
} else {
    // Pay using Credit Card
    $paymentProcessor->setPaymentStrategy(new CreditCardPayment());
    $paymentProcessor->processPayment(100);

    // Pay using PayPal
    $paymentProcessor->setPaymentStrategy(new PayPalPayment());
    $paymentProcessor->processPayment(200);

    // Pay using Bank Transfer
    $paymentProcessor->setPaymentStrategy(new BankTransferPayment());
    $paymentProcessor->processPayment(300);
}

echo "<h2>Select payment methods:</h2>";
echo "<p><a href='./payment.php?method=cc'>Credit Card</a></p>";
echo "<p><a href='./payment.php?method=pp'>PayPal</a></p>";
echo "<p><a href='./payment.php?method=bt'>Bank Transfer</a></p>";
