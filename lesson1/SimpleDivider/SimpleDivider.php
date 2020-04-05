<?php

class SimpleDivider
{
    public $number;
    public $currentSimpleNumbers = [];
    public $maxDivider = 1;
    public $formula;
    
    public function __construct($number)
    {
        $this->number = $number;
        $this->formula = $number . ' = ' . '1';
        $this->run();
    }
    
    private function isSimpleNumber($number)
    {
        $numberRoot = sqrt($this->number);
        foreach ($this->currentSimpleNumbers as $value) {
            if ($number % $value === 0) {
                return false;
            }
            if ($value > $numberRoot) {
                break;
            }
        }
        
        $this->currentSimpleNumbers[] = $number;
        return true;
    }
    
    private function isDivide($dividend, $divider)
    {
        if ($dividend % $divider === 0) {
            return true;
        }
        return false;
    }
    
    private function run()
    {
        $i = 3;
        $number = $this->number;
        while ($i <= $number) {
            if ($this->isSimpleNumber($i)) {
                while ($this->isDivide($number, $i)) {
                    $number /= $i;
                    $this->maxDivider = $i;
                    $this->formula .= ' * ' . $i;
                }
            }
            $i += 2;
        }
    }
    
    public function getMaxDivider()
    {
        return $this->maxDivider;
    }
    
    public function getFormula()
    {
        return $this->formula;
    }
    
}