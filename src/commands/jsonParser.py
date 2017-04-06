import json
import sys


data=sys.stdin.read()
print data
s=json.loads(data)
print s[sys.argv[1]]
