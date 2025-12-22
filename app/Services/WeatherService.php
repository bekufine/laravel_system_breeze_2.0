<?php
namespace App\Services;

use Illuminate\Support\Facades\Http;

class WeatherService
{
    // private $apiKey;
	// public $city_translations;
	private $apiKey;
	public $city_translations;


    // public function __construct()
    // {
    //     $this->apiKey = config('services.weather.key');
	// 	$this->city_translations = [
    //         "北海道"=>"Hokkaido","東京"=>"Tokyo","神奈川"=>"Kanagawa","千葉"=>"Chiba","茨城"=>"Ibaraki","群馬"=>"Gunma","栃木"=>"Tochigi","愛知"=>"Aichi","静岡"=>"Shizuoka","新潟"=>"Niigata","福井"=>"Fukui","大阪"=>"Osaka","兵庫"=>"Hyogo","京都"=>"Kyoto","滋賀"=>"Shiga","奈良"=>"Nara","三重"=>"Mie","広島"=>"Hiroshima","岡山"=>"Okayama","福岡"=>"Fukuoka","熊本"=>"Kumamoto","大分"=>"Oita","佐賀"=>"Saga","鹿児島"=>"Kagoshima","沖縄"=>"Okinawa"
    //     ];
    // }

	public function __construct()
	{
		$this->apiKey = config("services.weather.key");
		$this->city_translations = ["北海道"=>"Hokkaido","東京"=>"Tokyo","神奈川"=>"Kanagawa","千葉"=>"Chiba","茨城"=>"Ibaraki","群馬"=>"Gunma","栃木"=>"Tochigi","愛知"=>"Aichi","静岡"=>"Shizuoka","新潟"=>"Niigata","福井"=>"Fukui","大阪"=>"Osaka","兵庫"=>"Hyogo","京都"=>"Kyoto","滋賀"=>"Shiga","奈良"=>"Nara","三重"=>"Mie","広島"=>"Hiroshima","岡山"=>"Okayama","福岡"=>"Fukuoka","熊本"=>"Kumamoto","大分"=>"Oita","佐賀"=>"Saga","鹿児島"=>"Kagoshima","沖縄"=>"Okinawa"];
	}

	public function getForecast($city){
		$url = "https://api.openweathermap.org/data/2.5/weather";
		$response = Http::get($url,[
			'q' => $this->city_translations[$city],
			'appid' => $this->apiKey,
			"units" => "metric", 
			'lang' => "ja"
		]);
		return $response->json();
	}

    // public function getForecast($city)
    // {
    //     $url = "https://api.openweathermap.org/data/2.5/weather";

    //     $response = Http::get($url, [
    //         'q'     => $city,
    //         'appid' => $this->apiKey,
    //         'units' => 'metric',
    //         'lang'  => 'ja'
    //     ]);

    //     return $response->json();
    // }


}