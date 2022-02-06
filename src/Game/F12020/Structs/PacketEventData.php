<?php


namespace VirginEnt\SimTelemetryParser\Game\F12020\Structs;

use VirginEnt\SimTelemetryParser\Util\BinaryFormatCodesHelper;

class PacketEventData extends AbstractF12020Struct
{

    /**
    * Header
    *
    * @var PacketHeader
    */
    protected PacketHeader $header;

    /**
    * Event string code, see below
    *
    * @var string
    * @type BinaryFormatCodesHelper::CHAR
    * @size 4
    */
    protected string $eventStringCode;

    /**
     * @return PacketHeader
     */
    public function getHeader(): PacketHeader
    {
        return $this->header;
    }

    /**
     * @return string
     */
    public function getEventStringCode(): string
    {
        return $this->eventStringCode;
    }
}