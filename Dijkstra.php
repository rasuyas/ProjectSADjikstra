<?php

class PriorityList {
	public $next;
	public $data;
	function __construct($data) {
		$this->next = null;
		$this->data = $data;
	}
}

class PriorityQueue {
	
	private $size;
	private $liststart;
	private $comparator;
	
	function __construct($comparator) {
		$this->size = 0;
		$this->liststart = null;
		$this->listend = null;
		$this->comparator = $comparator;
	}
	
	function add($x) {
		$this->size = $this->size + 1;
		
		if($this->liststart == null) {
			$this->liststart = new PriorityList($x);
		} else {
			$node = $this->liststart;
			$comparator = $this->comparator;
			$newnode = new PriorityList($x);
			$lastnode = null;
			$added = false;
			while($node) {
				if ($comparator($newnode, $node) < 0) {
					// newnode has higher priority
					$newnode->next = $node;
					if ($lastnode == null) {
						//print "last node is null\n";
						$this->liststart = $newnode;
					} else {
						//print "Debug: " . $newnode->data . " has lower priority than " . $lastnode->data . "\n";
						$lastnode->next = $newnode;
					}
					$added = true;
					break;
				}
				$lastnode = $node;
				$node = $node->next;
			}
			if (!$added) {
				// Lowest priority - add to the very end
				$lastnode->next = $newnode;
			}
		}
	}
	
	
	function size() {
		return $this->size;
	}
	
	function peak() {
		return $this->liststart->data;
	}
	
	function remove() {
		$x = $this->peak();
		$this->size = $this->size - 1;
		$this->liststart = $this->liststart->next;
		return $x;
	}
}
<?php

class Edge {
	
	public $start;
	public $end;
	public $weight;
	
	public function __construct($start, $end, $weight) {
		$this->start = $start;
		$this->end = $end;
		$this->weight = $weight;
	}
}

function compareWeights($a, $b) {
	return $a->data[0] - $b->data[0];
}

class Graph {
	
	public $nodes = array();
	
	public function addedge($start, $end, $weight = 0) {
		if (!isset($this->nodes[$start])) {
			$this->nodes[$start] = array();
		}
		array_push($this->nodes[$start], new Edge($start, $end, $weight));
	}
