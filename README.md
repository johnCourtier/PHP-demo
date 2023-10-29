# About requirement
Implement a library providing SortedLinkedList
(linked list that keeps values sorted). It should be
able to hold string or int values, but not both.

# Use
Make sure to use proper class for your usecase

## Nodes
Nodes are value objects and must not contain extensive business logic.

### NodeSinglyBasic
Basic NodeSingly implementation allows one-way processing. Class supports cyclic reference.

### NodeDoublyBasic
Basic NodeDoubly implementation allows two-way processing. Class supports cyclic reference.

### NodeDoublySorted
NodeDoubly implementation allows two-way processing. Class supports cyclic reference. Class allows dynamic inserts and keeps data sorted. Sorting algorithm is based on comparison method provided upon inserting.
This class exists only to fulfill the original requirement of library. Node should not contain a sorting algorithm. There should be a service responsible for expanding the list.

## Iterators

### NodeIterator
A simple iterator for easy processing of nodes. Does not detect cycles!

### NodeIteratorNonCyclingDecorator
A decorator which stops at cycle detection.

## Builder

### NodeBuilder
A builder allowing to insert node into existing node chain. NodeBuilder uses NodeValidator to validate node being inserted first. NodeBuilder uses NodeFinder to find position for inserting new node.
Algorithm for validation and finding right position is not provided in this library.

# Known issues
- NodeDoublySorted should not contain insert-sorting algorithm (and not even optimal one). Node is not fit for such task - NodeBuilder service is a better option.
- github build pipeline executing tests not established