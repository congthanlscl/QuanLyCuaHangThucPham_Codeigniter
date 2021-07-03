<?php

//app/Filters/Auth.php
namespace App\Filters;
use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Config\Services;

class Auth implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        $admin_url = [
			// 'admin',
			'order',
			'warehouse',
			'categories',
			'customer',
			'inventory',
			'products',  
			'provider',
			'purchase', 
			'tags',
			'units',
		];
        $seg2 = [
            // "ajaxLogin",
            // "forgotPassword",
            // "ajaxForgotPassword",
            "dashboard"
        ];
        $session = (object)Services::session()->get("userdata");
        if ($session->isLoggedIn) // đã đăng nhập
        { 

            if ($request->uri->getSegment(1) == "admin" && empty($request->uri->getSegment(2))) // trang login
            {
                return redirect()->to(base_url('order'));
            }
        } 
        else
        {
  
            if (in_array($request->uri->getSegment(1), $admin_url) || in_array($request->uri->getSegment(2), $seg2)) // nếu vào trang admin mà chưa đăng nhập
            {
                return redirect()->to(base_url('admin'));
            }
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
    }

} 


?>