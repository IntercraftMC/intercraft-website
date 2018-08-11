# The Official Website of InterCraft

This is the official website for the InterCraft Minecraft server.

## Development

This is a quick guide to get you started developing the website on your local machine. The website is powered by the Laravel Framework which you can checkout here: https://laravel.com/docs/5.6

### Dependencies

The project uses a virtual machine called 'Homestead.` The documentation of which can be found here: https://laravel.com/docs/5.6/homestead. Below is a list of the recommended dependencies:

- [Vagrant](https://vagrantup.com)
- [VirtualBox](https://virtualbox.org)

### Clone the Repository

Clone the repository using the command below:

```sh
git clone https://github.com/InterCraftOfficial/InterCraftWebsite -b rewrite
```

### Boot the Virtual Machine

To boot the virtual machine, `cd` into the project's root directory and simply run:

```sh
vagrant up
```

The first time running this command may take a little while as it has to download the VM.

#### Potential Boot Issue

If you happen to come across an error when running this commend ending in

```
bash: line 5: /sbin/ifdown: No such file or directory
bash: line 19: /sbin/ifup: No such file or directory
```

simply run the following command in the project's root directory:

```sh
vagrant ssh                   # SSH into the VM
sudo apt-get install ifupdown # Install the missing package
```

You can now exit the VM by running `exit` and restart it using Vagrant:

```sh
vagrant reload
```

### SSH Into the VM

You can SSH into the VM by running the following in the project's root directory:

```sh
vagrant ssh
```

Here you will have access to the full environment. This is where you will run all of your composer, npm, and artisan commands.

#### Important Note

Avoid using `Git` commands within the VM!

### Halt the VM

When you're finished with the VM, you can shut it down using:

```sh
vagrant halt --force
```

### Install Project Dependencies

You will now need to install all of the project's `composer` ond `npm` dependencies. First SSH into the VM, `cd` into the project's directory, then run the following:

```sh
composer update
npm install
```
