VAGRANTFILE_API_VERSION = "2"

Vagrant.require_version ">= 1.6.3"

Vagrant.configure(VAGRANTFILE_API_VERSION) do |config|
  config.vm.define "default", autostart: false do |default|
    default.vm.box = "yungsang/boot2docker"
    default.vm.network "private_network", ip: "192.168.33.10"
    default.vm.synced_folder ".", "/var/www", type: "nfs"

    default.vm.provider "virtualbox" do |virtualbox|
      virtualbox.memory = 2048
    end

    default.vm.provision "docker" do |docker|
      docker.build_image "/var/www/config/environment/docker/nginx", args: "-t vagrantdocker/nginx"
      docker.build_image "/var/www/config/environment/docker/phpfpm", args: "-t vagrantdocker/phpfpm"
    end

    default.ssh.insert_key = false
    default.ssh.username = "docker"
    default.ssh.password = "tcuser"
  end

  ##
  # A pretty simple scenario. The following is the simplest Docker container it could work. The application is
  # composed of only a single container
  ##

  config.vm.define "php", autostart: false do |php|
    php.vm.provider "docker" do |docker|
      docker.image = "php:5.6-cli"
      docker.volumes = %w(/var/www:/var/www)
      docker.ports = %w(80:80)
      docker.cmd = %w(php -S 0.0.0.0:80 -t /var/www/public/ /var/www/public/index.php)
      docker.vagrant_vagrantfile = __FILE__
    end
  end

  ##
  # A more complex scenario. The application is composed of three containers: app, nginx and phpfpm
  ##

  config.vm.define "app" do |app|
    app.vm.provider "docker" do |docker|
      docker.image = "debian"
      docker.name  = "app"
      docker.volumes = %w(/var/www:/var/www)
      docker.vagrant_vagrantfile = __FILE__
      docker.remains_running = false
    end
  end

  config.vm.define "phpfpm" do |phpfpm|
    phpfpm.vm.provider "docker" do |docker|
      docker.image = "vagrantdocker/phpfpm"
      docker.create_args = %w(--volumes-from="app")
      docker.name = "phpfpm"
      docker.vagrant_vagrantfile = __FILE__
    end
  end

  config.vm.define "nginx" do |nginx|
    nginx.vm.provider "docker" do |docker|
      docker.image = "vagrantdocker/nginx"
      docker.create_args = %w(--volumes-from="app")
      docker.ports = %w(80:80)
      docker.link "phpfpm:phpfpm"
      docker.vagrant_vagrantfile = __FILE__
    end
  end
end
