<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Github\Client;

class PullGitUsers extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'pullgitusers';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
	 *
	 * Fetches all the symfony users and stores them in git_users
	 * 	 
     * @param null
	 *
     * @return mixed
     */
    public function handle()
    {	
        $this->line("Fetching users");
		
		$this->create_table_if_not_exists();
		
		$symfony_users = $this->fetch_symfony_users();
		
		$this->save_users($symfony_users);
    }
	
	/**
	 * Saves the symfony users provided into git_users table
	 *
	 * @param array $users_array
	 * @return null
	 */
	protected function save_users($users_array)
	{
		foreach($users_array as $user) {
			\DB::table("git_users")->insert([
										'git_id' => $user['id'],
										'name' => $user['name'],
										'url' => $user['url'],
										]);
		}
		
		// for debugging
		$this->line("Saved to database");
	}
	
	/**
	 * Fetches users for symfony github repositories
	 *
	 * @uses \Github\Client
	 * @param null
	 * @returns array
	 */
	protected function fetch_symfony_users()
	{
		$client = new Client();
		$users = $client->api('user')->repositories('symfony');
		
		// for debugging
		$this->line("Total repositories found: " . count($users));
		
		return $users;
	}
	
	/**
	 * Checks if git_users table exists and creates one if not exists
	 * 
	 * @param none
	 * @returns null
	 */
	protected function create_table_if_not_exists()
	{
		if( !\Schema::hasTable('git_users') ) {
			\Schema::create('git_users', function($table) {
				$table->increments('id');
				$table->bigInteger('git_id');
				$table->string('name', 255);
				$table->text('url');
			});
		}
	}
}
