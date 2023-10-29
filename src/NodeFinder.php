<?php

namespace Courtier\LinkedList;

interface NodeFinder
{
	/**
	 * Returns node from $existingNode. Returns node which should be just before $newNode. Retuns null if $newNode should be the first.
	 */
	public function findPreviousNode(NodeSingly $newNode, NodeSingly $existingNode): ?NodeSingly;
}
