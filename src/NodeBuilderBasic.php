<?php

namespace Courtier\LinkedList;

class NodeBuilderBasic implements NodeBuilder
{
	/** @var NodeValidator */
	protected $nodeValidator;

	/** @var NodeFinder */
	protected $nodeFinder;

	public function __construct(
		NodeValidator $nodeValidator,
		NodeFinder $nodeFinder
	) {
		$this->nodeValidator = $nodeValidator;
		$this->nodeFinder = $nodeFinder;
	}

	/**
	 * @param \Courtier\LinkedList\NodeSingly $newNode
	 * @param \Courtier\LinkedList\NodeSingly $existingNode
	 * @return \Courtier\LinkedList\NodeSingly $newNode now inserted into same chain as $existingNode
	 * @throws InvalidValueException
	 */
	public function insert(NodeSingly $newNode, NodeSingly $existingNode)
	{
		try {
			$this->nodeValidator->validate($newNode);
		} catch (Exception $exception) {
			throw new InvalidValueException('Invalid node was provided.', InvalidValueException::CODE_INVALID_VALIDATION, $exception);
		}

		$previousNode = $this->nodeFinder->findPreviousNode($newNode, $existingNode);
		if ($previousNode === null) {
			$newNode->insertNext($existingNode);
		} else {
			$previousNode->insertNext($newNode);
		}

		return $newNode;
	}
}
