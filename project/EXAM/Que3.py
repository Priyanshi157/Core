class Node:
    def __init__(self, data):
        self.data = data
        self.left = None
        self.right = None

def findNodes(node):
  if node is None:
    return False
  if node.left is None and node.right is None:
    return True
  return False

def sumOfLeftNodes(root):
  sum = 0
  if root is not None:
    if findNodes(root.left):
      sum = sum + root.left.data

    else:
      sum = sum + sumOfLeftNodes(root.left)

    sum = sum + sumOfLeftNodes(root.right)
  return sum



root = Node(3)
root.left = Node(9)
root.right = Node(20)
root.right.left = Node(15)
root.right.right = Node(7)

print("Sum of all left nodes is : ",sumOfLeftNodes(root))