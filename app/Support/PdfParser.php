<?php

namespace App\Support;

use Illuminate\Support\Arr;
use Illuminate\Support\Carbon;
use Smalot\PdfParser\Parser;

class PdfParser
{
    /**
     * @var string
     */
    private $file;
    /**
     * @var \Smalot\PdfParser\Parser
     */
    private $parser;

    private $pages;
    /**
     * @var \App\Support\Game
     */
    private $game;

    public function __construct($file)
    {
        $this->file = $file;
        $this->parser = new Parser();
    }

    /**
     * @throws \Exception
     */
    public function process(): void
    {
        $pdf = $this->parser->parseFile($this->file);
        $this->pages = $pdf->getPages();

        $this->parseGameInformation();
    }

    /**
     *
     */
    private function parseGameInformation(): void
    {
        $page1 = Arr::get($this->pages, 0);
        $textArray = $page1->getTextArray();

        $gamePair = explode('vs.', $textArray[3]);

        $homeTeam = trim(explode('(', $gamePair[1])[0]);
        $guestTeam = trim(explode('(', $gamePair[0])[0]);

        $date = trim(explode('• Site:', $textArray[4])[0]);
        $date = Carbon::parse(substr($date, 6));

        $site = trim(explode('Site:', $textArray[4])[1]);
        $site = explode('• Stadium:', $site);
        $city = trim($site[0]);
        $stadium = trim($site[1]);

        $attendance = (int)trim(explode('Attendance:', $textArray[5])[1]);

        $scoreHome = (int)$textArray[9];
        $scoreGuest = (int)$textArray[11];

        $this->game = new Game();
        $this->game->setHomeTeam($homeTeam);
        $this->game->setGuestTeam($guestTeam);
        $this->game->setDate($date);
        $this->game->setCity($city);
        $this->game->setStadium($stadium);
        $this->game->setAttendance($attendance);
        $this->game->setScoreHome($scoreHome);
        $this->game->setScoreGuest($scoreGuest);
    }

    /**
     * @return \App\Support\Game
     */
    public function getGame(): Game
    {
        return $this->game;
    }
}
