<?php

namespace App\Controllers;

class Home extends BaseController
{

	public function index()
	{
		$data = [
			'title' => 'Scraper | Best Scraper for CPA',
			'judul' => 'Scraper',
		];
		return view('/home/index', $data);
	}
	public function maintenance()
	{
		$data = [
			'title' => 'Maintenance | Scraper',
			'judul' => 'Maintenance',
		];
		return view('/errors/html/full_maintenance', $data);
	}
}
