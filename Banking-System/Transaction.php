<?php

class Customers
{
    public string $accountHolder;
    protected string $accountNumber;
    public float $balance;

    public function __construct(
        string $accountHolder,
        string $accountNumber,
        float $balance = 0.0
    ) {
        $this->accountHolder = $accountHolder;
        $this->accountNumber = $accountNumber;
        $this->balance = $balance;
    }


    // Deposit money
    public function deposit(float $amount)
    {
        if ($amount <= 0) {
            echo "Invalid deposit amount.\n";
            return false;
        }

        $this->balance += $amount;

        echo "Amount Deposited = " . $amount . "\n";
        echo "New Balance = " . $this->balance . "\n";

        return true;
    }


    // Withdraw money
    public function withdraw(float $amount)
    {
        if ($amount <= 0) {
            echo "Invalid withdrawal amount.\n";
            return false;
        } elseif ($amount <= $this->balance) {
            $this->balance -= $amount;

            echo "Amount Deducted = " . $amount . "\n";
            echo "Current Balance = " . $this->balance . "\n";

            return true;
        } else {
            echo "Insufficient Balance.\n";
            return false;
        }
    }


    // Display balance
    public function getBalance()
    {
        echo "Current Balance = " . $this->balance . "\n";
    }


    // Get account number
    public function getAccountNumber()
    {
        return $this->accountNumber;
    }
}

?>
