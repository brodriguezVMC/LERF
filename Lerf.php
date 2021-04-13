<?php

namespace Subascorp\Harmony\Math;

class Lerf
{
    public static function value()
    {
        return (1+sqrt(5))/2;
    }

    public static function decompose($expectation, $iterations)
    {
        return $expectation/pow(self::value(), $iterations);
    }

    /*
     * Calcula los montos de consignación para el nivel de usuario
     * y la consignación base ingresada, si la consignación base es
     * negativa, se tomará el valor absoluto de la misma.
     */
    public function consignmentCalculation($userLevel, $baseConsignment): array
    {
        $baseConsignment = abs($baseConsignment);
        $consignmentDecomposed = [
            1 => self::decompose($baseConsignment, 1),
            2 => self::decompose($baseConsignment, 2),
            3 => self::decompose($baseConsignment, 3),
            4 => self::decompose($baseConsignment, 4),
            5 => self::decompose($baseConsignment, 5),
        ];

        $levelConsignment = [
            '-6' => $baseConsignment + $consignmentDecomposed[1] * 2,
            '-5' => $baseConsignment + $consignmentDecomposed[1] + $consignmentDecomposed[2],
            '-4' => $baseConsignment + $consignmentDecomposed[1] + $consignmentDecomposed[3],
            '-3' => $baseConsignment + $consignmentDecomposed[1],
            '-2' => $baseConsignment + $consignmentDecomposed[2],
            '-1' => $baseConsignment + $consignmentDecomposed[3],
            '0' => $baseConsignment,
            '1' => $consignmentDecomposed[1] + $consignmentDecomposed[3],
            '2' => $consignmentDecomposed[1] + $consignmentDecomposed[4],
            '3' => $consignmentDecomposed[1],
            '4' => $consignmentDecomposed[1] - $consignmentDecomposed[4],
            '5' => $consignmentDecomposed[1] - $consignmentDecomposed[3],
            '6' => $consignmentDecomposed[2] - $consignmentDecomposed[5],
            '7' => $consignmentDecomposed[3],
            '8' => $consignmentDecomposed[4],
            '9' => $consignmentDecomposed[5],
            '10' => 0
        ];

        try {
            return [
                'cash' => $userLevel < 0 ? null : ceil($levelConsignment[$userLevel] * 2),
                'coin' => ceil($levelConsignment[$userLevel] <= 10 ? 0 : $levelConsignment[$userLevel])
            ];
        } catch (\Exception $e) {
            // error de nivel inexistente
        }
    }
}

print_r((new Lerf())->consignmentCalculation(-7, 98));
