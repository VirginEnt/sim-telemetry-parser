<?php


namespace VirginEnt\SimTelemetryParser\Game\F12021\Structs;

use VirginEnt\SimTelemetryParser\Util\BinaryFormatCodesHelper;

class PacketCarDamageData extends AbstractF12021Struct
{

    /**
    * Header
    *
    * @var PacketHeader
    */
    protected PacketHeader $header;

    /**
    * 
    *
    * @var carDamageData[]
    * @size 22
    */
    protected array $carDamageData;

    /**
     * @return PacketHeader
     */
    public function getHeader(): PacketHeader
    {
        return $this->header;
    }

    /**
     * @return carDamageData[]
     */
    public function getCarDamageData(): array
    {
        return $this->carDamageData;
    }

    /**
     * @param int $carIndex
     * @return CarDamage
     */
    public function getCarDamage(int $carIndex): CarDamageData
    {
        return $this->carDamageData[$carIndex];
    }


}