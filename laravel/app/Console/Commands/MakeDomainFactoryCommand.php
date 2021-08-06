<?php

namespace App\Console\Commands;

use Illuminate\Console\GeneratorCommand as Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;

class MakeDomainFactoryCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $name = 'make:domain-factory';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'DomainFactoryを生成するコマンド';

    /**
     * Createのときに表示される
     *
     * @var string
     */
    protected $type = 'DomainFactory';

    /**
     * Get the stub file for the generator.
     *
     * @return string
     */
    protected function getStub(): string
    {
        if (file_exists($customPath = $this->laravel->basePath('stubs/domain-factory.stub'))) {
            return $customPath;
        }
    }

    /**
     * Parse the class name and format according to the root namespace.
     *
     * @param  string  $name
     * @return string
     */
    protected function qualifyClass($name): string
    {
        return $name;
    }

    /**
     * Get the destination class path.
     *
     * @param  string  $name
     * @return string
     */
    protected function getPath($name): string
    {
        return $this->laravel->basePath("packages/Domain/Models") . '/' . str_replace('\\', '/', $name).'.php';
    }

    /**
     * 指定された名前でクラスを構築する
     *
     * @param  string  $name
     * @return string
     */
    protected function buildClass($name)
    {
        $nameArray = explode("/", $name);
        $lastNameSpace = "";
        foreach ($nameArray as $value) {
            if($value === end($nameArray)){
                break;
            }
            $lastNameSpace .= '\\' . $value;
        }

        $replace = [
            'DummyFactoryClass' => end($nameArray),
            'DummyNameSpaceLast' => $lastNameSpace
        ];

        return str_replace(
            array_keys($replace),
            array_values($replace),
            parent::buildClass($name)
        );
    }
}
