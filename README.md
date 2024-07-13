# Heap Class in PHP

The `Heap` class is an implementation of a Max Heap data structure in PHP. A Heap is a complete binary tree where the value of each node is greater than or equal to the values of its children, which makes it useful for efficiently finding the maximum element.

## Features

- **Heap Construction**: Initialize the heap with an array and build a max heap.
- **Insert**: Add a new element to the heap.
- **Remove**: Remove a specific element from the heap.
- **Sort**: Perform heap sort and return the array sorted in ascending or descending order.

## Installation

Install the `Heap` class via composer:

```bash
composer require affinity4/heap
```

## Usage

Here is an example of how to use the `Heap` class:

```php
<?php

require_once __DIR__ . '/vendor/autoload.php';

use Affinity4\Heap\Heap;

// Initialize the heap with an array
$initialArray = [3, 10, 5, 1, 2, 7];
$heap = new Heap($initialArray);

// Insert a new value
$heap->insert(12);

// Sort the heap
$sortedArray = $heap->sort();
echo "Sorted Array: " . implode(', ', $sortedArray) . "\n";

// Remove a value from the heap
$heap->remove(5);
echo "Heap after removing 5: " . implode(', ', $heap->heap) . "\n";

```

## Tests

Run tests with:

```bash
./vendor/bin/phpunit
```
