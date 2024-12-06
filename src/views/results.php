<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Voting Results</title>
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
            max-width: 1000px;
            margin: 20px auto;
            background-color: white;
            border-radius: 8px;
            height: 500px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .tables-section {
            height: 600px;
        }
        .section-title {
            font-size: 1.8rem;
            color: #34495E;
            margin-bottom: 15px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 30px;
        }
        th, td {
            padding: 12px;
            text-align: left;
            border: 1px solid #ddd;
        }
        th {
            background-color: #3498db;
            color: white;
        }
        tr:nth-child(even) {
            background-color: #f2f2f2;
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
    </style>
</head>
<body>
<header>
    <h1>Voting Results</h1>
    <nav>
        <a href="index.php">Home</a>
        <a href="submit_vote.php">Submit Your Vote</a>
        <a href="results.php">View Results</a>
    </nav>
</header>
<main>
    <div class="tables-section">
        <section>
            <h2 class="section-title">Winners by Category</h2>
            <table id="winners_table">
                <thead>
                <tr>
                    <th>Category</th>
                    <th>Nominee(s)</th>
                    <th>Votes</th>
                </tr>
                </thead>
                <tbody>
                <?php
                include 'results_handler.php';
                $winners = getResults('winners');
                foreach ($winners as $category => $data) {
                    $nominees = implode(', ', $data['nominees']);
                    $votes = $data['votes'];
                    echo "<tr>
                            <td>{$category}</td>
                            <td>{$nominees}</td>
                            <td>{$votes}</td>
                          </tr>";
                }
                ?>
                </tbody>
            </table>
        </section>

        <section>
            <h2 class="section-title">Most Active Voters</h2>
            <table id="voters_table">
                <thead>
                <tr>
                    <th>Voter(s)</th>
                    <th>Votes Cast</th>
                </tr>
                </thead>
                <tbody>
                <?php
                $activeVoters = getResults('active_voters');
                echo "<tr>
                        <td>{$activeVoters['voters']}</td>
                        <td>{$activeVoters['votes']}</td>
                      </tr>";
                ?>
                </tbody>
            </table>
        </section>
    </div>
</main>
<footer>
    <p>&copy; 2024 Employee Appreciation System | All rights reserved</p>
</footer>
</body>
</html>
