<?php

namespace VirginEnt\SimTelemetryParser\Test\ParserTest;

use VirginEnt\SimTelemetryParser\Game\GameDetector;
use VirginEnt\SimTelemetryParser\Packet\DataStructure;
use VirginEnt\SimTelemetryParser\Packet\F12020\MotionPacket;
use VirginEnt\SimTelemetryParser\Packet\PacketDetectorInterface;
use VirginEnt\SimTelemetryParser\Packet\PacketInterface;
use VirginEnt\SimTelemetryParser\Packet\Unpacker;
use VirginEnt\SimTelemetryParser\Parser;
use PHPUnit\Framework\TestCase;

class ParserTest extends TestCase
{
    public function testParse()
    {
        $stream = "example-stream";
        $data = [
            'some' => 'prop',
            'another' => 212
        ];

        $mockPacketModel = $this->getMockBuilder(DataStructure::class)->getMock();
        $mockPacketModel->expects($this->any())->method('hydrate')->with($data);

        $mockPacketIdentifier = $this->getMockBuilder(PacketDetectorInterface::class)->getMock();
        $mockPacketIdentifier->expects($this->any())->method('getPacketModelFromStream')->with($stream)->willReturn($mockPacketModel);
        $mockPacketIdentifier->expects($this->any())->method('getPacketModelFromData')->with($data)->willReturn($mockPacketModel);

        $mockGameDetector = $this->getMockBuilder(GameDetector::class)->getMock();
        $mockGameDetector->expects($this->any())->method('getGamePacketIdentifierFromStream')->with($stream)->willReturn($mockPacketIdentifier);
        $mockGameDetector->expects($this->any())->method('getGamePacketIdentifierFromData')->with($data)->willReturn($mockPacketIdentifier);

        $mockUnpacker = $this->getMockBuilder(Unpacker::class)->disableOriginalConstructor()->getMock();
        $mockUnpacker->expects($this->any())->method('unpack')->with($stream, $mockPacketModel)->willReturn($data);

        $parser = new Parser(
            $mockGameDetector,
            $mockUnpacker
        );

        $output = $parser->streamToArray($stream);
        $this->assertEquals($data, $output);

        $model = $parser->dataToModels($data);
        $this->assertEquals($mockPacketModel, $model);

        $packet = $parser->streamToModels($stream);
        $this->assertEquals($mockPacketModel, $packet);

    }
}