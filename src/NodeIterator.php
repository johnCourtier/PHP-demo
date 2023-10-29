<?php

namespace Courtier\LinkedList;

use Iterator;

class NodeIterator implements Iterator
{
	/** @var int */
	protected $index;

	/** @var NodeSingly */
	protected $currentNode;

	/** @var NodeSingly */
	protected $first;

	protected function __construct()
	{
		# prevents registering as service
	}

	/**
	 * @param \Courtier\SortedLinkedList\SinglyNode $node first node of iteration
	 * @return \static
	 */
	public static function create(NodeSingly $node)
	{
		$iterator = new static();

		$iterator->index = 0;
		$iterator->currentNode = $node;
		$iterator->first = $node;

		return $iterator;
	}

	/**
	 * @inheritDoc
	 */
	public function current()
	{
		return $this->currentNode;
	}

	/**
	 * @inheritDoc
	 */
	public function key()
	{
		return $this->index;
	}

	/**
	 * @inheritDoc
	 */
	public function next(): void
	{
		$next = $this->currentNode->getNext();
		$this->currentNode = $next;
		$this->index++;
	}

	/**
	 * @inheritDoc
	 */
	public function rewind(): void
	{
		$this->currentNode = $this->first;
		$this->index = 0;
	}

	/**
	 * @inheritDoc
	 */
	public function valid(): bool
	{
		return $this->currentNode !== null;
	}
}
