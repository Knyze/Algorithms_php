<?php

class BinaryNode
{
	public $value;
	public $left = null;
	public $right = null;
    
    public $priority = 0;
    public $isNumber = true;

	public function __construct($value)
	{
		$this->value = $value;
        $this->isNumber = !toolFunc::isOperator($value);
        if (toolFunc::isOperator($value)) {
            $this->priority = toolFunc::priority($value);
        }
	}
}


class BinaryTree {

	public $root;

	public function __construct()
	{
		$this->root = null;
	}

	public function insert($item)
	{
		$node = new BinaryNode($item);
        $this->insertNode($node, $this->root);
	}
    
    protected function insertNode ($node, &$subtree) {

		if ($subtree === null) {
			$subtree = $node;
		}
        elseif (
            (($subtree->isNumber) || ($subtree->priority > $node->priority)) && 
            !($node->isNumber)
        ) {
            $lastLeaf = $subtree;
            $subtree = $node;
            $subtree->left = $lastLeaf;
        } else {
            $this->insertNode($node, $subtree->right);
        }
	}
    
    public function calculate()
    {
        return $this->calculateLeaf($this->root);
    }
    
    protected function calculateLeaf(&$subtree)
    {
        switch ($subtree->value) {
			case '^' :
				return pow($this->calculateLeaf($subtree->left), $this->calculateLeaf($subtree->right));
			case '*' :
                return $this->calculateLeaf($subtree->left) * $this->calculateLeaf($subtree->right);
			case '/' :
				return $this->calculateLeaf($subtree->left) / $this->calculateLeaf($subtree->right);
			case '+' :
                return $this->calculateLeaf($subtree->left) + $this->calculateLeaf($subtree->right);
			case '-' :
				return $this->calculateLeaf($subtree->left) - $this->calculateLeaf($subtree->right);
            default:
                return $subtree->value;
		}
    }

}

class MathParse
{
	public $tree;
	public $math;

	public function __construct($math)
	{
		$this->tree = new BinaryTree();
		$this->math = $math;
	}

	function doMathParse()
	{
		//разделяем на массив
		$mathArray = preg_split('//', $this->math, -1, PREG_SPLIT_NO_EMPTY);

		$n = count($mathArray);
		for ($i = 0; $i < $n; $i++) {

			$ch = $mathArray[$i]; //один символ

			//если число
			if (is_numeric($ch)) {
				$number = '';

				// пробегаем по всему числу, пока не наткнемся на пробел
				while (is_numeric($mathArray[$i])) {
					$number .= $mathArray[$i++];
				}
				//добавляем в дерево
				$this->tree->insert((int) $number);

				$i--;

				//если оператор
			} elseif (toolFunc::isOperator($ch)) {
                //добавляем в дерево
                $this->tree->insert($ch);
			} elseif (toolFunc::bktPriority($ch)) {}
		}

		//отдаем получившийся результат
		return $this->tree;
	}

}

//класс для пары общих функций
class toolFunc {
    
    public static $bkt_priority = 0;
    

	public static function isOperator($ch)
	{
		$operators = ['^', '*', '/', '+', '-'];
		return in_array($ch, $operators);
	}

	public static function priority($operator)
	{
		switch ($operator) {
			case '^' :
				return 3 + self::$bkt_priority;
			case '*' :
			case '/' :
				return 2 + self::$bkt_priority;
			case '+' :
			case '-' :
				return 1 + self::$bkt_priority;
		}
		return 0;
	}
    
    public static function bktPriority($bkt)
	{
		switch ($bkt) {
			case '(' :
				self::$bkt_priority += 10;
                break;
			case ')' :
                self::$bkt_priority -= 10;
                break;
		}
	}

}

$infix = '11*(42 + 23 )-(40^2/5)';

$mathParse = new MathParse($infix);
echo print_r($mathParse->doMathParse());
echo PHP_EOL . 'result:  ' . $mathParse->tree->calculate();
