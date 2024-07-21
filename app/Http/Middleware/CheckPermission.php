<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckPermission
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function handle(Request $request, Closure $next): Response
    {
        
        if (!$this->hasPermission($request)) {
            return redirect('login');
        }

        // Nếu có quyền truy cập, tiếp tục yêu cầu
        return $next($request);
    }

    /**
     * Kiểm tra quyền truy cập của người dùng.
     *
     * @param \Illuminate\Http\Request $request
     * @return bool
     */
    private function hasPermission(Request $request): bool
    {
        // Thực hiện kiểm tra quyền truy cập của người dùng tại đây
        // Ví dụ: kiểm tra xem người dùng có đang đăng nhập hay không
        return $request->user() && $request->user()->hasPermission('required_permission');
    }
}
