<?php

namespace App\Console\Commands;

use App\Services\City\CityService;
use Illuminate\Console\Command;
use GuzzleHttp\Client;

class RateCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'rate:update';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Rate update for api';


    private $client;
    private $cityService;
    private $defaultCurrency = 'UAH';
    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(
        Client $client,
        CityService $cityService
    )
    {
        $this->client = $client;
        $this->cityService = $cityService;
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $response = $this->client->request('GET', env('URL_API_RATES'));
        if($response->getStatusCode() != 200){
            return Command::FAILURE;
        }
        $ratesArray = json_decode($response->getBody(), true);

        if(isset($ratesArray['timestamp'])){
            unset($ratesArray['timestamp']);
        }else{
            return Command::FAILURE;
        }

        $citiesEntry = $this->cityService->getClient(['rates']);
        $citiesApiIDs = $citiesEntry->pluck('api_id')->toArray();
        foreach($ratesArray as $city){
            if(!in_array($city['id'], $citiesApiIDs)){
                $cityCreate = [
                    'api_id' => $city['id'],
                    'name'=>['ru' => $city['name']]
                ];
                $cityEntry = $this->cityService->add($cityCreate);

                foreach($city['rates'] as $rate){
                    $currency = explode('/', $rate['currency']);
                    $rateCreate = [
                        'api_id' => $rate['id'],
                        'currency_from'=> $currency[0] ?? 0,
                        'currency_to'=> $currency[1] ?? $this->defaultCurrency,
                        'buy'=> $rate['buy'],
                        'sale'=> $rate['sale'],
                        'buy_opt'=> $rate['buy'] + 1,
                        'sale_opt'=> $rate['sale'] + 1,
                    ];
                    $cityEntry->rates()->create($rateCreate);
                }
            }else{
                $cityEntry = $citiesEntry->filter(function($item) use ($city){
                    return $item->api_id == $city['id'];
                })->first();
                $ratesEntry = $cityEntry->rates;
                $ratesApiIDs = $ratesEntry->pluck('api_id')->toArray();

                foreach($city['rates'] as $rate){
                    $currency = explode('/', $rate['currency']);
                    $rateCreate = [
                        'api_id' => $rate['id'],
                        'currency_from'=> $currency[0] ?? 0,
                        'currency_to'=> $currency[1] ?? $this->defaultCurrency,
                        'buy'=> $rate['buy'],
                        'sale'=> $rate['sale'],
                        'buy_opt'=> $rate['buy'] + 1,
                        'sale_opt'=> $rate['sale'] + 1,
                    ];
                    if(!in_array($rate['id'], $ratesApiIDs)){
                        $cityEntry->rates()->create($rateCreate);
                    }else{
                        $rateEntry = $ratesEntry->filter(function($item) use ($rate){
                            return $item->api_id == $rate['id'];
                        })->first();
                        $rateEntry->update($rateCreate);//???
                    }
                }
            }

        }

        return Command::SUCCESS;
    }
}
