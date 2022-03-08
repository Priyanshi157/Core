#Que1 : Use Recursion technique to reverse linked list.

class Node:
	def __init__(self, data):
		self.data = data
		self.next = None
    
class LinkedList:
  def __init__(self):
    self.head = None

    #reverse function
  def reverse(self,head):
    if head is None or head.next is None:
      return head

    others = self.reverse(head.next)

    head.next.next = head
    head.next=None

    return others

  #display linked list
  def __str__(self):
    list1 = ""
    temp = self.head
    while temp:
      list1 = list1 + str(temp.data)+" "
      temp = temp.next
    return list1

  def push(self,data):
    temp=Node(data)
    temp.next = self.head
    self.head = temp


linkedList = LinkedList()
linkedList.push(5)
linkedList.push(4)
linkedList.push(3)
linkedList.push(2)
linkedList.push(1)

print("Given list : ")
print(linkedList)

linkedList.head = linkedList.reverse(linkedList.head)

print("Reversed List : ")
print(linkedList)