<?php

namespace App\Support;

use App\Enums\EnumTeamStatistics;
use App\Models\Game as GameAlias;
use App\Models\Stadium;
use App\Models\Team;
use App\Models\TeamStatistic;
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

    /**
     * @var
     */
    private $pages;

    /**
     * @var Game
     */
    private $game;

    /**
     * @var GameAlias
     */
    private $storedGame;

    /**
     * @var Team
     */
    private $homeTeam;

    /**
     * @var Team
     */
    private $guestTeam;

    /**
     * @var Stadium
     */
    private $stadium;

    public function __construct($file)
    {
        $this->file   = $file;
        $this->parser = new Parser();
    }

    /**
     * @throws \Exception
     */
    public function process(): void
    {
        $pdf         = $this->parser->parseFile($this->file);
        $this->pages = $pdf->getPages();

        $this->parseGameInformation();
        $this->parseTeamStatistics();
    }

    /**
     *
     */
    private function parseGameInformation(): void
    {
        $page      = Arr::get($this->pages, 0);
        $textArray = $page->getTextArray();

        $this->parseTeams($textArray);
        $this->parseStadium($textArray);

        $date = trim(explode('• Site:', $textArray[4])[0]);
        $date = Carbon::parse(substr($date, 6));

        $attendance = (int) trim(explode('Attendance:', $textArray[5])[1]);

        $scoreHome  = (int) $textArray[11];
        $scoreGuest = (int) $textArray[9];

        $this->game = new Game();
        $this->game->setHomeTeam($this->homeTeam);
        $this->game->setGuestTeam($this->guestTeam);
        $this->game->setDate($date);
        $this->game->setStadium($this->stadium);
        $this->game->setAttendance($attendance);
        $this->game->setScoreHome($scoreHome);
        $this->game->setScoreGuest($scoreGuest);

        $this->createGame();
    }

    /**
     *
     */
    public function createGame()
    {
        $this->storedGame = GameAlias::updateOrCreate([
            'home_team_id'  => $this->game->getHomeTeam()->id,
            'guest_team_id' => $this->game->getGuestTeam()->id,
        ], [
            'home_team_id'  => $this->game->getHomeTeam()->id,
            'guest_team_id' => $this->game->getGuestTeam()->id,
            'date'          => $this->game->getDate(),
            'stadium_id'    => $this->game->getStadium()->id,
            'attendance'    => $this->game->getAttendance(),
            'score_home'    => $this->game->getScoreHome(),
            'score_guest'   => $this->game->getScoreGuest(),
        ]);
    }

    /**
     * @param $textArray
     */
    private function parseTeams($textArray): void
    {
        $gamePair      = explode('vs.', $textArray[3]);
        $homeTeamName  = trim(explode('(', $gamePair[1])[0]);
        $guestTeamName = trim(explode('(', $gamePair[0])[0]);

        $this->homeTeam = Team::updateOrCreate([
            'name' => $homeTeamName,
        ], [
            'name' => $homeTeamName,
        ]);

        $this->guestTeam = Team::updateOrCreate([
            'name' => $guestTeamName,
        ], [
            'name' => $guestTeamName,
        ]);
    }

    /**
     * @param $textArray
     */
    private function parseStadium($textArray)
    {
        $site    = trim(explode('Site:', $textArray[4])[1]);
        $site    = explode('• Stadium:', $site);
        $city    = trim($site[0]);
        $stadium = trim($site[1]);

        $this->stadium = Stadium::updateOrCreate([
            'name' => $stadium,
        ], [
            'name' => $stadium,
            'city' => $city,
        ]);
    }

    /**
     *
     */
    private function parseTeamStatistics()
    {
        $page      = Arr::get($this->pages, 1);
        $textArray = $page->getTextArray();

        dd($page->getText());

        $values = explode(' ', $textArray[5]);

        TeamStatistic::updateOrCreate([
            'team_id'  => $this->storedGame->guest_team_id,
            'game_id'  => $this->storedGame->id,
            'meta_key' => EnumTeamStatistics::FIRST_DOWNS,
        ], [
            'team_id'    => $this->storedGame->guest_team_id,
            'game_id'    => $this->storedGame->id,
            'meta_key'   => EnumTeamStatistics::FIRST_DOWNS,
            'meta_value' => $values[0],
        ]);
        TeamStatistic::updateOrCreate([
            'team_id'  => $this->storedGame->home_team_id,
            'game_id'  => $this->storedGame->id,
            'meta_key' => EnumTeamStatistics::FIRST_DOWNS,
        ], [
            'team_id'    => $this->storedGame->home_team_id,
            'game_id'    => $this->storedGame->id,
            'meta_key'   => EnumTeamStatistics::FIRST_DOWNS,
            'meta_value' => $values[1],
        ]);
    }
}
