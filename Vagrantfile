# -*- mode: ruby -*-
# vi: set ft=ruby :

Vagrant.configure(2) do |config|
    config.vm.box = "rasmus/php7dev"
    config.vm.provision :shell, path: "vagrant-telegram-install.sh"

    config.vm.network "public_network", type: "dhcp"
    config.vm.network :forwarded_port, guest: 80, host: 8080

    config.vm.synced_folder ".", "/vagrant", disabled: true
    config.vm.synced_folder "src/", "/var/www/default/src/"
    config.vm.synced_folder "tests/", "/var/www/default/tests/"
    config.vm.synced_folder "vendor/", "/var/www/default/vendor"
    config.vm.synced_folder "examples/", "/var/www/default/examples"
end
