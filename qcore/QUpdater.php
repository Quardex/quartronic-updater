<?php

namespace quarsintex\quartronic\qcore;

class QUpdater {

    protected $action;

    static function run($rootDir='',$lockDir='') {
        if (!$rootDir) $rootDir = __DIR__.'/../../../../';
        chdir($rootDir);
        $input = new \Symfony\Component\Console\Input\ArrayInput(array('command' => 'update'));
        $application = new \Composer\Console\Application();
        $application->run($input);
    }
}
