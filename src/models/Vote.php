<?php
class Vote
{
    private $db;

    public function __construct(Database $db)
    {
        $this->db = $db->getConnection();
    }

    public function createVote($voter_id, $nominee_id, $category_id, $comment)
    {
        $stmt = $this->db->prepare("INSERT INTO votes (voter_id, nominee_id, category_id, comment) 
                                    VALUES (:voter_id, :nominee_id, :category_id, :comment)");
        $stmt->bindParam(':voter_id', $voter_id);
        $stmt->bindParam(':nominee_id', $nominee_id);
        $stmt->bindParam(':category_id', $category_id);
        $stmt->bindParam(':comment', $comment);
        return $stmt->execute();
    }
    public function getVoteCountsByCategory($category_id)
    {
        $stmt = $this->db->prepare("SELECT nominee_id, COUNT(*) as vote_count
                                    FROM votes
                                    WHERE category_id = :category_id
                                    GROUP BY nominee_id");
        $stmt->bindParam(':category_id', $category_id);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function getVotesByVoter() {
        $query = "SELECT voter_id, COUNT(*) as votes 
                  FROM votes 
                  GROUP BY voter_id 
                  ORDER BY votes DESC";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}