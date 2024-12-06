<?php

class VoteService
{
    private $vote;
    private $employee;

    public function __construct(Vote $vote, Employee $employee)
    {
        $this->vote = $vote;
        $this->employee = $employee;
    }

    /**
     * @throws Exception
     */
    public function submitVote($voter_id, $nominee_id, $category_id, $comment)
    {
        if ($voter_id === $nominee_id) {
            throw new Exception("You can't vote for yourself! Choose another employee.");
        }

        try {
            return $this->vote->createVote($voter_id, $nominee_id, $category_id, $comment);
        } catch (Exception $e) {
           throw new Exception("Failed to submit vote: " . $e->getMessage());
        }
    }
}
