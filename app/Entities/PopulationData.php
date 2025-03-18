<?php

namespace App\Entities;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="population_data", uniqueConstraints={
 *     @ORM\UniqueConstraint(name="unique_population_record", columns={"prefecture_id", "year"})
 * })
 */
class PopulationData
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="bigint", options={"unsigned": true})
     */
    private int $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entities\Prefecture")
     * @ORM\JoinColumn(name="prefecture_id", referencedColumnName="id", onDelete="CASCADE")
     */
    private Prefecture $prefecture;

    /**
     * @ORM\Column(type="integer")
     */
    private int $year;

    /**
     * @ORM\Column(type="bigint", options={"unsigned": true})
     */
    private int $population;

    public function __construct(Prefecture $prefecture, int $year, int $population)
    {
        $this->prefecture = $prefecture;
        $this->year = $year;
        $this->population = $population;
    }

    public function getPrefecture(): Prefecture
    {
        return $this->prefecture;
    }

    public function getYear(): int
    {
        return $this->year;
    }

    public function getPopulation(): int
    {
        return $this->population;
    }
}
