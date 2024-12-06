<?php
$error_message = isset($_GET['error']) ? htmlspecialchars($_GET['error'], ENT_QUOTES, 'UTF-8') : '';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Submit Your Vote</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;

            background-color: #f4f4f4;
            color: #333;
        }
        header {
            background-color: #2C3E50;
            color: white;
            padding: 20px;
            text-align: center;
        }
        header h1 {
            margin: 0;
            font-size: 2.5rem;
        }
        nav {
            margin-top: 20px;
        }
        nav a {
            color: #ECF0F1;
            margin: 0 15px;
            text-decoration: none;
            font-size: 1.1rem;
        }
        nav a:hover {
            text-decoration: underline;
        }
        main {
            padding: 20px;
            max-width: 600px;
            margin: 30px auto;
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        form {
            display: grid;
            gap: 20px;
        }
        label {
            font-weight: bold;
            margin-bottom: 5px;
        }
        input, select, textarea {
            padding: 12px;
            font-size: 1rem;
            width: 100%;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        textarea {
            resize: vertical;
            height: 35px;
            width: 575px;
        }
        button {
            background-color: #3498db;
            color: white;
            font-size: 1.1rem;
            padding: 12px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        button:hover {
            background-color: #34495E;
        }
        .form-section{
            height: 70px;
        }
        footer {
            background-color: #2C3E50;
            color: white;
            text-align: center;
            padding: 10px;
            position: fixed;
            bottom: 0;
            width: 100%;
        }
        .error-message {
            color: red;
            font-weight: bold;
            margin-bottom: 15px;
        }

    </style>
</head>
<body>
<header>
    <h1>Submit Your Vote</h1>
    <nav>
        <a href="index.php">Home</a>
        <a href="submit_vote.php">Submit Your Vote</a>
        <a href="results.php">View Results</a>
    </nav>
</header>
<main>
    <?php if ($error_message): ?>
        <div class="error-message"><?php echo $error_message; ?></div>
    <?php endif; ?>

    <form action="submit_vote_handler.php" method="POST">
        <div class="form-section">
            <label for="voter_name">Your Name:</label>
            <select name="voter_name" id="voter_name" required>
                <?php
                require_once __DIR__ . '/../models/Employee.php';
                require_once __DIR__ . '/../classes/Database.php';
                $database = new Database();
                $employeeModel = new Employee($database);
                $employees = $employeeModel->getAllEmployees();
                foreach ($employees as $employee) {
                    echo "<option value='{$employee['name']}'>{$employee['name']}</option>";
                }
                ?>
            </select>
        </div>

        <div class="form-section">
            <label for="nominee_id">Nominee:</label>
            <select name="nominee_id" id="nominee_id" required>
                <?php
                foreach ($employees as $employee) {
                    echo "<option value='{$employee['id']}'>{$employee['name']}</option>";
                }
                ?>
            </select>
        </div>

        <div class="form-section">
            <label for="category_id">Category:</label>
            <select name="category_id" id="category_id" required>
                <option value="1">Makes Work Fun</option>
                <option value="2">Team Player</option>
                <option value="3">Culture Champion</option>
                <option value="4">Difference Maker</option>
            </select>
        </div>

        <div class="form-section">
            <label for="comment">Comment:</label>
            <textarea name="comment" id="comment" required></textarea>
        </div>

        <button type="submit">Submit Vote</button>
    </form>
</main>
<footer>
    <p>&copy; 2024 Employee Appreciation System | All rights reserved</p>
</footer>
</body>
</html>
