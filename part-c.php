<?php

class CaptainLambda
{

  /**
   * Generate prime numbers 
   *
   * @param string $max
   */
  public function generatePrimeNumbers($max)
  {
    $count = 0;
    $number = 2;
    $result = array();

    while ($count < $max) {
      $div_count = 0;

      for ($i = 1; $i <= $number; $i++) {
        if (($number % $i) == 0) {
          $div_count++;
        }
      }

      if ($div_count < 3) {
        $result[] = $number;
        $count = $count + 1;
      }

      $number = $number + 1;
    }

    return $result;
  }

  /**
   * Get an answer 
   *
   * @param string $n
   */
  public function getAnswer($n)
  {
    $offset = 4;

    if ($n > 5000) {
      $max_prime_numbers = 2290;
    } else if ($n > 2000) {
      $max_prime_numbers = 1000;
    } else if ($n > 500) {
      $max_prime_numbers = 1000;
    } else {
      $max_prime_numbers = 500;
    }

    $generate_prime_numbers = $this->generatePrimeNumbers($max_prime_numbers);

    $to_string = implode('', $generate_prime_numbers);
    $to_array = str_split($to_string);

    $start = $n;
    $end = $n + $offset;

    $range = [$start, $end];

    // create an indexed array of key in $to_array, retain only 2 selected keys, get their indexes
    $indexes = array_keys(array_intersect(array_keys($to_array), $range));

    // slice the array using offset and calculated the length
    $result = array_slice($to_array, $indexes[0], $indexes[1] - $indexes[0] + 1);

    return implode('', $result);
  }
}

$captain_lambda = new CaptainLambda;

$prime_numbers = $captain_lambda->getAnswer(0);

echo 'Anwser: ' . $prime_numbers . '</br>';
