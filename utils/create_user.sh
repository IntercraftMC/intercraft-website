#!/bin/sh

if [ $# -eq 0 ]; then
	echo "Usage: create_user <username>"
	exit
fi

if [ ! -d "/home/intercraftusers/$1" ]; then
	mkdir /home/intercraftusers/$1
fi

# create user
sudo useradd $1 -d /home/intercraftusers/$1

# prevent ssh login & assign SFTP group
sudo usermod -g sftponly $1
sudo usermod -s /bin/nologin $1
sudo usermod --password $2 $1

# chroot user (so they only see their directory after login)
sudo chown root:$1 /home/intercraftusers/$1
sudo chmod 755 /home/intercraftusers/$1

sudo mkdir /home/intercraftusers/$1/OpenComputers
sudo mkdir /home/intercraftusers/$1/Schematics
sudo chown $1:$1 /home/intercraftusers/$1/*
sudo chmod 755 /home/intercraftusers/$1/*

echo 1
