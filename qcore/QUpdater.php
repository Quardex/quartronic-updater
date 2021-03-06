<?php
namespace quarsintex\quartronic\qcore;

class QUpdater
{
    protected $action;

    static function update()
    {
        $input = new \Symfony\Component\Console\Input\ArrayInput(array('command' => 'update'));
        $application = new \Composer\Console\Application();
        $application->run($input);
    }

    static function run($rootDir='')
    {
        if (!$rootDir) $rootDir = __DIR__.'/../../../../';
        chdir($rootDir);
        //self::update();
        echo shell_exec('php -r "require_once(\'vendor/autoload.php\');\quarsintex\quartronic\qcore\QUpdater::update();"');
    }

    static function ver2int($v)
    {
        $v = explode('.', $v);
        return $v[0]*100000 + $v[1]*1000 + $v[2];
    }
}
