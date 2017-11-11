<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Github\Client;

class GitController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
	
	/**
	 * Controller method for home page listing
	 */
	public function index() {
		return \Response::view('git/listing');
	}
	
	/**
	 * Controller method for get-listing api
	 */
	public function listing() {
		
		$git_users = \DB::table("git_users")->paginate(5);
		return response(json_encode($git_users), 200)
                  ->header('Content-Type', 'application/json');
		
	}
}
