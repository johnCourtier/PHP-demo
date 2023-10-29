<?php

namespace Courtier\LinkedList;

interface NodeDoubly extends NodeSingly
{
	public function getPrevious(): ?NodeDoubly;

	public function setPrevious(?NodeDoubly $node): ?NodeDoubly;

	/**
	 * Inserts single node $node, no other linked nodes are used. $node is re-linked
	 * @param Courtier\SortedLinkedList\NodeDoubly $node node with null previous ($node->previous is going to be reassigned based on $this->previous)
	 * @return inserted node
	 */
	public function insertPrevious(NodeDoubly $node): NodeDoubly;

	/**
	 * Re-links nodes, $this->previous is detached
	 * @return void
	 */
	public function removePrevious(): void;
}
