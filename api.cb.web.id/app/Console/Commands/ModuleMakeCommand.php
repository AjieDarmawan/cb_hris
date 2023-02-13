<?php 

namespace App\Console\Commands;

use Exception;
use Illuminate\Support\Str;
use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;



class ModuleMakeCommand extends Command
{
	/**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:module {name}';
	/**
     * The console command description.
     *
     * @var string
     */
	protected $description = 'Create a new module';
	
	

    public function __construct()
    {
        parent::__construct();
    }
	
	public function handle()
    {
		
		$tmp_path = ucwords(implode(' ', explode('/', $this->argument('name'))));
		$tmp_path = implode('\\', explode(' ', $tmp_path));
		$tmp_path = 'Modules' . DIRECTORY_SEPARATOR . $tmp_path; 
		
		
		$className = Str::studly(class_basename($this->argument('name')));
		$classController = $tmp_path . DIRECTORY_SEPARATOR . $className . 'Controller';
		
		$modelPath = 'Http\\Controllers\\' . $tmp_path; 
		$modelClass = $modelPath . DIRECTORY_SEPARATOR . $className . 'Model';
		
		
		$this->info('Persiapan membuat module '.$className.'....');
		
		$this->call('make:controller', [ 'name' => $classController, ]);
		$this->call('make:model', [ 'name' => $modelClass, ]);
		
		$this->info('Module '.$className.' berhasil dibuat....');
		
		exit;
    }
}