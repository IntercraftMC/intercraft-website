#!/usr/bin/python3

import argparse
import base64
import json
import MySQLdb
import os
import pgmagick as PythonMagick
import requests
import sys

API_RESOLVE_NAME = 'https://api.mojang.com/users/profiles/minecraft/{}'
API_SKIN = 'https://sessionserver.mojang.com/session/minecraft/profile/{}'

SCRIPT_LOCATION = os.path.dirname(os.path.realpath(__file__))
FOLDER_SKINS = SCRIPT_LOCATION + '/../public/assets/skins/'
FILE_SKIN = FOLDER_SKINS + '{}.png'
FILE_FACE = FOLDER_SKINS + '{}_face.png'
FILE_CONFIG = SCRIPT_LOCATION + '/../config/config.json'


def resolve_name(name):
    resp = requests.get(API_RESOLVE_NAME.format(name))
    return resp.json()['id']


def get_skin_url(uuid):
    # First, get the link, which is stored in a base64-encoded JSON
    # object within another JSON object. Why? Because Mojang.
    try:
        resp = requests.get(API_SKIN.format(uuid))
    except ConnectionError:
        print('Failed to connect to {}'.format(API_SKIN.format(uuid)))
        return

    if resp.status_code != 200:
        print('Error from Mojang API. Reason:')
        print(json.dumps(resp.json(), sort_keys=True, indent=4))
        return

    return json.loads(base64.b64decode(resp.json()['properties'][0]['value']).decode())['textures']['SKIN']['url']


def save_skin(url, uuid):
    # Now download and save file.
    if not(os.path.exists(FOLDER_SKINS)):
        os.mkdir(FOLDER_SKINS)

    try:
        resp = requests.get(url)
    except ConnectionError:
        print('Failed to connect to {}'.format(url))
        return

    if resp.status_code != 200:
        print('Error from Mojang textures server. Reason:')
        print(resp.text)
        return

    with open(FILE_SKIN.format(uuid), 'wb') as f:
        f.write(resp.content)


def scale_face(uuid):
    skin = PythonMagick.Image(FILE_SKIN.format(uuid))
    skin.crop('8x8+8+8')
    skin.scale('128x128')
    skin.write(FILE_FACE.format(uuid))


def process_uuid(uuid):
    url = get_skin_url(uuid)
    if url != None:
        save_skin(url, uuid)
    scale_face(uuid)


def get_all_uuids():
    try:
        with open(FILE_CONFIG) as f:
            db_login = json.load(f)['database']
    except OSError:
        print('Please add and configure a database in config.json.')
        sys.exit(1)

    db = MySQLdb.connect(host=db_login['host'],
                         user=db_login['username'],
                         passwd=db_login['password'],
                         db=db_login['database'])
    cur = db.cursor()
    cur.execute('SELECT uuid FROM users')
    return [i[0] for i in cur.fetchall()]


def main():
    parser = argparse.ArgumentParser(description='Download and crop a skin.',
                                     epilog='''If no UUID or name is specified,
                                     this will update the skins for all users
                                     in the database, login details in
                                     config.json.''')
    parse_group_user = parser.add_mutually_exclusive_group()
    parse_group_user.add_argument('--uuid', '-u',
                                  help='UUID of user to update skin.')
    parse_group_user.add_argument('--name', '-n',
                                  help='Username of user to update.')
    args = parser.parse_args()

    if args.name != None:
        uuid = resolve_name(args.name)
    elif args.uuid != None:
        uuid = args.uuid
    else:
        uuid = None

    if uuid == None:
        uuids = get_all_uuids()
        for id in uuids:
            process_uuid(id)
    else:
        process_uuid(uuid)


if __name__ == '__main__':
    main()
