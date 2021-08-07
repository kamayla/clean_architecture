<?php

namespace App\Console\Commands;

use Illuminate\Console\GeneratorCommand as Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;

class MakeDomainEloquentRepositoryCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * e.g. php artisan make:eloquent-repository Product
     *
     * @var string
     */
    protected $name = 'make:eloquent-repository';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '# Create a new eloquent repository';

    /**
     * Createのときに表示される
     *
     * @var string
     */
    protected $type = 'EloquentRepository';

    /**
     * Get the stub file for the generator.
     *
     * @return string
     */
    protected function getStub(): string
    {
        if (file_exists($customPath = $this->laravel->basePath('stubs/domain-eloquent-repository.stub'))) {
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
        return $this->laravel->basePath("packages/infrastructure/EloquentRepository") . '/' . "{$name}EloquentRepository".'.php';
    }

    /**
     * 指定された名前でクラスを構築する
     *
     * @param  string  $name
     * @return string
     */
    protected function buildClass($name)
    {
        $replace = [
            'DummyModel' => $name,
        ];

        return str_replace(
            array_keys($replace),
            array_values($replace),
            parent::buildClass($name)
        );
    }
}
