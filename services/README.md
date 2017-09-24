# InterCraft Services

Copy the services to your Systemd service directory
`cp services/intercraft_worker.service /etc/systemd/system/intercraft_worker.service`

In the copied service file, edit the path to your `artisan` file, and set your user and group.

Make sure that the copied file is marked executable
`chmod +x /etc/systemd/system/intercraft_worker.service`
