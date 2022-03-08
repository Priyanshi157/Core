first_position=-1
last_position=-1
def binary_search(seq,item):
  begin = 0
  end = len(seq) - 1

  while begin <= end:
    midpoint = round(begin + (end - begin) // 2)
   # print(midpoint)
    midvalue = seq[midpoint]
    if midvalue == item1:
      i=midpoint-1
      while midvalue == item1:
        i = i - 1
      first_position = i+1

      j = midpoint+1
      while midvalue ==  item1:
        j = j + 1
      last_position = j-1

    elif item < midvalue: 
      end = midpoint - 1
    else:
      begin = midpoint + 1
  return [-1,-1]

seq = [1,5,7,7,8,8,10]
item1 = 7

print(binary_search(seq,item1))
print(first_position + " " + last_position)