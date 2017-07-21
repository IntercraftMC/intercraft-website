#!/usr/bin/python3

from mcstatus import MinecraftServer
import json
import sys


def main(argv):
	if len(argv) != 2:
		print("Usage: players_online.py <server-ip>:<server-port>")
		return

	address = argv[1]
	server = MinecraftServer.lookup(argv[1])

	status = server.status()
	if status.players.online > 0:
		print(json.dumps([player.name for player in status.players.sample]))
	else:
		print('[]')
		

if __name__ == '__main__':
	main(sys.argv)
	