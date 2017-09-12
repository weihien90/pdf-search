<?php

namespace App\Jobs;

use Exception;

use App\File;

use Illuminate\Support\Facades\Storage;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class ExtractFileText implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * The number of times the job may be attempted.
     *
     * @var int
     */
    public $tries = 5;

    /**
     * The number of seconds the job can run before timing out.
     *
     * @var int
     */
    public $timeout = 120;

    protected $file;
    protected $file_path;

    /**
     * Create a new job instance.
     *
     * @param  File  $file
     * @param  String  $file_path
     * @return void
     */
    public function __construct(File $file, String $file_path)
    {
        $this->file = $file;
        $this->file_path = $file_path;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        // Execute pdftotext to extract the file's text
        $command = env('PDFTOTEXT_PATH') . " " . storage_path('app/' . $this->file_path . $this->file->name);
        exec( $command, $output, $return );

        $this->file->content = Storage::get($this->file_path . $this->file->name . ".txt");
        $this->file->status = true;
        $this->file->save();
    }

    /**
     * The job failed to process.
     *
     * @param  Exception  $exception
     * @return void
     */
    public function failed(Exception $exception)
    {
        $this->file->status = false;
        $this->file->save();
    }
}
