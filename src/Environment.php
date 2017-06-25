<?php
/**
 * Environment switch plugin for CakePHP
 * 
 * @copyright   NVB
 * @license     http://www.opensource.org/licenses/mit-license.php MIT License
 */
namespace Cakeenv;

use Cake\Core\Configure;

class Environment {
    
    protected static $config = [
        'env_key' => 'env',
        'env_dir' => 'environments',
        'config_path' => ROOT.DS.'config',
    ]
    
    /**
     * Get name of environment.
     * Name of environment is defined in file 'config/environments/env'
     */
    public static function env() {
        $env = Configure::read(static::$config['env_key']);
        if ($env === null) {
            $env = static::readfile();
            Configure::write(static::$config['env_key'], $env);
        } 
        return $env;
    }
    
    /**
     * Load config in environment correspond to environment name.
     */
    public static function load($key, $config = 'default', $merge = true) {
        $env = static::env();
        $fullkey = implode(DS, [
            static::$config['env_dir'], 
            $env, 
            $key
        ]);
        Configure::load($fullkey, $config, $merge);
    }
    
    /**
     * Read environment name from config file
     */
    public static function readfile() {
        $env_file = implode(DS, [
            static::$config['config_path'], 
            static::$config['env_dir'], 
            static::$config['env_key'],
        ]);
        $env = trim(fgets(fopen($env_file, 'r')));
        if (empty($env)) {
            throw new \Exception("File does not exist or it is empty: $env_file");
        }
        return $env;
    }
    
    /**
     * Set config for plugin
     * Use it when you want to change env's config directory 
     */
    public static function config($config) {
        static::config = array_merge(static::config, $config);
    }
}
