<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Bundle\FixturesBundle\FixtureGroupInterface;

abstract class BaseFixtures extends Fixture implements FixtureGroupInterface
{
    public static function getGroups(): array
    {
        return ["local"];
    }
}
