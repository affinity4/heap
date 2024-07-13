<?php declare(strict_types=1);

namespace Affinity4\Heap\Tests;

use Affinity4\Heap\Heap;
use PHPUnit\Framework\TestCase;

class MaxHeapTest extends TestCase
{
    private $heap;

    protected function setUp(): void
    {
        $initialArray = [3, 10, 5, 1, 2, 7];
        $this->heap = new Heap($initialArray);
    }

    public function testHeapConstruction()
    {
        $expectedHeap = [10, 3, 7, 1, 2, 5];
        $this->assertSame($expectedHeap, $this->heap->get());
    }

    public function testInsert()
    {
        $this->heap->insert(12);
        $expectedHeap = [12, 3, 10, 1, 2, 5, 7];
        $actual = $this->heap->get();
        $this->assertSame($expectedHeap, $actual);
    }

    public function testSort()
    {
        $sortedArray = $this->heap->sort();
        $expectedSortedArray = [1, 2, 3, 5, 7, 10];
        $this->assertSame($expectedSortedArray, $sortedArray);
    }

    public function testRemove()
    {
        $this->heap->remove(5);
        $expectedHeapAfterRemoval = [10, 3, 7, 1, 2];
        $this->assertSame($expectedHeapAfterRemoval, $this->heap->get());

        // Remove root and verify
        $this->heap->remove(10);
        $expectedHeapAfterRemoval = [7, 3, 2, 1];
        $this->assertSame($expectedHeapAfterRemoval, $this->heap->get());
    }

    public function testIsEmpty()
    {
        $emptyHeap = new Heap();
        $this->assertTrue(count($emptyHeap->get()) === 0);

        $emptyHeap->insert(1);
        $this->assertFalse(count($emptyHeap->get()) === 0);
    }

    public function testSortOfBigArray()
    {
        $heap = new Heap(include __DIR__ . '/data/big-array.php');
        $this->assertSame(include __DIR__ . '/data/big-array-sorted.php', $heap->sort());
    }
}
