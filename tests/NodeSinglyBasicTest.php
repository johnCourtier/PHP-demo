<?php

use PHPUnit\Framework\TestCase;

class NodeSinglyBasicTest extends TestCase
{
	/**
	 * @test
	 */
	public function getValue_success()
	{
		$expectedValue = 'myValue';
		$node = \Courtier\LinkedList\NodeSinglyBasic::create($expectedValue);
		$actualValue = $node->getValue();

		$this->assertEquals($expectedValue, $actualValue);
	}

	/**
	 * @test
	 */
	public function setNext_success()
	{
		$nodeA = \Courtier\LinkedList\NodeSinglyBasic::create('myValueA');
		$nodeB = \Courtier\LinkedList\NodeSinglyBasic::create('myValueB');
		$nodeC = \Courtier\LinkedList\NodeSinglyBasic::create('myValueC');

		$nodeC->setNext($nodeA);
		$this->assertNull($nodeA->getNext());

		$nodeA->setNext($nodeB)->setNext($nodeC);

		$this->assertEquals($nodeA, $nodeC->getNext());
		$this->assertEquals($nodeB, $nodeA->getNext());
		$this->assertEquals($nodeC, $nodeB->getNext());

		$nodeA->setNext(null);
		$this->assertNull($nodeA->getNext());
	}

	/**
	 * @test
	 */
	public function insertNext_success()
	{
		$nodeA = \Courtier\LinkedList\NodeSinglyBasic::create('myValueA');
		$nodeB = \Courtier\LinkedList\NodeSinglyBasic::create('myValueB');
		$nodeC = \Courtier\LinkedList\NodeSinglyBasic::create('myValueC');

		$nodeA->setNext($nodeC);
		$nodeA->insertNext($nodeB);

		$this->assertEquals($nodeB, $nodeA->getNext());
		$this->assertEquals($nodeC, $nodeB->getNext());
		$this->assertNull($nodeC->getNext());
	}

	/**
	 * @test
	 */
	public function removeNext_success()
	{
		$nodeA = \Courtier\LinkedList\NodeSinglyBasic::create('myValueA');
		$nodeB = \Courtier\LinkedList\NodeSinglyBasic::create('myValueB');
		$nodeC = \Courtier\LinkedList\NodeSinglyBasic::create('myValueC');

		$nodeC->setNext($nodeA);
		$nodeA->setNext($nodeB)->setNext($nodeC);

		$nodeA->removeNext();
		$this->assertEquals($nodeC, $nodeA->getNext());
		$this->assertNull($nodeB->getNext());
	}
}
