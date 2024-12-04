<?php


class calaculate
{
    public $operator;
    public $firstnum;
    public $secondnum;


    public function __construct(string $oper, int $one, int $two)
    {
        $this->operator = $oper;
        $this->firstnum = $one;
        $this->secondnum = $two;
    }


    public function calculation()
    {

        switch ($this->operator) {
            case 'add':
                $result = $this->firstnum + $this->secondnum;
                return $result;
                break;
            case 'mul':
                $result = $this->firstnum * $this->secondnum;
                return $result;
                break;
            case 'sub':
                $result = $this->firstnum - $this->secondnum;
                return $result;
                break;
            case 'div':
                if ($this->secondnum != 0) { // Avoid division by zero
                    $result = $this->firstnum / $this->secondnum;
                    return $result;
                } else {
                    return "Error: Division by zero.";
                }
                break;
            default:
                return "Error: Invalid operator.";
                break;
        }
    }
}
