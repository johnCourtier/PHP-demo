<?php

use PHPUnit\Framework\TestCase;

class NodeDoublySortedTest extends TestCase
{
	/**
	 * @test
	 */
	public function insertSort_sameValues_success()
	{
		$expectedOrder = ['valueA', 'valueA', 'valueA', 'valueA'];
		$nodeA = \Courtier\LinkedList\NodeDoublySorted::create('valueA');
		$nodeB = \Courtier\LinkedList\NodeDoublySorted::create('valueA');
		$nodeC = \Courtier\LinkedList\NodeDoublySorted::create('valueA');
		$nodeD = \Courtier\LinkedList\NodeDoublySorted::create('valueA');

		$alphabetSort = function($valueA, $valueB) {
			return $valueA <= $valueB ? -1 : 1;
		};

		$nodeA->insertSort($nodeB, $alphabetSort)
			->insertSort($nodeC, $alphabetSort)
			->insertSort($nodeD, $alphabetSort);

		$iterator = \Courtier\LinkedList\NodeIterator::create($nodeA);
		$actualOrder = [];
		foreach ($iterator as $node) {
			$actualOrder[] = $node->getValue();
		}

		$this->assertEquals($expectedOrder, $actualOrder);
	}

	public function insertSort_linear_success_dataProvider()
	{
		return [
			'sorted array' => [
				'myValueA',
				'myValueB',
				'myValueC',
				'myValueD',
				['myValueA', 'myValueB', 'myValueC', 'myValueD']
			],
			'backwards sorted array' => [
				'myValueD',
				'myValueC',
				'myValueB',
				'myValueA',
				['myValueA', 'myValueB', 'myValueC', 'myValueD']
			],
			'unsorted string array' => [
				'myValueC',
				'myValueA',
				'myValueD',
				'myValueB',
				['myValueA', 'myValueB', 'myValueC', 'myValueD']
			],
			'unsorted int array' => [
				1,
				4,
				3,
				2,
				[1, 2, 3, 4]
			]
		];
	}

	/**
	 * @test
	 * @dataProvider insertSort_linear_success_dataProvider
	 */
	public function insertSort_linear_success($valueA, $valueB, $valueC, $valueD, $expectedOrder)
	{
		$nodeA = \Courtier\LinkedList\NodeDoublySorted::create($valueA);
		$nodeB = \Courtier\LinkedList\NodeDoublySorted::create($valueB);
		$nodeC = \Courtier\LinkedList\NodeDoublySorted::create($valueC);
		$nodeD = \Courtier\LinkedList\NodeDoublySorted::create($valueD);

		$alphabetSort = function($valueA, $valueB) {
			return $valueA <= $valueB ? -1 : 1;
		};

		$nodeA->insertSort($nodeB, $alphabetSort)
			->insertSort($nodeC, $alphabetSort)
			->insertSort($nodeD, $alphabetSort);

		$nodes = [
			$nodeA->getValue() => $nodeA,
			$nodeB->getValue() => $nodeB,
			$nodeC->getValue() => $nodeC,
			$nodeD->getValue() => $nodeD,
		];
		ksort($nodes);
		$firstNode = reset($nodes);
		$this->assertEquals(reset($expectedOrder), $firstNode->getValue());

		$iterator = \Courtier\LinkedList\NodeIterator::create($firstNode);
		$actualOrder = [];
		foreach ($iterator as $node) {
			$actualOrder[] = $node->getValue();
		}

		$this->assertEquals($expectedOrder, $actualOrder);
	}

	public function insertSort_cyclic_success_dataProvider()
	{
		return [
			'same values' => [
				'myValueA',
				'myValueA',
				'myValueA',
				'myValueA',
				['myValueA', 'myValueA', 'myValueA', 'myValueA']
			],
			'sorted array' => [
				'myValueA',
				'myValueB',
				'myValueC',
				'myValueD',
				['myValueA', 'myValueB', 'myValueC', 'myValueD']
			],
			'backwards sorted array' => [
				'myValueD',
				'myValueC',
				'myValueB',
				'myValueA',
				['myValueA', 'myValueB', 'myValueC', 'myValueD']
			],
			'unsorted array' => [
				'myValueC',
				'myValueA',
				'myValueD',
				'myValueB',
				['myValueA', 'myValueB', 'myValueC', 'myValueD']
			],
			'unsorted int array' => [
				2,
				4,
				3,
				1,
				[1, 2, 3, 4]
			]
		];
	}

	/**
	 * @test
	 * @dataProvider insertSort_cyclic_success_dataProvider
	 */
	public function insertSort_cyclic_success($valueA, $valueB, $valueC, $valueD, $expectedOrder)
	{
		$nodeA = \Courtier\LinkedList\NodeDoublySorted::create($valueA);
		$nodeB = \Courtier\LinkedList\NodeDoublySorted::create($valueB);
		$nodeC = \Courtier\LinkedList\NodeDoublySorted::create($valueC);
		$nodeD = \Courtier\LinkedList\NodeDoublySorted::create($valueD);

		$alphabetSort = function($valueA, $valueB) {
			return $valueA <= $valueB ? -1 : 1;
		};

		$nodeA->insertNext($nodeA); # creates cycle
		$nodeA->insertSort($nodeB, $alphabetSort)
			->insertSort($nodeC, $alphabetSort)
			->insertSort($nodeD, $alphabetSort);

		$nodes = [
			$nodeA->getValue() => $nodeA,
			$nodeB->getValue() => $nodeB,
			$nodeC->getValue() => $nodeC,
			$nodeD->getValue() => $nodeD,
		];
		ksort($nodes);
		$firstNode = reset($nodes);
		$this->assertEquals(reset($expectedOrder), $firstNode->getValue());

		$iterator = Courtier\LinkedList\NodeIteratorNonCyclingDecorator::create(
			\Courtier\LinkedList\NodeIterator::create($firstNode)
		);
		$actualOrder = [];
		foreach ($iterator as $node) {
			$actualOrder[] = $node->getValue();
		}

		$this->assertEquals($expectedOrder, $actualOrder);
	}
}
