<?php

namespace Courtier\LinkedList;

interface NodeSingly extends Node
{
	public function getNext(): ?NodeSingly;

	public function setNext(?NodeSingly $node): ?NodeSingly;

	/**
	 * Inserts single node $node, no other linked nodes are used. $node is re-linked
	 * @param Courtier\SortedLinkedList\SinglyNode $node node with null next ($node->next is going to be reassigned based on $this->next)
	 * @return inserted node
	 */
	public function insertNext(NodeSingly $node): NodeSingly;

	/**
	 * Removes link to next node
	 */
	public function removeNext(): void;
}
