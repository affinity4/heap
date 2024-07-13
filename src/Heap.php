<?php declare(strict_types=1);

namespace Affinity4\Heap;

/**
 * Class Heap
 * 
 * Implements a binary heap with a heap sort algorithm.
 * 
 * @package Heap
 */
class Heap
{
    const ASC = 'ascending';
    const DESC = 'descending';

    private array $heap;

    /**
     * Constructor for the Heap class.
     *
     * @param array $array The initial array to initialize the heap with.
     */
    public function __construct($array = [])
    {
        $this->heap = $array;
        $this->buildMaxHeap();
    }

    /**
     * Builds a max heap from the given array.
     *
     * This function iterates over the array in reverse order, starting from the
     * middle index and calls the `heapifyDown` function to ensure that the heap
     * property is maintained.
     *
     * @return void
     */
    private function buildMaxHeap(): void
    {
        for ($i = intval(count($this->heap) / 2) - 1; $i >= 0; $i--) {
            $this->heapifyDown($i, count($this->heap));
        }
    }

    /**
     * Inserts a new value into the heap and performs heapifyUp operation.
     *
     * @param mixed $value The value to be inserted into the heap.
     *
     * @return void
     */
    public function insert($value): void
    {
        $this->heap[] = $value;
        $this->heapifyUp(count($this->heap) - 1);
    }

    /**
     * Removes the specified value from the heap.
     *
     * @param mixed $value The value to be removed from the heap.
     * 
     * @throws \InvalidArgumentException Value not found in heap
     * 
     * @return void
     */
    public function remove($value): void
    {
        $index = array_search($value, $this->heap);
        if ($index === false) {
            throw new \InvalidArgumentException('Value not found in heap');
        }

        if ($index === count($this->heap) - 1) {
            array_pop($this->heap);
        } else {
            $this->swap($index, count($this->heap) - 1);
            array_pop($this->heap);
            $this->heapifyDown($index, count($this->heap));
            $this->heapifyUp($index);
        }
    }

    /**
     * Sorts the heap array in ascending order by default, or in descending order if specified.
     *
     * @param int $order_by The order in which to sort the heap, ASC for ascending, DESC for descending.
     *
     * @return array The sorted heap array.
     */
    public function sort($order_by = Heap::ASC): array
    {
        $heapSize = count($this->heap);

        $this->buildMaxHeap();

        for ($i = $heapSize - 1; $i > 0; $i--) {
            // Swap the root (max element) with the last element in the heap
            $this->swap(0, $i);
            $this->heapifyDown(0, $i);
        }

        if ($order_by === Heap::DESC) {
            // Return sorted array in descending order
            return array_reverse($this->heap);
        }

        return $this->heap;
    }

    /**
     * Retrieves the entire heap array.
     *
     * @return array The entire heap array.
     */
    public function get(): array
    {
        return $this->heap;
    }

    /**
     * Checks if the heap is empty.
     *
     * @return bool Returns true if the heap is empty, false otherwise.
     */
    protected function isEmpty() {
        return count($this->heap) === 0;
    }

    /**
     * Swaps the elements at the specified indices in the heap array.
     *
     * @param int $index1 The index of the first element to swap.
     * @param int $index2 The index of the second element to swap.
     *
     * @return void
     */
    private function swap($index1, $index2): void
    {
        $temp = $this->heap[$index1];
        $this->heap[$index1] = $this->heap[$index2];
        $this->heap[$index2] = $temp;
    }

    /**
     * Heapify the heap upwards starting from a given index.
     *
     * @param int $index The index from which to heapify upwards.
     *
     * @return void
     */
    private function heapifyUp($index): void
    {
        $parentIndex = intval(($index - 1) / 2);
        while ($index > 0 && $this->heap[$index] > $this->heap[$parentIndex]) {
            $this->swap($index, $parentIndex);
            $index = $parentIndex;
            $parentIndex = intval(($index - 1) / 2);
        }
    }

    /**
     * Heapify down the heap starting from a specific index.
     *
     * @param int $index The index from which to heapify down.
     * @param int $heapSize The size of the heap.
     *
     * @return void
     */
    private function heapifyDown($index, $heapSize): void
    {
        $lastIndex = $heapSize - 1;
        while (true) {
            $leftChildIndex = 2 * $index + 1;
            $rightChildIndex = 2 * $index + 2;
            $largestIndex = $index;
            if ($leftChildIndex <= $lastIndex && $this->heap[$leftChildIndex] > $this->heap[$largestIndex]) {
                $largestIndex = $leftChildIndex;
            }

            if ($rightChildIndex <= $lastIndex && $this->heap[$rightChildIndex] > $this->heap[$largestIndex]) {
                $largestIndex = $rightChildIndex;
            }

            if ($largestIndex === $index) {
                break;
            }

            $this->swap($index, $largestIndex);
            $index = $largestIndex;
        }
    }
}
