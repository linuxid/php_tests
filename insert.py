import sys

file=sys.argv[1]
f = open(file, "r")
contents = f.readlines()
counter=0
for line in contents:
    if line=="\n":
        #print (contents[counter])
        #contents.insert(counter,"($)\n")
        contents[counter]="(0)\n"
    counter+=1
f.close()
# for line in contents:
#     print(line)
contents.append("(0)")
f = open("mcq.txt", "w")
for line in contents:
    f.write(line)