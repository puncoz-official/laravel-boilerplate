<?php

namespace App\Core\Jobs;

use App\Data\Entities\User\User;
use Exception;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

/**
 * Class LogActivity
 * @package App\Core\Jobs
 */
class LogActivity implements ShouldQueue
{
    use Dispatchable;
    use InteractsWithQueue;
    use Queueable;
    use SerializesModels;

    /**
     * The number of times the job may be attempted.
     *
     * @var int
     */
    public $tries = 3;
    /**
     * @var string
     */
    protected $description;
    /**
     * @var User|int|null
     */
    protected $causer;
    /**
     * @var Model
     */
    protected $subject;
    /**
     * @var array
     */
    protected $properties;
    /**
     * @var string
     */
    protected $logName;

    /**
     * LogActivity constructor.
     *
     * @param string        $description
     * @param User|int|null $causer
     * @param Model         $subject
     * @param array         $properties
     * @param string        $logName
     */
    public function __construct(string $description, $causer, $subject, array $properties = [], string $logName = '')
    {
        $this->description = $description;
        $this->causer      = $causer;
        $this->subject     = $subject;
        $this->properties  = $properties;
        $this->logName     = $logName ?: config('activitylog.default_log_name');
    }

    /**
     * @return array
     */
    public function tags(): array
    {
        return ['log'];
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        activity($this->logName)->causedBy($this->causer)->performedOn($this->subject)->withProperties($this->properties)->log($this->description);
    }

    /**
     * The job failed to process.
     *
     * @param Exception $exception
     *
     * @return void
     */
    public function failed(Exception $exception)
    {
        $context = [
            'logName'     => $this->logName,
            'description' => $this->description,
            'causer'      => $this->causer,
            'subject'     => $this->subject,
            'properties'  => $this->properties,
        ];

        logger()->error($exception->getMessage(), $context);
    }
}
