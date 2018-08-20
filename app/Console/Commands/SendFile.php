<?php

declare(strict_types=1);

namespace App\Console\Commands;

use App\Dto\FileMailDto;
use App\Mail\FileMail;
use App\Models\Files;
use App\Repositories\FileRepository;
use App\Services\FileUploaderService;
use Illuminate\Console\Command;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Mail;
use Psr\Log\LoggerInterface;

class SendFile extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'send:files';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /** @var FileRepository */
    protected $repository;

    /** @var FileUploaderService */
    protected $fileUploaderService;

    /** @var LoggerInterface */
    protected $logger;

    /**
     * SendFile constructor.
     *
     * @param FileRepository $repository
     * @param FileUploaderService $fileUploaderService
     * @param LoggerInterface $logger
     */
    public function __construct(
        FileRepository $repository,
        FileUploaderService $fileUploaderService,
        LoggerInterface $logger
    ) {
        parent::__construct();

        $this->repository = $repository;
        $this->fileUploaderService = $fileUploaderService;
        $this->logger = $logger;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     * @throws \Exception
     */
    public function handle()
    {
        /** @var Files[]|Collection $models */
        $models = $this->repository->findAll()->take(20);

        if (0 === $models->count()) {
            return 0;
        }

        try {
            $this->process($models);
        } catch (\Exception $exception) {
            $this->logger->error($exception->getMessage(), [
                'file' => $exception->getFile(),
                'line' => $exception->getLine(),
            ]);

            return 1;
        }

        return 0;
    }

    /**
     * @param Files[]|Collection $collection
     *
     * @return void
     * @throws \Exception
     */
    public function process(Collection $collection): void
    {
        foreach ($collection as $model) {
            Mail::send(new FileMail(new FileMailDto($model)));
            $model->delete();
            $this->fileUploaderService->remove($model->name);
        }
    }
}
