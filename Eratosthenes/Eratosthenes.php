<?php
/**
 * Eratosthenes.php
 * エラストストテネスの篩を実装するクラス
 *
 * @since php7.1
 */

class Eratosthenes{

/**
 * generatePrimeNumbers
 *
 * @param int $inputNumber
 * @access public
 * @return array primeNumbers
 */
    public static function generatePrimeNumbers(int $inputNumber){

        $primeNumbers = $searchNumbers = array();

        if ($inputNumber > 0 && $inputNumber < 2){
            return $primeNumbers;
        }

        // create search numbers
        // The minimum prime number is 2
        for ($i = 2 ; $i <= $inputNumber; ++$i){
            $searchNumbers[] = $i;
        }

        return self::sieve($inputNumber, $searchNumbers, $primeNumbers);
    }

/**
 * sieve
 *
 * @param int $inputNumber
 * @param array searchNumbers
 * @param array primeNumbers
 * @access private
 * @return array
 */
    private function sieve(int $inputNumber, array $searchNumbers, array $primeNumbers){

        $firstNumber = array_shift($searchNumbers);

        // Until the start value of the search list reaches the square root of input value
        if ($firstNumber > sqrt($inputNumber)){

            $primeNumbers = array_merge($primeNumbers, $searchNumbers);

            return $primeNumbers;
        }

        $primeNumbers[] = $firstNumber;

        // Sift the multiple from the search list.
        foreach($searchNumbers as $k => $n){

            if ($n % $firstNumber == 0 ){
                unset($searchNumbers[$k]);
            }
        }

        return self::sieve($inputNumber, $searchNumbers, $primeNumbers);
    }
}

/**
 * execute
 *
 */
 $inputNumber = 100;
 $result = Eratosthenes::generatePrimeNumbers($inputNumber);
 print_r($result);
