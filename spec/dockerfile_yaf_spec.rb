# frozen_string_literal: true

require 'docker'
require 'serverspec'

describe 'Dockerfile.yaf' do
  before(:all) do # rubocop:disable RSpec/BeforeAfterAll
    ::Docker.options[:read_timeout] = 3000

    image = ::Docker::Image.build_from_dir(
      '.',
      'dockerfile' => 'Dockerfile.yaf',
      't' => 'abenevaut/yaf-framework:rspec',
      'cache-from' => 'abenevaut/yaf-framework:latest'
    )

    set :os, family: :alpine
    set :backend, :docker
    set :docker_image, image.id
  end

  def docker_compose_version
    command('docker-compose -v').stdout
  end

  describe file('/etc/os-release') do
    it { is_expected.to be_file }
  end

  describe command('cat /etc/os-release') do
    it 'confirm alpine version' do
      expect(subject.stdout).to match(/Alpine Linux/)
      expect(subject.stdout).to match(/3.16.2/)
    end
  end

  describe command('php --version') do
    it 'confirm php version' do
      expect(subject.stdout).to match(/PHP 8.1.12/)
    end
  end

  describe command('php -m') do
    it 'confirm php modules' do
      expect(subject.stdout).to match(/yaf/)
    end
  end

  describe command('php -r "phpinfo();"') do
    it 'confirm phpinfo' do
      expect(subject.stdout).to match(/yaf support => enabled/)
      expect(subject.stdout).to match(/yaf.use_namespace => 1 => 1/)
      expect(subject.stdout).to match(/yaf.use_spl_autoload => 1 => 1/)
      expect(subject.stdout).to match(/yaf.environ => production => production/)
    end
  end
end
