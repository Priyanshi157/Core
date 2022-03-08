import json
f=open('test_data.json')
data=json.loads(f.read())

eId = input("Enter an id : ")
def getPath(eId):
    test=''
    for i in data:
        if i["entity_id"]==eId:
            test=test+eId
            getPath(i['parent_id'])
            print(test,end="/")
            

getPath(eId)