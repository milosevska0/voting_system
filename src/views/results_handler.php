<?php
require_once __DIR__ . '/../services/ResultService.php';
require_once __DIR__ . '/../controllers/ResultController.php';
require_once __DIR__ . '/../models/Vote.php';
require_once __DIR__ . '/../models/Employee.php';
require_once __DIR__ . '/../classes/Database.php';

function getResults($action): array
{
    $database = new Database();
    $voteModel = new Vote($database);
    $employeeModel = new Employee($database);
    $resultService = new ResultService($voteModel);
    $resultController = new ResultController($resultService);

    if ($action === 'winners') {
        $categories = [
            1 => "Makes Work Fun",
            2 => "Team Player",
            3 => "Culture Champion",
            4 => "Difference Maker"
        ];

        $groupedResults = [];
        foreach ($categories as $category_id => $category_name) {
            $winners = $resultController->getWinnerForCategory($category_id);

            $totalVotes = 0;
            $groupedResults[$category_name] = [
                'nominees' => [],
                'votes' => 0
            ];

            if (!empty($winners)) {
                foreach ($winners as $winner) {
                    $nominee_name = $employeeModel->getEmployeeNameById($winner['nominee_id']);
                    $groupedResults[$category_name]['nominees'][] = $nominee_name;
                    $totalVotes += $winner['vote_count'];
                }
                $groupedResults[$category_name]['votes'] = $totalVotes;
            } else {
                $groupedResults[$category_name] = [
                    'nominees' => ['No Votes Yet'],
                    'votes' => 0
                ];
            }
        }
        return $groupedResults;

    } elseif ($action === 'active_voters') {
        $activeVoters = $resultController->getMostActiveVoters();
        $maxVotes = 0;
        $mostActiveVoters = [];

        foreach ($activeVoters as $voter) {
            if ($voter['votes'] > $maxVotes) {
                $maxVotes = $voter['votes'];
                $mostActiveVoters = [$voter];
            } elseif ($voter['votes'] === $maxVotes) {
                $mostActiveVoters[] = $voter;
            }
        }

        $voterNames = [];
        foreach ($mostActiveVoters as $voter) {
            $voter_name = $employeeModel->getEmployeeNameById($voter['voter_id']);
            $voterNames[] = $voter_name;
        }

        return [
            'voters' => implode(', ', $voterNames),
            'votes' => $maxVotes
        ];
    }

    return [];
}
?>
