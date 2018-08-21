<?php

declare(strict_types=1);

namespace App\Mail;

use App\Dto\FileMailDto;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

/**
 * Class FileMail
 *
 * @package App\Mail
 */
class FileMail extends Mailable
{
    use Queueable, SerializesModels;

    const PATH = 'app/public';

    /** @var FileMailDto */
    protected $dto;

    /**
     * FileMail constructor.
     *
     * @param FileMailDto $dto
     */
    public function __construct(FileMailDto $dto)
    {
        $this->dto = $dto;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from(env('FILE_MAIL_FROM'))
            ->to(env('FILE_MAIL_TO'))
            ->view('email')
            ->subject('Scan')
            ->attach($this->getFilePath($this->dto->getName()));
    }

    /**
     * @param string $fileName
     *
     * @return string
     */
    private function getFilePath(string $fileName): string
    {
        $path = sprintf('%s/%s', self::PATH, $fileName);

        return storage_path($path);
    }
}
