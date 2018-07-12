<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Scheb\YahooFinanceApi\ApiClient;
use Scheb\YahooFinanceApi\ApiClientFactory;
use GuzzleHttp\Client;

class stockController extends Controller
{
    public function index()
    {

      $client = ApiClientFactory::createApiClient();
      $searchResult = $client->search("Mayora");
      $historicalData = $client->getHistoricalData("MYOR.JK", ApiClient::INTERVAL_1_DAY, new \DateTime("-265 days"), new \DateTime("today"));
      $quotes = $client->getQuotes(["MYOR.JK", "GOOG"]);
      dd($quotes);






      return view('stock.stock-index');
    }
}
