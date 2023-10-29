<?php

namespace Courtier\LinkedList;

interface NodeBuilder
{
	/**
	 * @param \Courtier\LinkedList\NodeSingly $newNode
	 * @param \Courtier\LinkedList\NodeSingly $existingNode
	 * @throws InvalidValueException
	 */
	public function insert(NodeSingly $newNode, NodeSingly $existingNode);
}
