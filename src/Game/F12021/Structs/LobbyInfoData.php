<?php


namespace VirginEnt\SimTelemetryParser\Game\F12021\Structs;

use VirginEnt\SimTelemetryParser\Util\BinaryFormatCodesHelper;

class LobbyInfoData extends AbstractF12021Struct
{

    /**
    * Whether the vehicle is AI (1) or Human (0) controlled
    *
    * @var int
    * @type BinaryFormatCodesHelper::UINT8_LE
    */
    protected int $aiControlled;

    /**
    * Team id - see appendix (255 if no team currently selected)
    *
    * @var int
    * @type BinaryFormatCodesHelper::UINT8_LE
    */
    protected int $teamId;

    /**
    * Nationality of the driver
    *
    * @var int
    * @type BinaryFormatCodesHelper::UINT8_LE
    */
    protected int $nationality;

    /**
    * Name of participant in UTF-8 format – null terminated
    *
    * @var string
    * @type BinaryFormatCodesHelper::CHAR
    * @size 48
    */
    protected string $name;

    /**
    * 0 = not ready, 1 = ready, 2 = spectating
    *
    * @var int
    * @type BinaryFormatCodesHelper::UINT8_LE
    */
    protected int $readyStatus;

    /**
     * @return int
     */
    public function getAiControlled(): int
    {
        return $this->aiControlled;
    }

    /**
     * @return int
     */
    public function getTeamId(): int
    {
        return $this->teamId;
    }

    /**
     * @return int
     */
    public function getNationality(): int
    {
        return $this->nationality;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return int
     */
    public function getReadyStatus(): int
    {
        return $this->readyStatus;
    }


}