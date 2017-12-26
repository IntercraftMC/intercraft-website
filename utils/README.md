# InterCraft Website Utilities

This directory contains standalone scripts
to aid the InterCraft server and website.

## update_skins.py

This script downloads and processes the skins for
either all users in the database,
or a specific user
given by username or UUID.

Usage:

Option | Description
-------|------------------
--uuid | Specify UUID.
--name | Specify username.
-h     | Get usage/help.

### Dependencies

`update_skins.py` uses the following packages
to provide functionality:

* `MySQLdb` for database access.
* `PythonMagick` for image processing.
* `requests` for simple HTTP requests.

### Cron scheduling

This can be easily scheduled
by running `crontab -e`
and adding the following line:

    * */3 * * * /path/to/utils/update_skins.py

This will run the script every 3 hours.
See the cron documentation
for more scheduling options.

## send_stats.py

This script sends the minecraft statistics
from a minecraft server to the database.
The path to the minecraft server
and database login information
are stored in `config/config.json`.

### Dependencies

`send_stats.py` uses `MySQLdb`
to provide database functionality.

## mount_filesystems.py

This script will mount all registered filsystems
in the database to the appropriate users on boot
and each time a new filesystem is regestered

### Dependencies

`mount_filesystems.py` uses the following packages
to provide functionality:

* `MySQLdb` for database access.

### Scheduling

Add the following line to your `rc.local` to mount
these filesystems on boot:

    /path/to/utils/mount_filesystems.py

This will execute once each time your system boots
up and will automatically mount the filesystems
in the appropriate user directories.
