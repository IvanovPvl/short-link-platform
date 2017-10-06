<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

use IpApi\Client;
use DeviceDetector\DeviceDetector;

use App\Models\{
    Stat,
    IpGeo
};

/**
 * Class ProcessStat
 * @package App\Jobs
 */
class ProcessStat implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /** @var Stat */
    private $stat;

    /**
     * Create a new job instance.
     *
     * @param Stat $stat
     */
    public function __construct(Stat $stat)
    {
        $this->stat = $stat;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        if ($this->stat->countryCode == 'Unknown') {
            $ipClient = new Client();
            $info     = $ipClient->getInfo($this->stat->ip);
            if ($info->getStatus() == 'success') {
                $this->stat->countryCode = $info->getCountryCode();

                IpGeo::create([
                    'ip'           => $info->getQuery(),
                    'city'         => $info->getCity(),
                    'region'       => $info->getRegion(),
                    'country'      => $info->getCountry(),
                    'region_name'  => $info->getRegionName(),
                    'country_code' => $info->getCountryCode(),
                ]);
            }
        }

        $dd = new DeviceDetector($this->stat->user_agent);
        $dd->parse();
        $this->stat->os = $dd->getOs();

        $this->stat->save();
    }
}
