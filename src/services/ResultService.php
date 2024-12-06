<?php
class ResultService
{
    private $vote;

    public function __construct(Vote $vote)
    {
        $this->vote = $vote;
    }

    public function getWinnerForCategory($category_id)
    {
        $voteCounts = $this->vote->getVoteCountsByCategory($category_id);
        if (empty($voteCounts))
            return null;
        $maxVotes = max(array_column($voteCounts, 'vote_count'));

        #in case of a tie
        $winners = array_filter($voteCounts, function ($vote) use ($maxVotes) {
            return $vote['vote_count'] === $maxVotes;
        });

        return $winners;
    }

    public function getMostActiveVoter() {
        $voters = $this->vote->getVotesByVoter();
        if (empty($voters)) {
            return null;
        }

        $maxVotes = max(array_column($voters, 'votes'));
        $mostActive = array_filter($voters, function ($voter) use ($maxVotes) {
            return $voter['votes'] === $maxVotes;
        });

        return $mostActive;
    }
}