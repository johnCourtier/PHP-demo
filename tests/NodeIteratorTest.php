<?php

use PHPUnit\Framework\TestCase;

class NodeIteratorTest extends TestCase
{
	/**
	 * @test
	 */
	public function iterator_success()
	{
		$nodeA = \Courtier\LinkedList\NodeSinglyBasic::create('myValueA');
		$nodeB = \Courtier\LinkedList\NodeSinglyBasic::create('myValueB');
		$nodeC = \Courtier\LinkedList\NodeSinglyBasic::create('myValueC');

		$nodeA->insertNext($nodeB)->insertNext($nodeC);

		$iterator = \Courtier\LinkedList\NodeIterator::create($nodeA);

		$this->assertEquals($nodeA, $iterator->current());
		$this->assertEquals(0, $iterator->key());
		$this->assertTrue($iterator->valid());

		$iterator->next();
		$this->assertEquals($nodeB, $iterator->current());
		$this->assertEquals(1, $iterator->key());
		$this->assertTrue($iterator->valid());

		$iterator->next();
		$this->assertEquals($nodeC, $iterator->current());
		$this->assertEquals(2, $iterator->key());
		$this->assertTrue($iterator->valid());

		$iterator->next();
		$this->assertEquals(null, $iterator->current());
		$this->assertEquals(3, $iterator->key());
		$this->assertFalse($iterator->valid());

		$iterator->rewind();
		$this->assertEquals($nodeA, $iterator->current());
		$this->assertEquals(0, $iterator->key());
		$this->assertTrue($iterator->valid());
	}
}
