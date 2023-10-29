<?php

namespace Courtier\LinkedList;

class NodeSinglyBasic implements NodeSingly
{
	/** @var mixed */
	protected $value;

	/** @var NodeSinglyBasic|null */
	protected $next;

	protected function __construct()
	{
		# prevents registering as service
	}

	/**
	 * @param mixed $value
	 */
	public static function create(
		$value
	) {
		$node = new static();

		$node->value = $value;
		$node->next = null;

		return $node;
	}

	/**
	 * @inheritDoc
	 */
	public function getValue()
	{
		return $this->value;
	}

	/**
	 * @inheritDoc
	 */
	public function setNext(?NodeSingly $node): ?NodeSingly
	{
		$this->next = $node;
		return $node;
	}

	/**
	 * @inheritDoc
	 */
	public function insertNext(NodeSingly $node): NodeSingly
	{
		$node->setNext($this->next);
		$this->next = $node;
		return $node;
	}

	/**
	 * @inheritDoc
	 */
	public function removeNext(): void
	{
		$next = $this->next;
		if ($next !== null) {
			$this->next = $next->getNext();
			$next->setNext(null);
		}
	}

	/**
	 * @inheritDoc
	 */
	public function getNext(): ?NodeSingly
	{
		return $this->next;
	}
}
