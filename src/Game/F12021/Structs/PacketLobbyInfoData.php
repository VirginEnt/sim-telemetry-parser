<?php


namespace VirginEnt\SimTelemetryParser\Game\F12021\Structs;

use VirginEnt\SimTelemetryParser\Util\BinaryFormatCodesHelper;

class PacketLobbyInfoData extends AbstractF12021Struct
{

    /**
    * Header
    *
    * @var PacketHeader
    */
    protected PacketHeader $header;

    /**
    * Number of players in the lobby data
    *
    * @var int
    * @type BinaryFormatCodesHelper::UINT8_LE
    */
    protected int $numPlayers;

    /**
    * 
    *
    * @var LobbyInfoData[]
    * @size 22
    */
    protected array $lobbyPlayers;


    /**
     * @return PacketHeader
     */
    public function getHeader(): PacketHeader
    {
        return $this->header;
    }

    /**
     * @return int
     */
    public function getNumPlayers(): int
    {
        return $this->numPlayers;
    }

    /**
     * @return LobbyInfoData[]
     */
    public function getLobbyPlayers(): array
    {
        return $this->lobbyPlayers;
    }


    /**
     * @param int $playerIndex
     * @return LobbyInfoData
     */
    public function getLobbyPlayer(int $playerIndex): LobbyInfoData
    {
        return $this->lobbyPlayers[$playerIndex];
    }


}