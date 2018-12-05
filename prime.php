<?php
namespace Maphpia\Demos;

/**
 * Which prime below a million can be written as the sum of the most consecutive primes
 */
class Primes
{
    const MAX = 1 *1000 *1000; // one million

    /**
     * Sum of the primes
     *
     * @var int
     */
    private $sum;

    /**
     * Calculated primes
     *
     * @var int[]
     */
    private $primes;

    /**
     * Calculates the primes and pushes them in an array.
     *
     * @return void
     */
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

    /**
     * Output of the primes and their sum.
     *
     * @return void
     */
    private function show()
    {
        echo implode(' + ', $this->primes) . " = {$this->sum}";
        echo "\n";
    }

    /**
     * Initializes the program detects dependencies
     */
    public function __construct()
    {
        if (!function_exists('gmp_nextprime')) throw new Exception('reqquired GMP library not installed');
    }

    /**
     * Public method to run the project
     *
     * @return void
     */
    public function run()
    {
        $this->calculate();
        $this->show();
    }
}

$primes = new Primes();
$primes->run();