from py2neo import cypher,neo4j
from sys import argv
from operator import itemgetter
import json
g=neo4j.GraphDatabaseService()
def liked_posts(user):
	fp=open('photo.json','w')
	s="MATCH (b)-[r:RATES]->(s:Photo)<-[p:WRITES|UPLOADS]-(n) WHERE n.name=""'"+user+"'"" RETURN s.path,sum(r.rate),s.tag"
	a=cypher.execute(g,s)[0]
	a.sort(key=itemgetter(1))
	json.dump(a,fp)
	fp.close()
if __name__=="__main__":
	liked_posts(argv[1]) 
