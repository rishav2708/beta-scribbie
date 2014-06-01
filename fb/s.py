import os
if __name__=="__main__":
	s='espeak "hello" --stdout|paplay'
	os.system(s)
