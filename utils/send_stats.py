import json
import MySQLdb
import os

SCRIPT_LOCATION = os.path.dirname(__file__)
FILE_CONFIG = os.path.join(SCRIPT_LOCATION, '../config/config.json')


class Singleton:
    def __init__(self, decorated):
        self._decorated = decorated

    def instance(self):
        try:
            return self._instance
        except AttributeError:
            self._instance = self._decorated()
            return self._instance

    def __call__(self):
        raise TypeError('Singletons must be accessed through `Instance()`.')

    def __instancecheck__(self, inst):
        return isinstance(inst, self._decorated)


@Singleton
class Config:
    def __init__(self):
        with open(FILE_CONFIG) as conf:
            self.conf = json.load(conf)


@Singleton
class Database:
    def __init__(self):
        try:
            db_login = Config.instance().conf['database']
        except OSError:
            print('Please add login details for database to config.json.')

        self.db = MySQLdb.connect(host=db_login['host'],
                                  user=db_login['username'],
                                  passwd=db_login['password'],
                                  db=db_login['database'])


def get_all_uuids():
    db = Database.instance().db
    cur = db.cursor()
    cur.execute('SELECT uuid, alt_uuids FROM users')
    query = cur.fetchall()

    uuids = []
    for uuid, alts_json in query:
        uuids.append(uuid)
        alts = json.loads(alts_json)
        uuids.extend(alts)

    return uuids


def uuid_to_stats_filepath(uuid):
    config = Config.instance().conf['minecraft']
    end_file = '{}-{}-{}-{}-{}.json'.format(uuid[0:8], uuid[8:12], uuid[12:16],
                                            uuid[16:20], uuid[20:])
    server_root = config['server_root']
    world_name = config['world_name']
    return os.path.join(server_root, world_name, 'stats', end_file)


def send_stats(uuid):
    try:
        with open(uuid_to_stats_filepath(uuid)) as f:
            stats = f.read()
    except OSError:
        stats = '{}'

    query_string = 'INSERT INTO `statistics` VALUES(NULL, %s, %s, NOW())'
    params = (uuid, stats)
    db = Database.instance().db
    cur = db.cursor()
    cur.execute(query_string, params)


def main():
    for id_ in get_all_uuids():
        send_stats(id_)
    db = Database.instance().db
    db.commit()


if __name__ == '__main__':
    main()
