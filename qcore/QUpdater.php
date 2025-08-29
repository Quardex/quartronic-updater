<?php
namespace quarsintex\quartronic\qcore;

use Composer\Console\Application;
use Symfony\Component\Console\Input\ArrayInput;
use Symfony\Component\Console\Output\ConsoleOutput;

class QUpdater
{
    protected $action;


    static function update()
    {
        try {
            $application = new Application();
            $application->setAutoExit(false);
            
            $input = new ArrayInput(['command' => 'update']);
            $output = new ConsoleOutput();
            
            $result = $application->run($input, $output);
            
            if ($result === 0) {
                echo "Обновление завершено успешно\n";
            } else {
                echo "Ошибка при обновлении\n";
            }
            
            return $result;
        } catch (\Exception $e) {
            echo "Ошибка: " . $e->getMessage() . "\n";
            return 1;
        }
    }


    static function run($rootDir = '')
    {
        if (!$rootDir) {
            $rootDir = dirname(dirname(__DIR__));
        }
        
        if (!file_exists($rootDir . '/composer.json')) {
            echo "Ошибка: composer.json не найден в директории: $rootDir\n";
            return false;
        }
        
        $currentDir = getcwd();
        
        try {
            chdir($rootDir);
            
            $result = self::update();
            
            return $result === 0;
        } catch (\Exception $e) {
            echo "Ошибка при выполнении: " . $e->getMessage() . "\n";
            return false;
        } finally {
            chdir($currentDir);
        }
    }


    static function ver2int($v)
    {
        $v = explode('.', $v);
        return $v[0] * 100000 + $v[1] * 1000 + $v[2];
    }


    static function checkComposer()
    {
        if (!class_exists('Composer\Console\Application')) {
            echo "Ошибка: Composer не найден. Убедитесь, что composer установлен.\n";
            return false;
        }
        return true;
    }


    static function getComposerVersion()
    {
        if (self::checkComposer()) {
            return \Composer\Composer::VERSION;
        }
        return null;
    }
}
