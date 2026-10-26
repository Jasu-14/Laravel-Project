# Horizon Bank 🏦

## Project Overview

Horizon Bank is a console-based banking application developed using Core PHP and MySQL. The project demonstrates Object-Oriented Programming (OOP), database connectivity, customer registration, deposit and withdrawal transactions, and customer record retrieval.

The application runs through the command-line interface (CLI) and does not use HTML, CSS, or JavaScript.

## Features

- **Database Connection:** Connects PHP to a MySQL database using MySQLi.
- **Database and Table Creation:** Creates the database and customer table if they do not already exist.
- **Customer Registration:** Registers customers with their name, email, account number, and initial balance.
- **Deposit:** Adds money to a customer's balance.
- **Withdrawal:** Deducts money from a customer's balance after checking the available balance.
- **Balance Management:** Updates the customer's balance in the MySQL database.
- **View All Customers:** Displays all registered customer records.
- **Search Customer:** Retrieves customer details using their name.
- **User Authentication:** Checks login credentials against the user table.
- **Access Control:** Restricts customer-record viewing and searching to authorized users.
- **Menu Selection:** Allows the user to choose between displaying all customers and searching for a specific customer.

## Technologies Used

| Technology | Purpose |
|---|---|
| Core PHP | Application logic |
| PHP OOP | Classes, objects, constructors, and methods |
| MySQL | Database management |
| MySQLi | PHP-to-MySQL database connectivity |
| SQL | Database creation, insertion, retrieval, and updating |
| VS Code | Development environment |
| PowerShell | Running the application |

## Project Structure

```text
Horizon bank/
│
├── index.php
├── database.php
├── Transaction.php
└── README.md
```

### File Description

**1. `index.php`**
- Controls the execution of the application.
- Accepts customer details through the command line.
- Registers customers in the database.
- Handles deposit and withdrawal operations.
- Updates the customer balance.
- Checks user permissions before allowing customer-record viewing and searching.

**2. `database.php`**
- Establishes the MySQL database connection.
- Creates the database and customer table if necessary.
- Contains functions to display all customers or retrieve a specific customer's details.

**3. `Transaction.php`**
- Contains the `Customers` class.
- Initializes customer details through the constructor.
- Implements deposit and withdrawal methods.
- Provides a method to display the current balance.
- Provides a method to retrieve the account number.

## Database Design

### 1. Database Name

`horizon`

### 2. Customer Table

Table name: `customer`

| Column | Data Type | Description |
|---|---|---|
| id | INT | Primary key with auto-increment |
| Name | VARCHAR(250) | Customer's name |
| Email | VARCHAR(250) | Customer's email |
| AccountNumber | VARCHAR(50) | Unique account number |
| Balance | DECIMAL(12,2) | Customer's account balance |

### 3. User Table

Table name: `user`

| Column | Description |
|---|---|
| ID | User identifier |
| Name | Username |
| password | User password |

The application uses the user table to authenticate users and determine who is authorized to view or search customer records.

**Note:** The authorized user IDs must be configured in the application's access-control logic. Authentication and authorization are separate: a valid login does not automatically grant permission to access customer records.

## Application Workflow

1. Start the application.
2. Connect to the MySQL database.
3. Create the database and customer table if necessary.
4. Authenticate the user and check their permissions.
5. Accept the customer's registration details.
6. Create a customer object.
7. Insert customer information into the database.
8. Ask the user to select a deposit or withdrawal transaction.
9. Calculate the updated balance.
10. Save the updated balance in the database.
11. If authorized, display all customers or search for a customer by name.
12. Close the database connection.

## Installation and Setup

### Prerequisites

Make sure you have installed:

- PHP 8 or later
- MySQL Server
- PHP MySQLi extension
- Visual Studio Code (or another code editor)

### Step 1: Clone the Repository

```bash
git clone <your-github-repository-url>
```

Alternatively, download the project and open its folder in VS Code.

### Step 2: Configure MySQL

Ensure that your MySQL server is running.

Update the connection settings in `database.php` to match your local configuration:

```php
$host = "localhost";
$userName = "root";
$password = "your_mysql_password";
$database = "horizon";
```

Replace `your_mysql_password` with your actual MySQL password.

### Step 3: Check the PHP MySQLi Extension

Run:

```bash
php -m
```

Confirm that `mysqli` appears in the list of enabled extensions.

### Step 4: Run the Application

Open the terminal in your project directory and execute:

```bash
php index.php
```

Follow the prompts displayed in the terminal.

## Transaction Rules

### Deposit

- The deposit amount must be greater than zero.
- A valid deposit increases the customer's balance.
- The updated balance is saved to the database.

### Withdrawal

- The withdrawal amount must be greater than zero.
- The withdrawal amount cannot exceed the available balance.
- A valid withdrawal decreases the customer's balance.
- The updated balance is saved to the database.

### Customer Record Retrieval

Authorized users can choose between:

1. Displaying all customer records.
2. Searching for a customer by name.

The application uses SQL queries to retrieve the requested information.

## Security and Access Control

The application demonstrates basic user authentication and authorization.

- User credentials are checked against the user table.
- Customer-record viewing and searching are restricted to designated users.
- Prepared statements are used for parameterized queries.
- Unauthorized users receive an access-denied message.

**Security note:** For production use, passwords should be stored using PHP's `password_hash()` and verified with `password_verify()`. Database credentials should be stored securely, and transaction operations should include appropriate authorization and error handling.

## Learning Objectives

This project helps demonstrate:

- Core PHP programming.
- Object-Oriented Programming.
- Classes, objects, constructors, and methods.
- MySQL database connectivity.
- SQL CRUD operations.
- Prepared statements and parameter binding.
- User authentication and authorization.
- Conditional statements and loops.
- Basic banking transaction logic.
- Command-line application development.

## Future Enhancements

Possible future improvements include:

- Customer login and account verification.
- Transactions for existing customers.
- Transaction history.
- Fund transfers between accounts.
- Password hashing.
- Role-based permissions stored in the database.
- Improved validation and error handling.
- Database transactions to protect balance updates.
- Administrative user management.

## Disclaimer

Horizon Bank is an educational project developed for learning Core PHP, OOP, and MySQL. It is not intended for real banking operations or handling actual financial transactions.

## Author

**Project:** Horizon Bank  
**Developer:** Jasmina Shaikh  
**Technologies:** Core PHP, OOP, MySQL, MySQLi
