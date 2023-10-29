<?php

namespace Courtier\LinkedList;

interface NodeSorted extends NodeDoubly
{
	/**
	 * Inserts $node in position accordingly to $callback two value comparison
	 * Implementation should be well aware of possible link-chain cycling and inserts $node in to last position before such cycle is detected
	 * @param \Courtier\LinkedList\Node $node
	 * @param callable $callback The comparison function must return an integer less than, equal to, or greater than zero if the first argument is considered to be respectively less than, equal to, or greater than the second.
	 * @returns attached $node
	 */
	public function insertSort(Node $node, callable $callback): Node;
}
