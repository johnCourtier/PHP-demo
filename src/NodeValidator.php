<?php

namespace Courtier\LinkedList;

interface NodeValidator
{
	/**
	 * @param Node $node
	 * @throws Courtier\SortedLinkedList\Exception when validation fails
	 */
	public function validate(Node $node): void;
}
