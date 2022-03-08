output=[]
def binarySearch(inputedArray, arrayLength, x) :
    firstPosition = -1
    lastPosition = -1
    for i in range(0, arrayLength) :
        if (x != inputedArray[i]) :
            continue
        if (firstPosition == -1) :
            firstPosition = i
        lastPosition = i
    output.append(firstPosition)
    output.append(lastPosition)
    print(output)

inputedArray = [i for i in input("Enter array elements : ").split()]
arrayLength = len(inputedArray)
x = input("Enter Target Value : ")
binarySearch(inputedArray, arrayLength, x)

"""find = []
def binary_search(seq,item):
  begin = 0
  end = len(seq) - 1

  while begin <= end:
    midpoint = round(begin + (end - begin) // 2)
    print(midpoint)
    midvalue = seq[midpoint]

    if midvalue == item:
      find.append(midpoint)
      if midpoint%2 == 1:
        for i in(0,midpoint-1):
          if seq[i] == item:
            find.append(i)
        return find[::-1]
      else:
        for i in (midpoint+1,end):
          if seq[i] == item:
            find.append(i)
        return find

    elif item < midvalue:
      end = midpoint - 1
    else:
      begin = midpoint + 1
  return [-1,-1]

seq = [1,5,7,7,8,8,10]
item1 = 7

print(binary_search(seq,item1))
#print(find)
"""