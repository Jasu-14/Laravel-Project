<?php

$host = "localhost";
$userName = "root";
$password = "root@";
$database = "horizon";

// Database connection
$connection = new mysqli($host, $userName, $password);

if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error . "\n");
}

echo "Database connected successfully!\n";

// Create database
$CreateDB = "CREATE DATABASE IF NOT EXISTS $database";

if ($connection->query($CreateDB)) {
    echo "Database created successfully!\n";
} else {
    die("Error creating database: " . $connection->error . "\n");
}

// Select database
$connection->select_db($database);

// Create customer table
$CreateTable = "CREATE TABLE IF NOT EXISTS customer (
    id INT PRIMARY KEY AUTO_INCREMENT,
    Name VARCHAR(250),
    Email VARCHAR(250),
    AccountNumber VARCHAR(50) UNIQUE,
    Balance DECIMAL(12,2) DEFAULT 0.00
)";

if ($connection->query($CreateTable)) {
    echo "Customer table created successfully!\n";
} else {
    die("Error creating table: " . $connection->error . "\n");
}


// Function to display all customers
/*function displayAllCustomers($connection)
{
    $select = "SELECT * FROM customer";
    $result = $connection->query($select);

    echo "\n--------------- All Customers ---------------\n";

    if ($result && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "Id: " . $row['id']
                . " | Name: " . $row['Name']
                . " | Email: " . $row['Email']
                . " | Account Number: " . $row['AccountNumber']
                . " | Balance: " . $row['Balance'] . "\n";
        }

        $result->free();
    } else {
        echo "No customers found.\n";
    }
}
*/


function displayCustomers($connection)
{
    echo "\n1. Display all customers";
    echo "\n2. Search customer by name\n";

    $choice = readline("Enter your choice (1/2): ");

    while (true) {

        if ($choice == 1) {

            $select = "SELECT * FROM customer";
            $result = $connection->query($select);

            echo "\n--------------- All Customers ---------------\n";

            if ($result && $result->num_rows > 0) {

                while ($row = $result->fetch_assoc()) {

                    echo "Id: " . $row['id']
                        . " | Name: " . $row['Name']
                        . " | Email: " . $row['Email']
                        . " | Account Number: " . $row['AccountNumber']
                        . " | Balance: " . $row['Balance'] . "\n";
                }

                $result->free();

            } else {
                echo "No customers found.\n";
            }

            break;

        } elseif ($choice == 2) {

            $Name = readline("Enter customer name: ");

            $select = "SELECT * FROM customer WHERE Name = ?";
            $stmt = $connection->prepare($select);

            $stmt->bind_param("s", $Name);
            $stmt->execute();

            $result = $stmt->get_result();

            echo "\n--------------- Selected Customer Details ---------------\n";

            if ($result->num_rows > 0) {

                while ($row = $result->fetch_assoc()) {

                    echo "Id: " . $row['id']
                        . " | Name: " . $row['Name']
                        . " | Email: " . $row['Email']
                        . " | Account Number: " . $row['AccountNumber']
                        . " | Balance: " . $row['Balance'] . "\n";
                }

            } else {
                echo "Customer not found.\n";
            }

            $stmt->close();
            break;

        } else {

            echo "Invalid choice. Please enter 1 or 2.\n";
            $choice = readline("Enter your choice (1/2): ");
        }
    }
}



