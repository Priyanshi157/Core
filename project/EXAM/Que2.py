class Node:
	def __init__(self, data):
		self.data = data
		self.next = None

class LinkedList:

	def __init__(self):
		self.head = None

  #print list
	def printList(self):
		temp = self.head
		
		while temp :
			print(temp.data, end="->")
			temp = temp.next

	def append(self, new_data):
		new_node = Node(new_data)
		
		if self.head is None:
			self.head = new_node
			return
		last = self.head
		
		while last.next:
			last = last.next
		last.next = new_node


# Function to merge two sorted linked list.
def mergeLists(head1, head2):

	# create a temp node NULL
	temp = None

	# List1 is empty then return List2
	if head1 is None:
		return head2

	# if List2 is empty then return List1
	if head2 is None:
		return head1

	if head1.data <= head2.data:
		temp = head1
		temp.next = mergeLists(head1.next, head2)
		
	else:
		temp = head2
		temp.next = mergeLists(head1, head2.next)
	return temp

if __name__ == '__main__':

	# Create linked list 1:
	list1 = LinkedList()
	list1.append(1)
	list1.append(2)
	list1.append(4)
 
	# Create linked list 2 :
	list2 = LinkedList()
	list2.append(1)
	list2.append(3)
	list2.append(4)

	list3 = LinkedList()

	# Merging linked list 1 and linked list 2
	list3.head = mergeLists(list1.head, list2.head)

	print(" Merged Linked List : ", end="")
	list3.printList()	