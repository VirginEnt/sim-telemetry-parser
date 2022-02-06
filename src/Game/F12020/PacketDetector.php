<?php

namespace VirginEnt\SimTelemetryParser\Game\F12020;

use VirginEnt\SimTelemetryParser\Game\F12020\Structs\AbstractF12020Struct;
use VirginEnt\SimTelemetryParser\Game\F12020\Structs\FastestLap;
use VirginEnt\SimTelemetryParser\Game\F12020\Structs\PacketCarSetupData;
use VirginEnt\SimTelemetryParser\Game\F12020\Structs\PacketCarStatusData;
use VirginEnt\SimTelemetryParser\Game\F12020\Structs\PacketCarTelemetryData;
use VirginEnt\SimTelemetryParser\Game\F12020\Structs\PacketEventData;
use VirginEnt\SimTelemetryParser\Game\F12020\Structs\PacketFinalClassificationData;
use VirginEnt\SimTelemetryParser\Game\F12020\Structs\PacketLapData;
use VirginEnt\SimTelemetryParser\Game\F12020\Structs\PacketLobbyInfoData;
use VirginEnt\SimTelemetryParser\Game\F12020\Structs\PacketMotionData;
use VirginEnt\SimTelemetryParser\Game\F12020\Structs\PacketParticipantsData;
use VirginEnt\SimTelemetryParser\Game\F12020\Structs\PacketSessionData;
use VirginEnt\SimTelemetryParser\Game\F12020\Structs\Penalty;
use VirginEnt\SimTelemetryParser\Game\F12020\Structs\RaceWinner;
use VirginEnt\SimTelemetryParser\Game\F12020\Structs\Retirement;
use VirginEnt\SimTelemetryParser\Game\F12020\Structs\SpeedTrap;
use VirginEnt\SimTelemetryParser\Game\F12020\Structs\TeamMateInPits;
use VirginEnt\SimTelemetryParser\Packet\PacketDetectorInterface;
use VirginEnt\SimTelemetryParser\Packet\PacketInterface;
use VirginEnt\SimTelemetryParser\Util\BinaryFormatCodesHelper;

class PacketDetector implements PacketDetectorInterface
{
    const PACKET_MOTION = 0;
    const PACKET_SESSION = 1;
    const PACKET_LAP_DATA = 2;
    const PACKET_EVENT = 3;
    const PACKET_PARTICIPANTS = 4;
    const PACKET_CAR_SETUPS = 5;
    const PACKET_CAR_TELEMETRY = 6;
    const PACKET_CAR_STATUS = 7;
    const PACKET_FINAL_CLASSIFICATION = 8;
    const PACKET_LOBBY_INFO = 9;

    /**
     * Get the packet ID from the
     * F1 2020 binary stream
     *
     * @param string $stream
     * @return int
     */
    public function identifyPacketIdFromStream(string $stream): int
    {
        $props = [
            BinaryFormatCodesHelper::UINT16_LE."format",
            BinaryFormatCodesHelper::UINT8_LE."majorVersion",
            BinaryFormatCodesHelper::UINT8_LE."minorVersion",
            BinaryFormatCodesHelper::UINT8_LE."packetVersion",
            BinaryFormatCodesHelper::UINT8_LE."packetId"
        ];

        // the first 5th value in the stream is an a 8 bit unsigned integer which tell us the type of packet
        $unpacked = unpack(implode("/", $props), $stream);

        return $unpacked['packetId'];
    }

    /**
     * Get the event code from the
     * F1 2020 binary stream - must be of type EVENT
     *
     * @param string $stream
     * @return string
     */
    public function identifyEventCodeFromStream(string $stream): string
    {
        $props = [
            BinaryFormatCodesHelper::UINT16_LE."format",
            BinaryFormatCodesHelper::UINT8_LE."majorVersion",
            BinaryFormatCodesHelper::UINT8_LE."minorVersion",
            BinaryFormatCodesHelper::UINT8_LE."packetVersion",
            BinaryFormatCodesHelper::UINT8_LE."packetId",
            BinaryFormatCodesHelper::UINT64_LE."sessionUID",
            BinaryFormatCodesHelper::FLOAT_LE."sessionTime",
            BinaryFormatCodesHelper::UINT32_LE."frameIdentifier",
            BinaryFormatCodesHelper::UINT8_LE."playerCarIndex",
            BinaryFormatCodesHelper::UINT8_LE."secondaryPlayerCarIndex",
            BinaryFormatCodesHelper::CHAR."4eventStringCode"
        ];

        // the first 5th value in the stream is an a 8 bit unsigned integer which tell us the type of packet
        $unpacked = unpack(implode("/", $props), $stream);

        return $unpacked['eventStringCode'];
    }

    /**
     * Get the specific struct for our packet
     *
     * @param string $stream
     * @return AbstractF12020Struct
     */
    public function getPacketModelFromStream(string $stream): AbstractF12020Struct
    {
        $packetId = $this->identifyPacketIdFromStream($stream);
        $eventCode = null;

        if ($packetId === self::PACKET_EVENT) {
            $eventCode = $this->identifyEventCodeFromStream($stream);
        }

        return $this->getPacketModelFromPacketId($packetId, $eventCode);
    }

    /**
     * Get the packet model
     * given an ID of a specific
     * packet
     *
     * @param int $packetId
     * @param string|null $eventType
     * @return AbstractF12020Struct
     */
    public function getPacketModelFromPacketId(int $packetId, ?string $eventType = null): AbstractF12020Struct
    {
        switch ($packetId) {
            case self::PACKET_MOTION:
                return new PacketMotionData();
            case self::PACKET_SESSION:
                return new PacketSessionData();
            case self::PACKET_LAP_DATA:
                return new PacketLapData();
            case self::PACKET_EVENT:
                switch ($eventType) {
                    case "SPTP":
                        return new SpeedTrap();
                    case "PENA":
                        return new Penalty();
                    case "RCWN":
                        return new RaceWinner();
                    case "TMPT":
                        return new TeamMateInPits();
                    case "RTMT":
                        return new Retirement();
                    case "FTLP":
                        return new FastestLap();
                    case "CHQF":
                    case "DRSD":
                    case "DRSE":
                    case "SEND":
                    case "SSTA":
                        return new PacketEventData();
                }
                break;
            case self::PACKET_PARTICIPANTS:
                return new PacketParticipantsData();
            case self::PACKET_CAR_SETUPS:
                return new PacketCarSetupData();
            case self::PACKET_CAR_TELEMETRY:
                return new PacketCarTelemetryData();
            case self::PACKET_CAR_STATUS:
                return new PacketCarStatusData();
            case self::PACKET_FINAL_CLASSIFICATION:
                return new PacketFinalClassificationData();
            case self::PACKET_LOBBY_INFO:
                return new PacketLobbyInfoData();
        }

        throw new \RuntimeException('Unexpected packet received - '.$packetId);
    }

    /**
     * Get the specific struct for our data
     *
     * @param array $data
     * @return AbstractF12020Struct
     */
    public function getPacketModelFromData(array $data): AbstractF12020Struct
    {
        $packetId = $data['header']['packetId'];
        $stringCode = $data['eventStringCode'] ?? null;
        return $this->getPacketModelFromPacketId($packetId, $stringCode);
    }
}