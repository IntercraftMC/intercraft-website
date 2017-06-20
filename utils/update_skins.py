import argparse
import base64
import json
import os
import PythonMagick
import requests
import sys

API_RESOLVE_NAME = "https://api.mojang.com/users/profiles/minecraft/{}"
API_SKIN = "https://sessionserver.mojang.com/session/minecraft/profile/{}"

FOLDER_SKINS = "../public/assets/skins/"
FILE_SKIN = "{}.png"
FILE_FACE = "{}-face.png"


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
    with open(FOLDER_SKINS + FILE_SKIN.format(uuid), 'wb') as f:
        f.write(skin_resp.content)


def scale_face(uuid):
    skin = PythonMagick.Image(FOLDER_SKINS + FILE_SKIN.format(uuid))
    skin.crop("8x8+8+8")
    skin.scale("128x128")
    skin.write(FOLDER_SKINS + FILE_FACE.format(uuid))


def process_uuid(uuid):
    get_texture(uuid)
    scale_face(uuid)


def main():
    uuid = resolve_name(sys.argv[1])
    process_uuid(uuid)
#   parser = argparse.ArgumentParser(description="Download and crop a skin.")
#   parser.add_argument('--uuid', '-u')
#   parser.add_argument('--name', '-n')
#   args = parser.parse_args()
#
#   if args.name != None:
#       uuid = resolve_name(name)
#   elif args.uuid != None:
#       uuid = args.uuid
#   else:
#       uuid = None
#
#   if uuid == None:
#       uuids = get_all_uuids()
#       map(process_uuid, uuids)
#   else:
#       process_uuid(uuid)


if __name__ == '__main__':
    main()
