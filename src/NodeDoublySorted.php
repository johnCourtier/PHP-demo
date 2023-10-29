<?php

namespace Courtier\LinkedList;

class NodeDoublySorted extends NodeDoublyBasic implements NodeSorted
{
	/**
	 * @inheritDoc
	 */
	public function insertSort(Node $node, callable $callback): Node
	{
		if (!($node instanceof NodeDoubly)) {
			trigger_error('Instance of \'' . NodeDoubly::class . '\' was not provided.', E_USER_ERROR);
			return $node;
		}
		$currentNode = $this;
		$currentValue = $this->value;
		$insertedValue = $node->getValue();

		$currentNodeId = spl_object_id($currentNode);
		$iterationTrace = [$currentNodeId => $currentNode];

		$direction = (call_user_func_array($callback, [$currentValue, $insertedValue]) < 1);
		while (true) {
			$parentNode = $currentNode;
			if ($direction) {
				$currentNode = $currentNode->getNext();
			} else {
				$currentNode = $currentNode->getPrevious();
			}

			if ($currentNode !== null) {
				$currentNodeId = spl_object_id($currentNode);
				if (!array_key_exists($currentNodeId, $iterationTrace)) {
					$iterationTrace[$currentNodeId] = $currentNode;
				} else {
					$direction = (call_user_func_array($callback, [$currentValue, $parentNode->getValue()]) < 1);
					$currentNode = null; # cyclic chain-link break
				}
			}

			if ($currentNode !== null) {
				$currentValue = $currentNode->getValue();
				$newDirection = (call_user_func_array($callback, [$currentValue, $insertedValue]) < 1);
				if ($newDirection === $direction) {
					$newDirection = (call_user_func_array($callback, [$parentNode->getValue(), $currentValue]) < 1); # ensures correct cycle insert
					if ($newDirection === $direction) {
						continue;
					}
				}
			}

			if ($direction) {
				$parentNode->insertNext($node);
				return $node;
			}

			$parentNode->insertPrevious($node);
			return $node;
		}
	}
}
