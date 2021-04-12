<?php

namespace Subascorp\Harmony\Math;

class Lerf
{
    const PHI_1 = 11;
    const PHI_2 = 12;
    const PHI_3 = 13;
    const PHI_4 = 14;
    const PHI_5 = 15;

    public static function value()
    {
        return (1+sqrt(5))/2;
    }

    public static function decompose($expectation, $iterations)
    {
        return $expectation/pow(self::value(), $iterations);
    }

    public static function consignmentCalculation($userLevel, $basePrice)
    {
        $consignmentVMC = 0;
        $consignmentUSD = 0;

        if($userLevel == -6){
            $consignmentBase = ceil(self::decompose($basePrice, 10));
            $phi1 = ceil(self::decompose($basePrice, self::PHI_1));
            $consignmentVMC = $consignmentBase + $phi1 + $phi1;

        }elseif($userLevel == -5){
            $consignmentBase = ceil(self::decompose($basePrice, 10));
            $ph1 = ceil(self::decompose($basePrice, self::PHI_1));
            $ph2 = ceil(self::decompose($basePrice, self::PHI_2));
            $consignmentVMC = $consignmentBase + $ph1 + $ph2;

        }elseif($userLevel == -4){
            $consignmentBase = ceil(self::decompose($basePrice, 10));
            $ph1 = ceil(self::decompose($basePrice, self::PHI_1));
            $ph3 = ceil(self::decompose($basePrice, self::PHI_3));
            $consignmentVMC = $consignmentBase + $ph1 + $ph3;
            
        }elseif($userLevel == -3){
            $consignmentBase = ceil(self::decompose($basePrice, 10));
            $ph1 = ceil(self::decompose($basePrice, self::PHI_1));
            $consignmentVMC = $consignmentBase + $ph1;

        }elseif($userLevel == -2){
            $consignmentBase = ceil(self::decompose($basePrice, 10));
            $ph2 = ceil(self::decompose($basePrice, self::PHI_2));
            $consignmentVMC = $consignmentBase + $ph2;

        }elseif($userLevel == -1){
            $consignmentBase = ceil(self::decompose($basePrice, 10));
            $ph3 = ceil(self::decompose($basePrice, self::PHI_3));
            $consignmentVMC = $consignmentBase + $ph3;

        }elseif($userLevel == 0){
            $consignment = ceil(self::decompose($basePrice, 10));
            $consignmentVMC = $consignment;
            $consignmentUSD = $consignmentVMC * 2;
            
        }elseif($userLevel == 1){
            $ph1 = ceil(self::decompose($basePrice, self::PHI_1));
            $ph3 = ceil(self::decompose($basePrice, self::PHI_3));
            $consignmentVMC = $ph1 + $ph3;
            $consignmentUSD = $consignmentVMC * 2;

        }elseif($userLevel == 2){
            $ph1 = ceil(self::decompose($basePrice, self::PHI_1));
            $ph4 = ceil(self::decompose($basePrice, self::PHI_4));
            $consignmentVMC = $ph1 + $ph4;
            $consignmentUSD = $consignmentVMC * 2;
            
        }elseif($userLevel == 3){
            $ph1 = ceil(self::decompose($basePrice, self::PHI_1));
            $consignmentVMC = $ph1;
            $consignmentUSD = $consignmentVMC * 2;

        }elseif($userLevel == 4){
            $ph1 = ceil(self::decompose($basePrice, self::PHI_1));
            $ph4 = ceil(self::decompose($basePrice, self::PHI_4));
            $consignmentVMC = $ph1 - $ph4;
            $consignmentUSD = $consignmentVMC * 2;

        }elseif($userLevel == 5){
            $ph1 = ceil(self::decompose($basePrice, self::PHI_1));
            $ph3 = ceil(self::decompose($basePrice, self::PHI_3));
            $consignmentVMC = $ph1 - $ph3;
            $consignmentUSD = $consignmentVMC * 2;

        }elseif($userLevel == 6){
            $ph2 = ceil(self::decompose($basePrice, self::PHI_2));
            $ph5 = ceil(self::decompose($basePrice, self::PHI_5));
            $consignmentVMC = $ph2 - $ph5;
            $consignmentUSD = $consignmentVMC * 2;

        }elseif($userLevel == 7){
            $ph3 = ceil(self::decompose($basePrice, self::PHI_3));
            $consignmentVMC = $ph3;
            $consignmentUSD = $consignmentVMC * 2;

        }elseif($userLevel == 8){
            $ph4 = ceil(self::decompose($basePrice, self::PHI_4));
            $consignmentVMC = $ph4;
            $consignmentUSD = $consignmentVMC * 2;

        }elseif($userLevel == 9){
            $ph5 = ceil(self::decompose($basePrice, self::PHI_5));
            $consignmentUSD = $ph5 * 2;

        }elseif($userLevel == 10){
            $consignmentVMC = 0;
            $consignmentUSD = 0;
        }

        return [
            'VMC' => $consignmentVMC,
            'USD' => $consignmentUSD
        ];
    }
}
print_r((new Lerf())->consignmentCalculation(10, 12000));