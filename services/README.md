# InterCraft Services

Copy the services to your Systemd service directory
`cp services/intercraft_worker.service /etc/systemd/system/intercraft_worker.service`

In the copied service file, edit the path to your `artisan` file, and set your user and group.

Make sure that the copied file is marked executable
`chmod +x /etc/systemd/system/intercraft_worker.service`

You will also want to add to your sudoers in order to allow SFTP acconut creation.
`sudo visudo`

Then put the following at the end of the file
`www-data ALL=NOPASSWD: /path/to/website/root/utils/create_user.sh`
