<?php

interface ICarService {
    public function getCost(): int;
}

class CarService implements ICarService {
    public function getCost(): int
    {
        return 25;
    }
}


class OitService implements ICarService{
    public function __construct(CarService $carService)
    {
        $this->carService = $carService->getCost();
    }

    public function getCost(): int
    {
        return 19;
    }
}

$totalService = new OitService(new CarService());

echo $totalService->getCost();