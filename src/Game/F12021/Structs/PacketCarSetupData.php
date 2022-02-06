<?php


namespace VirginEnt\SimTelemetryParser\Game\F12021\Structs;

use VirginEnt\SimTelemetryParser\Util\BinaryFormatCodesHelper;

class PacketCarSetupData extends AbstractF12021Struct
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
    * @var CarSetupData[]
    * @size 22
    */
    protected array $carSetups;

    /**
     * @return PacketHeader
     */
    public function getHeader(): PacketHeader
    {
        return $this->header;
    }

    /**
     * @return CarSetupData[]
     */
    public function getCarSetups(): array
    {
        return $this->carSetups;
    }

    /**
     * @param int $carIndex
     * @return CarSetupData
     */
    public function getCarSetup(int $carIndex): CarSetupData
    {
        return $this->carSetups[$carIndex];
    }


}