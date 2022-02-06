<?php


namespace VirginEnt\SimTelemetryParser\Game\F12021\Structs;

use VirginEnt\SimTelemetryParser\Util\BinaryFormatCodesHelper;

class CarDamageData extends AbstractF12021Struct
{

    /**
    * Tyre wear percentage
    *
    * @var int[]
    * @type BinaryFormatCodesHelper::UINT8_LE
    * @size 4
    */
    protected array $tyresWear;
    
    /**
    * Tyre damage (percentage)
    *
    * @var int[]
    * @type BinaryFormatCodesHelper::UINT8_LE
    * @size 4
    */
    protected array $tyresDamage;
    
    /**
    * Brakes damage percentage
    *
    * @var int[]
    * @type BinaryFormatCodesHelper::UINT8_LE
    * @size 4
    */
    protected array $brakesDamage;

    /**
    * Front left wing damage (percentage)
    *
    * @var int
    * @type BinaryFormatCodesHelper::UINT8_LE
    */
    protected int $frontLeftWingDamage;
    
    /**
    * Front right wing damage (percentage)
    *
    * @var int
    * @type BinaryFormatCodesHelper::UINT8_LE
    */
    protected int $frontRightWingDamage;
    
    /**
    * Rear wing damage (percentage)
    *
    * @var int
    * @type BinaryFormatCodesHelper::UINT8_LE
    */
    protected int $rearWingDamage;

    /**
    * Floor damage percentage
    *
    * @var int[]
    * @type BinaryFormatCodesHelper::UINT8_LE
    * @size 4
    */
    protected int $floorDamage;
    
    /**
    * Diffuser damage percentage
    *
    * @var int[]
    * @type BinaryFormatCodesHelper::UINT8_LE
    * @size 4
    */
    protected int $diffuserDamage;
    
    /**
    * Sidepod damage percentage
    *
    * @var int[]
    * @type BinaryFormatCodesHelper::UINT8_LE
    * @size 4
    */
    protected int $sidepodDamage;
    
    /**
    * Indicator for DRS fault, 0 = OK, 1 = fault
    *
    * @var int
    * @type BinaryFormatCodesHelper::UINT8_LE
    */
    protected int $drsFault;
    
    /**
    * Gear box damage (percentage)
    *
    * @var int
    * @type BinaryFormatCodesHelper::UINT8_LE
    */
    protected int $gearBoxDamage;
    
    /**
    * Engine damage (percentage)
    *
    * @var int
    * @type BinaryFormatCodesHelper::UINT8_LE
    */
    protected int $engineDamage;
    
    /**
    * Engine wear MGU-H (percentage)
    *
    * @var int
    * @type BinaryFormatCodesHelper::INT8
    */
    protected int $engineMGUHWear;
    
    /**
    * Engine wear ES (percentage)
    *
    * @var int
    * @type BinaryFormatCodesHelper::INT8
    */
    protected int $engineESWear;
    
    /**
    * Engine wear CE (percentage)
    *
    * @var int
    * @type BinaryFormatCodesHelper::INT8
    */
    protected int $engineCEWear;
    
    /**
    * Engine wear ICE (percentage)
    *
    * @var int
    * @type BinaryFormatCodesHelper::INT8
    */
    protected int $engineICEWear;
    
    /**
    * Engine wear MGU-K (percentage)
    *
    * @var int
    * @type BinaryFormatCodesHelper::INT8
    */
    protected int $engineMGUKWear;
    
    /**
    * Engine wear TC (percentage)
    *
    * @var int
    * @type BinaryFormatCodesHelper::INT8
    */
    protected int $engineTCWear;
    
    /**
     * @return array
     */
    public function getTyresWear(): array
    {
        return $this->tyresWear;
    }

    /**
     * @return array
     */
    public function getTyresDamage(): array
    {
        return $this->tyresDamage;
    }
    
    /**
     * @return array
     */
    public function getBrakesDamage(): array
    {
        return $this->brakesDamage;
    }

    /**
     * @return int
     */
    public function getFrontLeftWingDamage(): int
    {
        return $this->frontLeftWingDamage;
    }

    /**
     * @return int
     */
    public function getFrontRightWingDamage(): int
    {
        return $this->frontRightWingDamage;
    }

    /**
     * @return int
     */
    public function getRearWingDamage(): int
    {
        return $this->rearWingDamage;
    }
    
    /**
     * @return int
     */
    public function getFloorDamage(): int
    {
        return $this->floorDamage;
    }

    /**
     * @return int
     */
    public function getDiffuserDamage(): int
    {
        return $this->diffuserDamage;
    }
    
    /**
     * @return int
     */
    public function getSidepodDamage(): int
    {
        return $this->sidepodDamage;
    }
    
    /**
     * @return int
     */
    public function getDrsFault(): int
    {
        return $this->drsFault;
    }

    /**
     * @return int
     */
    public function getGearBoxDamage(): int
    {
        return $this->gearBoxDamage;
    }

    /**
     * @return int
     */
    public function getEngineDamage(): int
    {
        return $this->engineDamage;
    }
    
    /**
     * @return int
     */
    public function getEngineMGUHWear(): int
    {
        return $this->engineMGUHWear;
    }
    
    /**
     * @return int
     */
    public function getEngineESWear(): int
    {
        return $this->engineESWear;
    }

    /**
     * @return int
     */
    public function getEngineCEWear(): int
    {
        return $this->engineCEWear;
    }
    
    /**
     * @return int
     */
    public function getEngineICEWear(): int
    {
        return $this->engineICEWear;
    }
    
    /**
     * @return int
     */
    public function getEngineMGUKWear(): int
    {
        return $this->engineMGUKWear;
    }
    
    /**
     * @return int
     */
    public function getEngineTCWear(): int
    {
        return $this->engineTCWear;
    }


}
