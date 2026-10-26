<?php

require_once "database.php";
require_once "Transaction.php";


// Step 1: Accept customer details
echo "\n--------------- Customer Registration ---------------\n";

$Name = readline("Enter your name: ");
$Email = readline("Enter your email: ");
$AccountNumber = readline("Enter account number: ");
$Balance = (float) readline("Enter initial balance: ");


// Step 2: Create customer object
$obj = new Customers($Name, $AccountNumber, $Balance);


// Step 3: Insert customer details into database
$Stmt = $connection->prepare(
    "INSERT INTO customer (Name, Email, AccountNumber, Balance)
     VALUES (?, ?, ?, ?)"
);

$Stmt->bind_param(
    "sssd",
    $Name,
    $Email,
    $AccountNumber,
    $Balance
);

if ($Stmt->execute()) {
    echo "\nCustomer registered successfully!\n";
} else {
    die("Error inserting customer: " . $Stmt->error . "\n");
}

$Stmt->close();


// Step 4: Ask for transaction type
while (true) {
    $transaction = strtolower(
        trim(readline("\nEnter the transaction type (deposit/withdraw): "))
    );
    if ($transaction === "deposit") {

        $amount = (float) readline("Enter the amount to deposit: ");

        if ($obj->deposit($amount)) {
            break;
        }

    } elseif ($transaction === "withdraw") {

        $amount = (float) readline("Enter the amount to withdraw: ");

        if ($obj->withdraw($amount)) {
            break;
        }

    } else {
        echo "Invalid transaction type. Please enter deposit or withdraw.\n";
    }
}


// Step 5: Display final balance
echo "\n--------------- Transaction Summary ---------------\n";

$obj->getBalance();


// Step 6: Update balance in database
$FinalBalance = $obj->balance;
$AccountNumber = $obj->getAccountNumber();

$Stmt = $connection->prepare(
    "UPDATE customer SET Balance = ? WHERE AccountNumber = ?"
);

$Stmt->bind_param("ds", $FinalBalance, $AccountNumber);

if ($Stmt->execute()) {

    if ($Stmt->affected_rows >= 0) {
        echo "Balance updated in database successfully!\n";
    }

} else {
    echo "Error updating balance: " . $Stmt->error . "\n";
}

$Stmt->close();


// Step 7: Display all customers
//displayAllCustomers($connection);


// Step 8: Retrieve a specific customer's details
//$SearchName = readline("\nEnter the name to retrieve details: ");

displayCustomers($connection);

// Step 9: Close database connection
$connection->close();

?>
