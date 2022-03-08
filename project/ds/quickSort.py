def partition(array, low, high):
  pivot = array[high]
 # print("pivot : ",pivot)
  i = low  
  j= high - 1
  while i < j:
    while i < high and array[i]< pivot:
      i = i+1
    while j > low and array[j] >= pivot:
      j = j - 1

    if i<j:
      (array[i], array[j]) = (array[j], array[i])
    
  if array[i] > pivot:
    (array[i], array[high]) = (array[high], array[i])

  return i

# function to perform quicksort
def quickSort(array, low, high):
  if low < high:
    pi = partition(array, low, high)
    #for left part
    quickSort(array, low, pi - 1)
    #for right part
    quickSort(array, pi + 1, high)


data = [10, 25, 3, 50, 20, 30, 12, 14, 67, 99]
print("Unsorted Array")
print(data)

size = len(data)
quickSort(data, 0, size - 1)

print('Sorted Array in Ascending Order:')
print(data)
