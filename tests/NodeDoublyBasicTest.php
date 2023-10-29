<?php

use PHPUnit\Framework\TestCase;

class NodeDoublyBasicTest extends TestCase
{
	/**
	 * @test
	 */
	public function setNext_invalidInstance()
	{
		$nodeA = \Courtier\LinkedList\NodeDoublyBasic::create('myValueA');
		$nodeB = \Courtier\LinkedList\NodeSinglyBasic::create('myValueB');

		try {
			$nodeA->setNext($nodeB);
			$this->fail('Expected exception was not thrown.');
		} catch (\PHPUnit\Framework\Error\Error $exception) {
			$this->assertEquals('Instance of \'' . \Courtier\LinkedList\NodeDoubly::class . '\' was not provided.', $exception->getMessage());
		}
	}

	/**
	 * @test
	 */
	public function setNext_success()
	{
		$nodeA = \Courtier\LinkedList\NodeDoublyBasic::create('myValueA');
		$nodeB = \Courtier\LinkedList\NodeDoublyBasic::create('myValueB');
		$nodeC = \Courtier\LinkedList\NodeDoublyBasic::create('myValueC');

		$nodeC->setNext($nodeA);
		$nodeA->setNext($nodeB)->setNext($nodeC);

		$this->assertEquals($nodeA, $nodeC->getNext());
		$this->assertEquals($nodeB, $nodeA->getNext());
		$this->assertEquals($nodeC, $nodeB->getNext());

		$this->assertNull($nodeC->getPrevious());
		$this->assertNull($nodeA->getPrevious());
		$this->assertNull($nodeB->getPrevious());
	}

	/**
	 * @test
	 */
	public function insertNext_invalidNodeOnInput()
	{
		$nodeA = \Courtier\LinkedList\NodeDoublyBasic::create('myValueA');
		$nodeB = \Courtier\LinkedList\NodeSinglyBasic::create('myValueB');

		try {
			$nodeA->insertNext($nodeB);
			$this->fail('Expected exception was not thrown.');
		} catch (\PHPUnit\Framework\Error\Error $exception) {
			$this->assertEquals('Instance of \'' . \Courtier\LinkedList\NodeDoubly::class . '\' was not provided.', $exception->getMessage());
		}
	}

	/**
	 * @test
	 */
	public function insertNext_success()
	{
		$nodeA = \Courtier\LinkedList\NodeDoublyBasic::create('myValueA');
		$nodeB = \Courtier\LinkedList\NodeDoublyBasic::create('myValueB');
		$nodeC = \Courtier\LinkedList\NodeDoublyBasic::create('myValueC');

		$nodeA->insertNext($nodeC);
		$this->assertEquals($nodeC, $nodeA->getNext());
		$this->assertNull($nodeA->getPrevious());

		$this->assertNull($nodeC->getNext());
		$this->assertEquals($nodeA, $nodeC->getPrevious());

		$nodeA->insertNext($nodeB);
		$this->assertEquals($nodeC, $nodeB->getNext());
		$this->assertEquals($nodeA, $nodeB->getPrevious());

		$this->assertEquals($nodeB, $nodeA->getNext());
		$this->assertNull($nodeA->getPrevious());

		$this->assertNull($nodeC->getNext());
		$this->assertEquals($nodeB, $nodeC->getPrevious());
	}

	/**
	 * @test
	 */
	public function removeNext_success()
	{
		$nodeA = \Courtier\LinkedList\NodeDoublyBasic::create('myValueA');
		$nodeB = \Courtier\LinkedList\NodeDoublyBasic::create('myValueB');
		$nodeC = \Courtier\LinkedList\NodeDoublyBasic::create('myValueC');

		$nodeA->insertNext($nodeC);
		$nodeA->insertNext($nodeB);
		$nodeA->removeNext();

		$this->assertEquals($nodeC, $nodeA->getNext());
		$this->assertNull($nodeA->getPrevious());

		$this->assertNull($nodeC->getNext());
		$this->assertEquals($nodeA, $nodeC->getPrevious());

		$this->assertNull($nodeB->getNext());
		$this->assertNull($nodeB->getPrevious());
	}

	/**
	 * @test
	 */
	public function getPrevious_success()
	{
		$nodeA = \Courtier\LinkedList\NodeDoublyBasic::create('myValueA');
		$nodeB = \Courtier\LinkedList\NodeDoublyBasic::create('myValueB');

		$nodeA->insertNext($nodeB);
		$this->assertEquals($nodeA, $nodeB->getPrevious());
	}

	/**
	 * @test
	 */
	public function insertPrevious_success()
	{
		$nodeA = \Courtier\LinkedList\NodeDoublyBasic::create('myValueA');
		$nodeB = \Courtier\LinkedList\NodeDoublyBasic::create('myValueB');
		$nodeC = \Courtier\LinkedList\NodeDoublyBasic::create('myValueC');

		$nodeC->insertPrevious($nodeA);
		$this->assertNull($nodeA->getPrevious());
		$this->assertEquals($nodeC, $nodeA->getNext());

		$this->assertNull($nodeC->getNext());
		$this->assertEquals($nodeA, $nodeC->getPrevious());

		$nodeC->insertPrevious($nodeB);
		$this->assertNull($nodeA->getPrevious());
		$this->assertEquals($nodeB, $nodeA->getNext());

		$this->assertEquals($nodeA, $nodeB->getPrevious());
		$this->assertEquals($nodeC, $nodeB->getNext());

		$this->assertNull($nodeC->getNext());
		$this->assertEquals($nodeB, $nodeC->getPrevious());
	}

	/**
	 * @test
	 */
	public function removePrevious_success()
	{
		$nodeA = \Courtier\LinkedList\NodeDoublyBasic::create('myValueA');
		$nodeB = \Courtier\LinkedList\NodeDoublyBasic::create('myValueB');
		$nodeC = \Courtier\LinkedList\NodeDoublyBasic::create('myValueC');

		$nodeC->insertPrevious($nodeA);
		$nodeC->insertPrevious($nodeB);
		$nodeC->removePrevious();

		$this->assertNull($nodeA->getPrevious());
		$this->assertEquals($nodeC, $nodeA->getNext());

		$this->assertNull($nodeC->getNext());
		$this->assertEquals($nodeA, $nodeC->getPrevious());
	}

	/**
	 * @test
	 */
	public function setPrevious_success()
	{
		$nodeA = \Courtier\LinkedList\NodeDoublyBasic::create('myValueA');
		$nodeB = \Courtier\LinkedList\NodeDoublyBasic::create('myValueB');

		$nodeA->setPrevious($nodeB);
		$nodeB->setPrevious($nodeA);
		$this->assertEquals($nodeB, $nodeA->getPrevious());
		$this->assertEquals($nodeA, $nodeB->getPrevious());

		$nodeA->setPrevious(null);
		$this->assertNull($nodeA->getPrevious());
	}
}
