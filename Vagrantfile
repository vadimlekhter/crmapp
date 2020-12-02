required_plugins = %w( vagrant-hostmanager vagrant-vbguest )
required_plugins.each do |plugin|
    exec "vagrant plugin install #{plugin}" unless Vagrant.has_plugin? plugin
end

Vagrant.configure("2") do |config|

  #config.vm.box = "ubuntu/trusty64"
  config.vm.box = "ubuntu/bionic64"
  #config.vm.box_url = "http://files.vagrantup.com/precise64.box" # Vagrant knows where to get the "precise64" box already

  config.vm.synced_folder './', '/crmapp', owner: 'vagrant', group: 'vagrant'
  config.vm.synced_folder '.', '/vagrant', disabled: true

  config.vm.synced_folder '../yii2-malicious', '/yii2-malicious', owner: 'vagrant', group: 'vagrant'
  config.vm.synced_folder '../yii2-malicious', '/vagrant', disabled: true

  config.vm.provision :shell, :path => "bootstrap/01-prepare-bionic64.sh"
  config.vm.provision :shell, :path => "bootstrap/02-configure-app-for-bionic64.sh"
  config.vm.provision :shell, :path => "bootstrap/03-configure-app.sh"

  config.vm.network "forwarded_port", guest: 80, host: 8888
  #config.vm.network "forwarded_port", guest: 3306, host: 3301

end
