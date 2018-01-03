<?php
/**
 * Fibonacci.php
 *
 *
 * @since php7.1
 */

class Fibonacci {

/**
 * generate
 *
 * @param int $section
 * @access public
 * @static
 * @return int $results [1,1,2,3,5,8・・・]
 */
    public static function generate(int $section){

        $results[] = 1;

        for ($i = 1; $i < $section; ++$i){

            if ($i < 2) {

                $results[] = 1;

            } else {

                $results[] = $results[$i - 1] + $results[$i - 2];
            }
        }

        return $results;
    }
 }

// execute
$section = 100;
print_r(Fibonacci::generate($section));
