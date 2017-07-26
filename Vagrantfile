# -*- mode: ruby -*-
# vi: set ft=ruby ts=2 sw=2 expandtab :

#Fix for people with strange locale settings
ENV.keys.each {|k| k.start_with?('LC_') && ENV.delete(k)}


UID = Process.euid
PROJECT="test"
LOCAL_HOST_PORT="8586"

app_vars = {'HOST_USER_UID' => UID}

# to avoid typing --provider docker --no-parallel
# at every vagrant up
ENV['VAGRANT_NO_PARALLEL'] = 'yes'
ENV['VAGRANT_DEFAULT_PROVIDER'] = 'docker'
Vagrant.configure(2) do |config|

  config.vm.define "fpm" do |app|
    app.vm.provider "docker" do |d|
      d.force_host_vm = false
      d.image = "allansimon/php7-fpm-postgresql"
      d.name="#{PROJECT}_fpm"
      d.env = app_vars
      d.volumes = [
        "#{ENV['PWD']}/#{PROJECT}:/var/www/symfony3",
      ]
    end
  end

  config.vm.define "nginx" do |app|
    app.vm.provider "docker" do |d|
      d.force_host_vm = false
      d.image = "nginx"
      d.name="#{PROJECT}_nginx"
      d.link "#{PROJECT}_fpm:phpfpm" # required by nginx box
      d.volumes = [
        "#{ENV['PWD']}/conf/nginx:/etc/nginx/conf.d",
        "#{ENV['PWD']}/#{PROJECT}:/var/www/symfony3",
      ]
    end
    app.vm.network "forwarded_port", guest: 80, host: LOCAL_HOST_PORT
  end

  config.ssh.insert_key = true

  config.vm.define "dev", primary: true do |app|

    app.vm.provider "docker" do |d|
      d.force_host_vm = false
      d.image = "allansimon/docker-devbox-php"
      d.name = "#{PROJECT}_dev"
      d.env = app_vars
      d.has_ssh = true
    end

    app.vm.provision :shell, privileged: false, :inline => <<-END
      set -e
      echo "cd /vagrant/#{PROJECT}" >> /home/vagrant/.zshrc;
      echo "export PATH=/vagrant/#{PROJECT}/bin:$PATH" >> /home/vagrant/.zshrc;

      cd /vagrant/#{PROJECT};
      composer install;
    END
  end
end
