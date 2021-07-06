<?php

namespace App\Support;

use Illuminate\Support\Carbon;

class Game
{
    /**
     * @var string
     */
    private $homeTeam = "";

    /**
     * @var string
     */
    private $guestTeam = "";

    /**
     * @var \Illuminate\Support\Carbon
     */
    private $date;

    /**
     * @var string
     */
    private $city = "";

    /**
     * @var string
     */
    private $stadium = "";

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
     * @return string
     */
    public function getHomeTeam(): string
    {
        return $this->homeTeam;
    }

    /**
     * @param string $homeTeam
     */
    public function setHomeTeam(string $homeTeam): void
    {
        $this->homeTeam = $homeTeam;
    }

    /**
     * @return string
     */
    public function getGuestTeam(): string
    {
        return $this->guestTeam;
    }

    /**
     * @param string $guestTeam
     */
    public function setGuestTeam(string $guestTeam): void
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
     * @return string
     */
    public function getCity(): string
    {
        return $this->city;
    }

    /**
     * @param string $city
     */
    public function setCity(string $city): void
    {
        $this->city = $city;
    }

    /**
     * @return string
     */
    public function getStadium(): string
    {
        return $this->stadium;
    }

    /**
     * @param string $stadium
     */
    public function setStadium(string $stadium): void
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
