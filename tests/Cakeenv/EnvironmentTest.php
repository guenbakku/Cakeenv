<?php

use PHPUnit\Framework\TestCase;
use org\bovigo\vfs\vfsStream;
use Cake\Core\Configure;
use Cakeenv\Environment;

class EnvironmentTest extends TestCase {
        
    public function setUp() {
        $structure = [
            'config' => [
                'environments' => [
                    'env' => 'development',
                    'development' => [
                        'app.php' => '<?php $a=999',
                    ],
                ],
            ],
        ];
        $this->root = vfsStream::setup('root', null, $structure);
        $this->config = [
            'env_key' => 'env',
            'env_dir' => 'environments',
            'config_path' => $this->root->url().DS.'config',
        ];
    }
    
    public function testSetConfig() {
        $config = $this->config;
        Environment::config($config);
        $this->assertEquals($config, Environment::config());
        
        return $config;
    }
    
    /**
     * @depends testSetConfig
     */
    public function testReadfileSuccess($config) {
        Environment::config($config);
        $this->assertEquals('development', Environment::readfile());
    }
    
    /**
     * @expectedException Exception
     */
    public function testReadfileNotFound() {
        $config['env_key'] = 'notExist';
        Environment::config($config);
        Environment::readfile();
    }
    
    /**
     * @depends testSetConfig
     */
    public function testEnvFromReadFile($config) {
        Environment::config($config);
        $this->assertEquals('development', Environment::env());
    }
    
    /**
     * @depends testSetConfig
     */
    public function testEnvFromConfigure($config) {
        Environment::config($config);
        Configure::write($config['env_key'], 'production');
        $this->assertEquals('production', Environment::env());
    }
}