from socket import *

s = socket(AF_INET, SOCK_STREAM)
print("Connecting...")
s.connnect(('192.168.1.101', 32350))
print("Sending...")
s.send(b'\x15\x00\xbc\x02\x0e127.0.0.1\x00FML\x0009\x01'

data = s.recv(1024)
print(data)