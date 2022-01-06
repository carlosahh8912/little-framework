<?php

// namespace App\core;

// use Aura\Session\SessionFactory;

// class Session
// {

//     protected SessionFactory $session_factory;
//     public $session;
//     public $requests;
//     public $flasher;

//     public function __construct()
//     {
//         if (!session_id()) @session_start();
//         $this->session_factory = new SessionFactory;
//         $this->session = $this->session_factory->newInstance($_SESSION);
//         return $this;
//         // $user_session = $session->getSegment('user_session');
//         // $user_session->set('user', 'User data in array');
        
//         // $request = $session->getSegment('request');
//         // // $request->set('errors', 'Error for request forms');
        
//         // $flasher = $session->getSegment('flasher');
//         // // $flasher->setFlash('success','Is a success message');
//         // $session->getCsrfToken();
//     }
// }
