<?php

namespace Courtier\LinkedList;

class NodeDoublyBasic extends NodeSinglyBasic implements NodeDoubly
{
	/** @var NodeDoubly|null */
	protected $previous;

	/**
	 * @param mixed $value
	 */
	public static function create(
		$value
	) {
		$node = parent::create($value);

		$node->previous = null;

		return $node;
	}

	/**
	 * @inheritDoc
	 */
	public function getPrevious(): ?NodeDoubly
	{
		return $this->previous;
	}

	/**
	 * @inheritDoc
	 */
	public function insertPrevious(NodeDoubly $node): NodeDoubly
	{
		$furtherPrevious = $this->previous;
		if ($furtherPrevious !== null) {
			$furtherPrevious->setNext($node);
		}
		$this->previous = $node;
		$node->setNext($this);
		$node->setPrevious($furtherPrevious);

		return $node;
	}

	/**
	 * @inheritDoc
	 */
	public function removePrevious(): void
	{
		$previous = $this->previous;
		if ($previous === null) {
			return;
		}

		$furtherPrevious = $previous->getPrevious();
		if ($furtherPrevious !== null) {
			$furtherPrevious->setNext($this);
		}
		$this->previous = $furtherPrevious;
		$previous->setNext(null);
		$previous->setPrevious(null);
	}

	/**
	 * @inheritDoc
	 */
	public function setPrevious(?NodeDoubly $node): ?NodeDoubly
	{
		$this->previous = $node;
		return $node;
	}

	/**
	 * @inheritDoc
	 */
	public function setNext(?NodeSingly $node): ?NodeSingly
	{
		if (!($node instanceof NodeDoubly) && $node !== null) {
			trigger_error('Instance of \'' . NodeDoubly::class . '\' was not provided.', E_USER_ERROR);
			return $node;
		}
		return parent::setNext($node);
	}

	/**
	 * @inheritDoc
	 */
	public function insertNext(NodeSingly $node): NodeSingly
	{
		if (!($node instanceof NodeDoubly)) {
			trigger_error('Instance of \'' . NodeDoubly::class . '\' was not provided.', E_USER_ERROR);
			return $node;
		}

		$furtherNext = $this->next;
		$node->setNext($furtherNext);
		$node->setPrevious($this);
		$this->next = $node;
		if ($furtherNext !== null) {
			$furtherNext->setPrevious($node);
		}

		return $node;
	}

	/**
	 * @inheritDoc
	 */
	public function removeNext(): void
	{
		$next = $this->next;
		if ($next === null) {
			return;
		}

		$furtherNext = $next->getNext();
		$this->next = $furtherNext;
		if ($furtherNext !== null) {
			$furtherNext->setPrevious($this);
		}
		$next->setNext(null);
		$next->setPrevious(null);
	}
}
