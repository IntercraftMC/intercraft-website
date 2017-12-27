#!/bin/bash

if [ -d $1 ]; then # If directory
	sudo chmod 4777 $1
	echo "Setting permissions... $1"
elif [ -f $1 ]; then # If file
	sudo chmod 777 $1
else
	echo "$1 is invalid"
	exit 1
fi
