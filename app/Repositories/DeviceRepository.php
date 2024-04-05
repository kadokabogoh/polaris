<?php

namespace App\Repositories;

use Carbon\Carbon;
use Illuminate\Cache\RateLimiter;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class DeviceRepository
{
    public function create($item)
    {
        $limiter = app(RateLimiter::class);
        $actionKey = 'create_device';
        $threshold = 5;
        $success = false;
        $message = 'too many attempts';
        try {
            if ($limiter->tooManyAttempts($actionKey, $threshold)) {
                // Exceeded the maximum number of failed attempts.
                return [
                    'success' => $success,
                    'message' => $message
                ];
            }

            $response = Http::timeout(30)->post(config('app.server_url').'/devices', $item);
            $data = json_decode($response->body());
            $success = $data->status;
            $message = $data->message;
        } catch (\Exception $exception) {
            $limiter->hit($actionKey, Carbon::now()->addMinutes(10));
            Log::info("Timeout");
            //return $this->failOrFallback();
        }

        return [
            'success' => $success,
            'message' => $message
        ];
    }

    public function getPaginatedData($draw, $start, $length, $searchValue)
    {
        $limiter = app(RateLimiter::class);
        $actionKey = 'get_paginated_device';
        $threshold = 5;
        $list = [];
        $total = 0;
        $filtered = 0;
        try {
            if ($limiter->tooManyAttempts($actionKey, $threshold)) {
                // Exceeded the maximum number of failed attempts.
                return [
                    'draw' => (int)$draw,
                    'data' => $list,
                    'recordsTotal' => $total,
                    'recordsFiltered' => $filtered,
                ];
            }
            $params = [
                'start' => $start,
                'length' => $length,
                'search' => $searchValue
            ];
            $response = Http::timeout(30)->get(config('app.server_url').'/devices', $params);
            $data = json_decode($response->body());
            $list = $data->items;
            $total = $data->total;
            $filtered = $data->filtered;
        } catch (\Exception $exception) {
            $limiter->hit($actionKey, \Carbon\Carbon::now()->addMinutes(10));
            //return $this->failOrFallback();
        }

        return [
            'draw' => (int)$draw,
            'data' => $list,
            'recordsTotal' => $total,
            'recordsFiltered' => $filtered,
        ];
    }

    public function find($id)
    {
        $limiter = app(RateLimiter::class);
        $actionKey = 'find_device';
        $threshold = 5;
        $item = null;
        $success = false;
        $message = 'timeout';
        try {
            if ($limiter->tooManyAttempts($actionKey, $threshold)) {
                // Exceeded the maximum number of failed attempts.
                return [
                    'success' => false,
                    'message' => 'too many attempts',
                ];
            }
            $response = Http::timeout(30)->get(config('app.server_url').'/devices/'.$id);
            Log::info($response->body());
            $data = json_decode($response->body());
            $item = $data->item;
            $success = $data->status;
            $message = $data->message;
        } catch (\Exception $exception) {
            $limiter->hit($actionKey, \Carbon\Carbon::now()->addMinutes(10));
            //return $this->failOrFallback();
        }

        return [
            'item' => $item,
            'success' => $success,
            'message' => $message,
        ];
    }

    public function update($item)
    {
        $limiter = app(RateLimiter::class);
        $actionKey = 'update_device';
        $threshold = 5;
        $success = false;
        $message = 'too many attempts';
        try {
            if ($limiter->tooManyAttempts($actionKey, $threshold)) {
                // Exceeded the maximum number of failed attempts.
                return [
                    'success' => $success,
                    'message' => $message
                ];
            }

            $response = Http::timeout(30)->put(config('app.server_url').'/devices', $item);
            $data = json_decode($response->body());
            $success = $data->status;
            $message = $data->message;
        } catch (\Exception $exception) {
            $limiter->hit($actionKey, Carbon::now()->addMinutes(10));
            Log::info("Timeout");
            //return $this->failOrFallback();
        }

        return [
            'success' => $success,
            'message' => $message
        ];
    }

    public function del($id)
    {
        $limiter = app(RateLimiter::class);
        $actionKey = 'delete_device';
        $threshold = 5;
        $success = false;
        $message = 'timeout';
        try {
            if ($limiter->tooManyAttempts($actionKey, $threshold)) {
                // Exceeded the maximum number of failed attempts.
                return [
                    'success' => false,
                    'message' => 'too many attempts',
                ];
            }
            $response = Http::timeout(30)->delete(config('app.server_url').'/devices/'.$id);
            $data = json_decode($response->body());
            $success = $data->status;
            $message = $data->message;
        } catch (\Exception $exception) {
            $limiter->hit($actionKey, \Carbon\Carbon::now()->addMinutes(10));
            //return $this->failOrFallback();
        }

        return [
            'success' => $success,
            'message' => $message,
        ];
    }
}
