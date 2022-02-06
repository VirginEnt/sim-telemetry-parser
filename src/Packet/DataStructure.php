<?php


namespace VirginEnt\SimTelemetryParser\Packet;


interface DataStructure
{
    public function hydrate(array $data);
}