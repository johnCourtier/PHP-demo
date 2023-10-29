<?php

namespace Courtier\LinkedList;

use Iterator;

class NodeIteratorNonCyclingDecorator implements Iterator
{
	/** @var Iterator */
	protected $originalIterator;

	/** @var array */
	protected $iterationTrace;

	protected function __construct()
	{
		# prevents registering as service
	}

	/**
	 * @param Iterator $originalIterator requires iterator using nodes implementing Entity
	 * @return \static
	 */
	public static function create(Iterator $originalIterator)
	{
		$decorator = new static();

		$decorator->originalIterator = $originalIterator;
		$decorator->iterationTrace = [];

		return $decorator;
	}

	/**
	 * @inheritDoc
	 */
	public function current()
	{
		return $this->originalIterator->current();
	}

	/**
	 * @inheritDoc
	 */
	public function key()
	{
		return $this->originalIterator->key();
	}

	/**
	 * @inheritDoc
	 */
	public function next(): void
	{
		$this->originalIterator->next();
	}

	/**
	 * @inheritDoc
	 */
	public function rewind(): void
	{
		$this->originalIterator->rewind();
		$this->iterationTrace = [];
	}

	/**
	 * @inheritDoc
	 */
	public function valid(): bool
	{
		$valid = $this->originalIterator->valid();
		if (!$valid) {
			return false;
		}
		$currentNode = $this->originalIterator->current();

		$currentNodeId = spl_object_id($currentNode);
		if (array_key_exists($currentNodeId, $this->iterationTrace)) {
			return false;
		}

		$this->iterationTrace[$currentNodeId] = $currentNode;

		return true;
	}
}
