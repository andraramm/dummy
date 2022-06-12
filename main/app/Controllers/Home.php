<?php

namespace App\Controllers;

class Home extends BaseController
{

	public function index()
	{
		$data = [
			'title' => 'Woops | Scraper',
			'judul' => 'Woops',
			'teks' => 'Halaman ini dalam tahap pengembangan.'
		];
		return view('/errors/html/page_mt', $data);
	}
	public function maintenance()
	{
		return view('maintenance');
	}
}
