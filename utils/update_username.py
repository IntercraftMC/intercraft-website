#!/usr/bin/python3

import argparse
import configparser
import io
import json
import MySQLdb
import os
import requests

API_PROFILE = 'https://sessionserver.mojang.com/session/minecraft/profile/{}'

SCRIPT_LOCATION = os.path.dirname(os.path.realpath(__file__))
FILE_CONFIG = SCRIPT_LOCATION + '/../.env'

def fetch_username(uuid):
    try:
        resp = requests.get(API_PROFILE.format(uuid))
    except ConnectionError:
        print('Failed to connect to {}'.format(API_PROFILE.format(uuid)))
        return

    if resp.status_code != 200:
        print('Error from Mojang API. Reason:')
        print(json.dumps(resp.json(), sort_keys=True, indent=4))
        return

    return resp.json()['name']


def db_login():
    config = configparser.ConfigParser()
    try:
        with open(FILE_CONFIG) as f:
            ini_fp = io.StringIO('[root]\n' + f.read())
            config.readfp(ini_fp)
    except OSError:
        print('Please add and configure a database in config.json.')
        sys.exit(1)

    db = MySQLdb.connect(host=config['root']['DB_HOST'],
                         user=config['root']['DB_USERNAME'],
                         passwd=config['root']['DB_PASSWORD'],
                         db=config['root']['DB_DATABASE'])

    return db


def fetch_active_ids(db):
    cur = db.cursor()
    cur.execute('SELECT `id` FROM `users` WHERE `active`=1')
    return [i[0] for i in cur.fetchall()]


def fetch_uuid(db, user_id):
    cur = db.cursor()
    query_string = 'SELECT `id`,`primary_uuid`,`mc_username` FROM `profiles` WHERE `user_id`=%s'
    params = (user_id,)
    cur.execute(query_string, params)
    return cur.fetchone()


def save_username(db, username, _id):
    cur = db.cursor()
    query_string = 'UPDATE `profiles` SET `mc_username`=%s WHERE `id`=%s'
    params = (username, _id)
    cur.execute(query_string, params)


def update_user(db, user_id):
    _id, uuid, name = fetch_uuid(db, user_id)
    newname = fetch_username(uuid)
    if name != newname:
        save_username(db, newname, _id)


def update_all_users(db):
    ids = fetch_active_ids(db)
    for _id in ids:
        update_user(db, _id)


def main():
    parser = argparse.ArgumentParser(description='Update minecraft usernames.')
    parse_group_user = parser.add_argument_group()
    parse_group_user.add_argument('--userid', '-i',
                                  help='User ID of the player on InterCraft.')

    args = parser.parse_args()

    db = db_login()
    if args.userid != None:
        update_user(db, args.userid)
    else:
        update_all_users(db)
    db.commit()


if __name__ == '__main__':
    main()
