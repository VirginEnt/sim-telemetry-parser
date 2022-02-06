<?php


namespace VirginEnt\SimTelemetryParser\Game\F12020\Structs;

use VirginEnt\SimTelemetryParser\Util\BinaryFormatCodesHelper;

class PacketLapData extends AbstractF12020Struct
{

    /**
    * Header
    *
    * @var PacketHeader
    */
    protected PacketHeader $header;

    /**
    * Lap data for all cars on track
    *
    * @var LapData[]
    * @size 22
    */
    protected array $lapData;

    /**
     * @return PacketHeader
     */
    public function getHeader(): PacketHeader
    {
        return $this->header;
    }

    /**
     * @return LapData[]
     */
    public function getLapData(): array
    {
        return $this->lapData;
    }

    /**
     * @param int $carIndex
     * @return LapData
     */
    public function getCarLapData(int $carIndex): LapData
    {
        return $this->lapData[$carIndex];
    }

}