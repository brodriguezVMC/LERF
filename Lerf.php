<?php

namespace Subascorp\Harmony\Math;

class Lerf
{
    const CONSIGNMENT_BASE = 10;
    const PHI_1 = 11;
    const PHI_2 = 12;
    const PHI_3 = 13;
    const PHI_4 = 14;
    const PHI_5 = 15;
    const VALUES = [
        '-6' => [self::PHI_1, self::PHI_1],
        '-5' => [self::PHI_1, self::PHI_2],
        '-4' => [self::PHI_1, self::PHI_3],
        '-3' => [self::PHI_1],
        '-2' => [self::PHI_2],
        '-1' => [self::PHI_3],
        '0' => [],
        '1' => [self::PHI_1, self::PHI_3],
        '2' => [self::PHI_1, self::PHI_4],
        '3' => [self::PHI_1],
        '4' => [self::PHI_1, self::PHI_4],
        '5' => [self::PHI_1, self::PHI_3],
        '6' => [self::PHI_2, self::PHI_5],
        '7' => [self::PHI_3],
        '8' => [self::PHI_4],
        '9' => [self::PHI_5],
        '10' => []
    ];
    const ONLY_USD = [9];
    const ONLY_SUB = [4, 5, 6];

    public static function value()
    {
        return (1+sqrt(5))/2;
    }

    public static function decompose($expectation, $iterations)
    {
        return $expectation/pow(self::value(), $iterations);
    }

    public function consignmentCalculation($userLevel, $basePrice)
    {
        $consignmentBase = $userLevel <= 0 ? ceil(self::decompose($basePrice, self::CONSIGNMENT_BASE)) : null;
        
        $calculatePhi = $this->calculatePhi($basePrice, $userLevel);
        $consignmentVMC =  $consignmentBase + $calculatePhi;
        $consignmentUSD = $this->consignmentUSD($consignmentVMC, $userLevel);
        return [
            'subascoin' => !in_array(9, self::ONLY_USD) ? $consignmentVMC : null,
            'saldo' => $consignmentUSD
        ];
    }

    public function calculatePhi(int $basePrice, String $userLevel): int
    {
        $result = 0;
        foreach (self::VALUES[$userLevel] as $key => $value) {
            if (in_array($userLevel, self::ONLY_SUB) and $key > 0) {
                $result -= ceil(self::decompose($basePrice, $value));
            } else {
                $result += ceil(self::decompose($basePrice, $value));
            }
        }
        return $result;
    }

    public function consignmentUSD(int $amount, int $userLevel):? int
    {
        return $userLevel >= 0 ? $amount * 2 : null;
    }
}

print_r((new Lerf())->consignmentCalculation(9, 12000));
