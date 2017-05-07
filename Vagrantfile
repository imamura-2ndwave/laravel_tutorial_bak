Vagrant.configure("2") do |config|
  config.vm.box = "centos/7"
  config.vm.hostname = "laravel.dev"

  # ネットワーク設定
  config.vm.network :private_network, ip: "192.168.33.10"

  # 共有フォルダ(デフォルトの設定を無効化)
  config.vm.synced_folder ".", "/vagrant", disabled: true

  # 共有フォルダ(インストール時はアンコメント、インストール終了後にコメントアウトする)
  # config.vm.synced_folder "./shell", "/vagrant/shell", create: true, mount_options: ['dmode=777', 'fmode=775'], nfs: false

  # 共有フォルダ(インストール時はコメントアウト、インストール終了後にアンコメントする)
  config.vm.synced_folder ".", "/var/www/laravel", create: true, owner: 'apache', group: 'apache', mount_options: ['dmode=777', 'fmode=777'], nfs: false

  # プロビジョン
  if ARGV.include? '--provision-with'
    # オプションが明示的に指定されたときのみ実行する
    config.vm.provision "install", type: :shell, :path => "shell/install.sh", run: "never"
  end
  # config.vm.provision "provision", type: :shell, :path => "shell/provision.sh", run: "always"

end
