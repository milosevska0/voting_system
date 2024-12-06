<?php

class VoteController
{
    private $voteService;

    public function __construct(VoteService $voteService)
    {
        $this->voteService = $voteService;
    }

    public function submitVote($voter_id, $nominee_id, $category_id, $comment) {
        try {
            $this->voteService->submitVote($voter_id, $nominee_id, $category_id, $comment);
            echo "Your vote has been submitted!";
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
        }
    }

}