<?php


abstract class CarFactory implements CarFactoryInterface
{
    protected $cartName;
    protected $bodyName;
    protected $lampType;
    public function __construct()
    {

    }

    public function createBodyType(): BodyType
    {
        // TODO: Implement createBodyType() method.
    }

    public function createLampType(): LampType
    {
        // TODO: Implement createLampType() method.
    }

    public function createTireType(): TireType
    {
        // TODO: Implement createTireType() method.
    }

    /**
     * @return mixed
     */
    public function getCartName()
    {
        return $this->cartName;
    }

    /**
     * @param mixed $cartName
     */
    public function setCartName($cartName): void
    {
        $this->cartName = $cartName;
    }
}

class MercedezFactory extends CarFactory {

}

class HundayFactory extends CarFactory {

}

class RangeRoverFacory extends CarFactory {

}


class RangeRoverVelar extends RangeRoverFacory {

}