<?php

namespace App\Support;

use App\Models\Stadium;
use App\Models\Team;
use Illuminate\Support\Carbon;

class Game
{
    /**
     * @var Team
     */
    private $homeTeam;

    /**
     * @var Team
     */
    private $guestTeam;

    /**
     * @var \Illuminate\Support\Carbon
     */
    private $date;

    /**
     * @var Stadium
     */
    private $stadium;

    /**
     * @var int
     */
    private $attendance = 0;

    /**
     * @var int
     */
    private $scoreHome = 0;

    /**
     * @var int
     */
    private $scoreGuest = 0;

    /**
     * @return Team
     */
    public function getHomeTeam(): Team
    {
        return $this->homeTeam;
    }

    /**
     * @param Team $homeTeam
     */
    public function setHomeTeam(Team $homeTeam): void
    {
        $this->homeTeam = $homeTeam;
    }

    /**
     * @return Team
     */
    public function getGuestTeam(): Team
    {
        return $this->guestTeam;
    }

    /**
     * @param Team $guestTeam
     */
    public function setGuestTeam(Team $guestTeam): void
    {
        $this->guestTeam = $guestTeam;
    }

    /**
     * @return \Illuminate\Support\Carbon
     */
    public function getDate(): Carbon
    {
        return $this->date;
    }

    /**
     * @param \Illuminate\Support\Carbon $date
     */
    public function setDate(Carbon $date): void
    {
        $this->date = $date;
    }

    /**
     * @return Stadium
     */
    public function getStadium(): Stadium
    {
        return $this->stadium;
    }

    /**
     * @param Stadium $stadium
     */
    public function setStadium(Stadium $stadium): void
    {
        $this->stadium = $stadium;
    }

    /**
     * @return int
     */
    public function getAttendance(): int
    {
        return $this->attendance;
    }

    /**
     * @param int $attendance
     */
    public function setAttendance(int $attendance): void
    {
        $this->attendance = $attendance;
    }

    /**
     * @return int
     */
    public function getScoreHome(): int
    {
        return $this->scoreHome;
    }

    /**
     * @param int $scoreHome
     */
    public function setScoreHome(int $scoreHome): void
    {
        $this->scoreHome = $scoreHome;
    }

    /**
     * @return int
     */
    public function getScoreGuest(): int
    {
        return $this->scoreGuest;
    }

    /**
     * @param int $scoreGuest
     */
    public function setScoreGuest(int $scoreGuest): void
    {
        $this->scoreGuest = $scoreGuest;
    }
}
