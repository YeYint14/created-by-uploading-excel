# Excel Import Project

## Overview

This project is focused on simplifying the process of importing data from Excel files into your Laravel application. It includes features for secure file uploads, data validation, and real-time updates.

## Features

- **Excel File Upload:** Allow users to upload Excel files containing data for import.
- **Data Validation:** Implement validation checks to ensure the integrity and accuracy of imported data.
- **CSRF Protection:** Utilize Laravel's built-in CSRF protection for secure form submissions.
- **Real-Time Updates:** Display real-time updates to the user interface after importing data.

## Getting Started

### Prerequisites

- [PHP](https://www.php.net/) installed (8.1)

### Installation

1. **Clone the Repository:**

    ```bash
    git clone <repository-url>
    cd excel-import
    ```

2. **Install Dependencies:**

    ```bash
    composer install
    ```

3. **Install Maatwebsite/Laravel-Excel Package:**

    ```bash
    composer require maatwebsite/excel
    ```

4. **Register Package Service Provider and Facade:**

    - Open `config/app.php` and add the following lines:

      ```php
      'providers' => [
          // ...
          Maatwebsite\Excel\ExcelServiceProvider::class,
      ],
      ```

      ```php
      'aliases' => [
          // ...
          'Excel' => Maatwebsite\Excel\Facades\Excel::class,
      ],
      ```

5. **Publish the Package Configuration:**

    ```bash
    php artisan vendor:publish --provider="Maatwebsite\Excel\ExcelServiceProvider"
    ```

    This will create a `config/excel.php` file.

6. **Generate Application Key:**

    ```bash
    php artisan key:generate
    ```

7. **Run Migrations:**

    ```bash
    php artisan migrate
    ```

8. **Serve the Application:**

    ```bash
    php artisan serve
    ```

    Access the application at [http://localhost:8000](http://localhost:8000).

## Usage

1. **Upload Excel File:**
   - Visit the designated page for Excel file uploads.
   - Choose an Excel file from your local machine.

2. **Data Validation:**
   - The system will perform validation checks on the uploaded data.
   - Any validation errors will be displayed to the user.

3. **Import Data:**
   - Once validated, proceed to import the data into the application.
   - Real-time updates will be shown on the user interface.

## Sample Excel File

To help you get started, here's a sample Excel file that you can use for testing the import functionality. The file should have the following format:

| Name       | Price |
|------------|-------|
| Product A  | 10.99 |
| Product B  | 19.95 |
| Product C  | 5.49  |


## Contributing

Contributions are welcome! Feel free to open issues or pull requests.

