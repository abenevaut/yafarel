# frozen_string_literal: true

require 'docker'
require 'serverspec'

describe 'Dockerfile' do
  before(:all) do # rubocop:disable RSpec/BeforeAfterAll
    ::Docker.options[:read_timeout] = 3000

    image = ::Docker::Image.build_from_dir(
      '.',
      't' => 'abenevaut/yaf-framework-ci:rspec',
      'cache-from' => 'abenevaut/yaf-framework-ci:latest'
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

  describe package('openssh-client-common') do
    it { is_expected.to be_installed }
  end

  describe package('sshpass') do
    it { is_expected.to be_installed }
  end

  describe package('python3') do
    it { is_expected.to be_installed }
  end

  describe package('py-pip') do
    it { is_expected.to be_installed }
  end

  it 'installs docker-compose' do
    expect(docker_compose_version).to include('docker-compose version 1.29.2')
  end
end
