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
