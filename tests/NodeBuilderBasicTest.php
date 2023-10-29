<?php

use Courtier\LinkedList\InvalidValueException;
use Courtier\LinkedList\NodeBuilderBasic;
use Courtier\LinkedList\NodeFinder;
use Courtier\LinkedList\NodeSinglyBasic;
use Courtier\LinkedList\NodeValidator;
use PHPUnit\Framework\TestCase;

class NodeBuilderBasicTest extends TestCase
{
	/** @var NodeBuilderBasic */
	protected $nodeBuilderBasic;

	/** @var NodeValidator|Mockery\Mock */
	protected $nodeValidator;

	/** @var NodeFinder|Mockery\Mock */
	protected $nodeFinder;

	public function setUp(): void
	{
		parent::setUp();

		$this->nodeValidator = Mockery::mock(NodeValidator::class);
		$this->nodeFinder = Mockery::mock(NodeFinder::class);
		$this->nodeBuilderBasic = new NodeBuilderBasic(
			$this->nodeValidator,
			$this->nodeFinder
		);
	}

	/**
	 * @test
	 */
	public function insert_validationFailure()
	{
		$newNode = NodeSinglyBasic::create('A');
		$existingNode = NodeSinglyBasic::create('B');
		$this->nodeValidator->shouldReceive('validate')->andThrow(new InvalidValueException('mocked exception'));

		try {
			$this->nodeBuilderBasic->insert($newNode, $existingNode);
			$this->fail('Expected exception was not thrown.');
		} catch (InvalidValueException $exception) {
			$this->assertEquals('Invalid node was provided.', $exception->getMessage());
		}
	}

	/**
	 * @test
	 */
	public function createNodeChain_success()
	{
		$newNode = NodeSinglyBasic::create('A');
		$existingNode = NodeSinglyBasic::create('B');

		$this->nodeValidator->shouldReceive('validate')->with($newNode)->once();
		$this->nodeFinder->shouldReceive('findPreviousNode')->with($newNode, $existingNode)->once()->andReturn($existingNode);
		$linkedNode = $this->nodeBuilderBasic->insert($newNode, $existingNode);

		$this->assertEquals($existingNode->getNext(), $linkedNode);
	}

	public function tearDown(): void
	{
		parent::tearDown();
	}
}
