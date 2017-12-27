#!/bin/sh

if [ $# -lt 2 ]; then
	echo "Usage: create_user <username> <password>"
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

sudo mkdir -p /home/intercraftusers/$1/Creative/OpenComputers
sudo mkdir -p /home/intercraftusers/$1/Survival/OpenComputers

sudo chown root:$1 -R /home/intercraftusers/$1/*
sudo chmod 755 -R /home/intercraftusers/$1/*

echo 1
