<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class AuthFilters implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        $session = session();

        // Kalau belum login
        // app/Filters/Role.php
        if ($arguments && !in_array($session->get('role'), $arguments)) {
            return redirect()->to('/login'); // atau ke halaman error
        }


        // Kalau user sudah login tapi nyoba ke login page
        $currentController = service('router')->controllerName();
        if ($currentController === 'App\Controllers\AuthController') {
            $role = $session->get('role');
            if ($role === 'gudang') {
                return redirect()->to('gudang');
            } elseif ($role === 'dapur') {
                return redirect()->to('dapur');
            }
        }

        // cek role sesuai route
        if ($arguments && !in_array($session->get('role'), $arguments)) {
            return redirect()->back()->with('error', 'Akses ditolak: Anda tidak memiliki izin untuk mengakses halaman ini.');
        }
    }


    /**
     * Fungsi after dijalankan SETELAH Controller diproses,
     * sebelum response dikirim ke browser.
     */
    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        $session = session();

        // Cegah user yang sudah login untuk kembali ke halaman login
        if ($session->get('isLoggedIn') && service('router')->controllerName() === 'App\Controllers\AuthController') {
            $role = $session->get('role');

            if ($role === 'gudang') {
                return redirect()->to('gudang');
            } elseif ($role === 'dapur') {
                return redirect()->to('dapur');
            } else {
                return redirect()->to('dashboard'); // default kalau role lain
            }
        }


        // Bisa juga tambahin header untuk keamanan
        $response->setHeader('X-Frame-Options', 'DENY');
        $response->setHeader('X-Content-Type-Options', 'nosniff');
        $response->setHeader('X-XSS-Protection', '1; mode=block');
    }
}
