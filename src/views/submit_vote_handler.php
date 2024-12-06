<?php
require_once __DIR__ . '/../models/Employee.php';
require_once __DIR__ . '/../models/Vote.php';
require_once __DIR__ . '/../classes/Database.php';
require_once __DIR__ . '/../services/VoteService.php';
require_once __DIR__ . '/../controllers/VoteController.php';

try {
    $database = new Database();
    $employeeModel = new Employee($database);
    $voteModel = new Vote($database);
    $voteService = new VoteService($voteModel, $employeeModel);
    $voteController = new VoteController($voteService);


    $voter_name = filter_input(INPUT_POST, 'voter_name', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $nominee_id = filter_input(INPUT_POST, 'nominee_id', FILTER_VALIDATE_INT);
    $category_id = filter_input(INPUT_POST, 'category_id', FILTER_VALIDATE_INT);
    $comment = isset($_POST['comment']) ? htmlspecialchars($_POST['comment'], ENT_QUOTES, 'UTF-8') : '';

    if (!$voter_name || !$nominee_id || !$category_id || empty($comment)) {
        throw new Exception("All fields are required, and input must be valid.");
    }

    $voter_id = $employeeModel->getEmployeeIdByName($voter_name);

    if (!$voter_id) {
        throw new Exception("Voter not found.");
    }

    if ($voter_id == $nominee_id) {
        throw new Exception("You can't vote for yourself! Choose another employee.");
    }

    $voteController->submitVote($voter_id, $nominee_id, $category_id, $comment);

    header("Location: submit_vote.php?success=1");
    exit;

} catch (Exception $e) {
    $error_message = urlencode($e->getMessage());
    header("Location: submit_vote.php?error=" . $error_message);
    exit;
}
