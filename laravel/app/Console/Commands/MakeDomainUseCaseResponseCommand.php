<?php

namespace App\Console\Commands;

use Illuminate\Console\GeneratorCommand as Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;

class MakeDomainUseCaseResponseCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * e.g. php artisan make:domain-usecase-response Product/Create
     *
     * @var string
     */
    protected $name = 'make:domain-usecase-response';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '# Create a new domain usecase response';

    /**
     * Createのときに表示される
     *
     * @var string
     */
    protected $type = 'UseCaseResponse';

    /**
     * Get the stub file for the generator.
     *
     * @return string
     */
    protected function getStub(): string
    {
        if (file_exists($customPath = $this->laravel->basePath('stubs/domain-usecase-response.stub'))) {
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

        $nameArray = explode("/", $name);
        $classHeadName = implode('', $nameArray);
        return $this->laravel->basePath("packages/UseCase") . '/' . str_replace('\\', '/', $name)."/{$classHeadName}Response.php";
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
        $replace = [
            'DummyResponseClass' => implode($nameArray),
            'DummyNameSpaceLast' => str_replace('/', '\\', $name),
        ];

        return str_replace(
            array_keys($replace),
            array_values($replace),
            parent::buildClass($name)
        );
    }
}
