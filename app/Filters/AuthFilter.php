<?php

namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use CodeIgniter\HTTP\Response;

class AuthFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        $authHeader = $request->getHeaderLine('Authorization');

        if (!$authHeader) {
            return $this->unauthorizedResponse('Missing Authorization Header');
        }

        $token = explode(' ', $authHeader)[1] ?? null;

        if (!$token) {
            return $this->unauthorizedResponse('Token not provided');
        }

        try {
            $key = getenv('JWT_SECRET');
            $decoded = JWT::decode($token, new Key($key, 'HS256'));

            // Store user data in request for later use
            $request->user = $decoded;
        } catch (\Exception $e) {
            return $this->unauthorizedResponse('Invalid Token: ' . $e->getMessage());
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Do nothing
    }

    private function unauthorizedResponse($message)
    {
        $response = service('response');
        return $response->setJSON([
            'status' => 401,
            'error' => 'Unauthorized',
            'message' => $message
        ])->setStatusCode(401);
    }
}
