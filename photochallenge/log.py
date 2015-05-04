import sys

stuff = sys.argv
p = open("LOGFILE","r").read()
open('LOGFILE','w').write(p+"\n"+stuff[1])