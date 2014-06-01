import sys
import re
import simplejson as js
import json
def func(d):
	a=js.loads(d)
	d={}
	for i in a:
		d[i['tag']]=[]
	for i in d.keys():
		for j in a:
			if j['tag']==i:
				d[i].append(j['token'])
	l=['NN','NN\n','NNP','NNP\n','NNS','NNS\n']
	m=['NNS\n','NNS']
	k=[]
	t=[]
	for i in l:
		if i in d.keys():
			for j in d[i]:
				k.append(j)
	for i in m:
		if i in d.keys():
			for j in d[i]:
				t.append(j)
	print k
	print t
	return k,t
def suggestions(k,m):
	options=[]
	for i in range(len(k)):
		k[i]=k[i].lower()
	fp=open('a.json','r')
	l=fp.read()
	s=js.loads(l)
	for i in s:
		if i in k:
			t=i
	stri=["Places near X","Places near X and within 10 kms","Place near X and having rating more than 5"]
	for i in stri:
		for j in m:
			l=i.replace('Places',j)
			l=l.replace('X',t)
			print "<li class='list1'>"+l+"</li>"
if __name__=="__main__":
	k,m=func(sys.argv[1])
	suggestions(k,m)
	#print k
	#dictofdicts(k)
