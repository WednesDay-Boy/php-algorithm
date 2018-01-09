<?php
/**
 *  Fraction.php
 *
 *
 *  @since php7.1
 */
class Fraction {

/**
 *  fractions
 *  
 *  @var array
 */
    private $fractions = array();

/**
 *  __construct
 *  
 *  @param string $formula
 *  @access public
 *  @return void
 */
    public function __construct($formula){
        
        $divideFormula = explode(' ', $formula);
        $fractions = array();
        $sign = 1;

        foreach($divideFormula as $key => &$df){

            if ($df === '-'){
                $sign = -1;
            } 

            if ($df === '+'){
                $sign = 1;
            }

            if (strripos($df, '/')){

                $df = explode('/',$df);

                $df[0] = (int)$df[0];
                $df[1] = (int)$df[1];

                if ( $df[0] > 0 && $df[1] > 0 ){

                    $df[0] *= $sign;
                    $fractions[$key] = $df;

                } else {

                    echo 'error!';
                    exit();
                }
            }
        }

        $this->fractions = $fractions;
    }

/**
 *  calc
 *
 *  @access public
 *  @return string $result
 */
    public function calc(){

        $fractions = $this->fractions;
        
        $num1 = array_shift($fractions)[1];
        $num2 = array_shift($fractions)[1];
        
        $lcm = $this->lcm($num1, $num2, $fractions);

        $molecule = 0;
        foreach($this->fractions as $fraction){
            $molecule += $fraction[0] * ($lcm / $fraction[1]);
        }

        $gcd = $this->gcd(abs($molecule), $lcm);

        $sign = '+';

        if ($molecule < 0) {
            $sign = '-';
        }

        if ((int)$lcm / $gcd === 1){

            return sprintf(
                "%s%d", 
                $sign,
                abs((int)$molecule / $gcd)
            );

        } else {

            return sprintf(
                "%s%d/%d", 
                $sign,
                abs((int)$molecule / $gcd),
                (int)$lcm / $gcd
            );
        }
    }

/**
 * gcd
 * Find the greatest common divisor
 *
 * @param int $num1
 * @param int $num2
 * @access private
 * @return int $gcd the greatest common divisor
 */
    private function gcd(int $num1, int $num2) : int {

        if ($num2 > $num1){
            return $this->gcd($num2, $num1);
        }

        if ($num2 === 0){
            return $num1;
        }

        return $this->gcd($num2, $num1 % $num2);
    }

/**
 * lcm
 * Find the least common multiple
 *
 * @param int $num1
 * @param int $num2
 * @param array $fractions
 * @access private
 * @return int $lcm
 */
    private function lcm(int $num1, int $num2, array $fractions) : int {

        if (empty($fractions)){
            
            // If the greatest common divisor of A and B is G and
            // the least common multiple is L, then AB = GL holds
            $gcd = $this->gcd($num1, $num2);
            return $num1 * $num2 / $gcd;
        }

        $tmpNum1 = $num1 % $num2; 

        if ($tmpNum1 === 0){
            $num1 /= $num2; 
        } else {
            $num1 *= $num2;
        } 

        return $this->lcm($num1, array_shift($fractions)[1], $fractions);
    }
}

/**
 * 
 * @example
 */
$formula = '- 1/3 - 4/3 - 1/3';
$fraction = new Fraction($formula);
echo $fraction->calc();
