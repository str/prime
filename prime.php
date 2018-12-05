<?php
namespace Maphpia\Demos;

/**
 * Which prime below a million can be written as the sum of the most consecutive primes
 */

class Primes
{
    const MAX = 1 *1000 *1000; // one million

    private $sum;
    private $primes;


    private function calculate()
    {
        $sum    = 0;
        $primes = [0];

        while (true) {
            $previous = $primes[count($primes) -1];
            $newPrime = gmp_intval(gmp_nextprime($previous));
            $primes[] = $newPrime;
            if ($sum +$newPrime > self::MAX) {
                break;
            } else {
                $sum += $newPrime;
            }
        }
        array_shift($primes);

        $this->primes = $primes;
        $this->sum    = $sum;

    }

    private function show()
    {
        echo implode(' + ', $this->primes) . " = {$this->sum}";
        echo "\n";
    }

    public function __construct()
    {
        if (!function_exists('gmp_nextprime')) throw new Exception('reqquired GMP library not installed');
    }

    public function run()
    {
        $this->calculate();
        $this->show();
    }
}

$primes = new Primes();
$primes->run();