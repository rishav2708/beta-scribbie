import urllib2
import re
import simplejson as js
import urllib
file=open('f.html','r')
l=file.read()
m=re.findall('facebook.com/[a-zA-Z0-9]+.[a-zA-Z0-9]+.[a-zA-Z0-9]+.[a-zA-Z0-9]+',l)
t=[]
for i in m:
	k=i.split('/')
	t.append(k[1])
if __name__=="__main__":

	for i in t:
		try:
			url='http://graph.facebook.com/'+i
			s=js.load(urllib.urlopen(url).read())
			print s 
			url='http://graph.facebook.com/'+i+'/picture?type=large'
			l=urllib2.urlopen(url).geturl()
			print "<img src="+l+" />"
		except:
			continue
		
