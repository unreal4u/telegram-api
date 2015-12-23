# -*- mode: ruby -*-
# vi: set ft=ruby :

Vagrant.configure(2) do |config|
    config.vm.box = "rasmus/php7dev"

    config.vm.network "public_network", type: "dhcp"
    config.vm.network :forwarded_port, guest: 80, host: 8080

    config.vm.synced_folder ".", "/var/www/default/"
    config.vm.provision :shell, path: "composer-install.sh"
end
