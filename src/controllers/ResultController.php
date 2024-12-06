<?php
class ResultController
{
    private $resultService;

    public function __construct(ResultService $resultService)
    {
        $this->resultService = $resultService;
    }
    public function getWinnerForCategory($category_id)
    {
        return $this->resultService->getWinnerForCategory($category_id);
    }
    public function getMostActiveVoters()
    {
        return $this->resultService->getMostActiveVoter();
    }
}