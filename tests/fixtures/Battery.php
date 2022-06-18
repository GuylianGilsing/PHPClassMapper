<?php

declare(strict_types=1);

namespace PHPClassMapper\Tests\Fixtures;

final class Battery
{
    private int $battery = 0;
    private Device $device;

    public function __construct(int $battery, Device $device)
    {
        $this->battery = $battery;
        $this->device = $device;
    }

    public function getBattery(): int
    {
        return $this->battery;
    }

    public function getDevice(): Device
    {
        return $this->device;
    }
}
