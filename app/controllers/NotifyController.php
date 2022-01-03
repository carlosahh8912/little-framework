<?php

namespace Controllers;
use App\core\Controller;
use Flasher\Prime\FlasherInterface;

class NotifyController extends Controller
{
    public function flasher(FlasherInterface $flasher)
    {
        // ...
        // $flasher = new FlasherInterface;
        $flasher->addFlash('success', 'Data has been saved successfully!');

        // ... redirect or render a view here
    }
}