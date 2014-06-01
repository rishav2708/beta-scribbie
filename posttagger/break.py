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
	k=[]
	for i in l:
		if i in d.keys():
			for j in d[i]:
				k.append(j)
	return k
def dictofdicts(m):
	t=[]
	d={}
	l=['chennai','delhi','patna','bhiwani']
	for i in m:
		if i in l:
			t.append(i) #search first for places
			m.remove(i)#remove the places from list
	for i in m:
		t.append(i)
	print t
	for i in l:
		d[i]={}
	k=['schools','restaurants','hotels']
	for i in l:
		for j in k:
			d[i][j]={}
	d['chennai']['restaurants']={}
	d['chennai']['restaurants']['high_prof']=['bbq','sigdi','ccd']
	d['chennai']['restaurants']['low_prof']=['annasalai','abcd','xyz']
	d['delhi']['schools']={}
	d['delhi']['schools']['high']=['dps rkpuram','dps vasantkunj','modern school']
	d['delhi']['schools']['low']=['lps','kalka public','jj public school']
	d['chennai']['schools']={}
	d['chennai']['schools']['high']=['anna univ','dps','loyla']
	d['chennai']['schools']['low']=['abc','xyz','efg']
	for i in range(len(t)-1):
		for j in range(i+1,len(t)):
			try:
				print d[t[i]][t[j]]
			except:
				continue
	
if __name__=="__main__":
	k=func(sys.argv[1])
	print k
	#dictofdicts(k)
