<?php

namespace App\Http\Controllers\Secure;

use App\Http\Controllers\Controller;
use App\Repositories\DeviceRepository;
use Illuminate\Http\Request;

class DeviceController extends Controller
{
    private $deviceRepository;

    public function __construct(DeviceRepository $deviceRepository)
    {
        $this->deviceRepository = $deviceRepository;
    }
    //
    public function getData(Request $request)
    {
        $start = $request->get('offset');
        $length = $request->get('limit');
        $result = $this->deviceRepository->getPaginatedData(0, $start, $length, '');
        return response()->json([
            'rows' => $result['data'],
            'total' => $result['recordsFiltered'],
            'totalNotFiltered' => $result['recordsTotal']
        ]);
    }

    public function add()
    {
        return view('secure.devices.add');
    }

    public function create(Request $request)
    {
        $item = $request->all();
        $result = $this->deviceRepository->create($item);
        if ($result['success'])
        {
            $success = connectToPublish('/polaris/system/subscribe', $item['address']);
            if ($success)
            {
                return redirect()->route('secure.home.index');
            } else {
                $message = 'fail to restart mqtt client';
            }
        } else
        {
            $message = $result['message'];
        }
        return view('secure.devices.add', compact('message'));
    }

    public function edit($id)
    {
        $result = $this->deviceRepository->find($id);
        unset($result['message']);
        return view('secure.devices.edit', $result);
    }

    public function update(Request $request)
    {
        $item = $request->all();
        $result = $this->deviceRepository->update($item);
        if ($result['success'])
        {
            $success = true;
            if ($item['oldAddress'] != $item['address']) {
                $success = connectToPublish('/polaris/system/unsubsribe', $item['oldAddress']);
                if ($success)
                {
                    $success = connectToPublish('/polaris/system/subscribe', $item['address']);
                }
            }

            if ($success)
            {
                return redirect()->route('secure.home.index');
            } else {
                $item = (object) $item;
                $message = 'fail to restart mqtt client';
            }
        } else
        {
            $item = (object) $item;
            $message = $result['message'];
        }
        return view('secure.devices.edit', compact('item', 'message'));
    }

    public function del($id)
    {
        $result = $this->deviceRepository->del($id);
        if ($result['success'])
        {
            connectToPublish('/polaris/system', 'restart');
        }
        return response()->json($result);
    }
}
