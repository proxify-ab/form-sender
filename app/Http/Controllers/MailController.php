<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Mail\Image;
use Illuminate\Support\Facades\Mail;

/**
 * Class MailController
 *
 * @package App\Http\Controllers
 */
class MailController extends Controller
{
    public function index()
    {
        Mail::send(new Image());
    }
}
