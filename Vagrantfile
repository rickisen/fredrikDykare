# -*- mode: ruby -*-
# vi: set ft=ruby :

Vagrant.configure("2") do |config|

    config.vm.box = "scotch/box"
    config.vm.network "private_network", ip: "192.168.33.14"
    config.vm.hostname = "scotchbox"
    config.vm.synced_folder "public", "/var/www/public", :mount_options => ["dmode=777", "fmode=666"]
    config.vm.synced_folder "build",  "/var/www/public/wordpress/wp-content/themes/fredrikDykare", :mount_options => ["dmode=777", "fmode=666"]

end
