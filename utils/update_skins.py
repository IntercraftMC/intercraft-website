import argparse
import base64
import json
import MySQLdb
import os
import PythonMagick
import requests

API_RESOLVE_NAME = 'https://api.mojang.com/users/profiles/minecraft/{}'
API_SKIN = 'https://sessionserver.mojang.com/session/minecraft/profile/{}'

SCRIPT_LOCATION = os.path.dirname(__file__)
FOLDER_SKINS = SCRIPT_LOCATION + '/../public/assets/skins/'
FILE_SKIN = FOLDER_SKINS + '{}.png'
FILE_FACE = FOLDER_SKINS + '{}_face.png'
FILE_CONFIG = SCRIPT_LOCATION + '/../config.json'


def resolve_name(name):
    resp = requests.get(API_RESOLVE_NAME.format(name))
    return resp.json()['id']


def get_texture(uuid):
    # First, get the link, which is stored in a base64-encoded JSON
    # object within another JSON object. Why? Because Mojang.
    resp = requests.get(API_SKIN.format(uuid))
    url = json.loads(base64.b64decode(resp.json()['properties'][0]['value']).decode())['textures']['SKIN']['url']

    # Now download and save file.
    if not(os.path.exists(FOLDER_SKINS)):
        os.mkdir(FOLDER_SKINS)
    skin_resp = requests.get(url)
    with open(FILE_SKIN.format(uuid), 'wb') as f:
        f.write(skin_resp.content)


def scale_face(uuid):
    skin = PythonMagick.Image(FILE_SKIN.format(uuid))
    skin.crop('8x8+8+8')
    skin.scale('128x128')
    skin.write(FILE_FACE.format(uuid))


def process_uuid(uuid):
    get_texture(uuid)
    scale_face(uuid)


def get_all_uuids():
    with open(FILE_CONFIG) as f:
        db_login = json.load(f)['database']
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
