<?php

namespace App\Http\Controllers\Backend\Home;

use App\Http\Controllers\BackendController;
use App\Jobs\AddImage;
use Illuminate\Http\Request;
use App\Library\Ftp;

use App\Store\ImagesStore;
use Log;
use Storage;
use App\Services\OSS;

class UploadsController extends BackendController
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    /**
     * 用tclip 截图 并且用OSS上传到相应的服务器
     */
    public function articleimg(Request $request)
    {
        $user_id = $this->guard()->user()->id;
        if ($user_id) {
            $uploadRealPath = 'uploads/images/' . date('Y', time()) . date('m', time()) . date('d', time());
            $file = $request->file('file');
            $realFile = $file->getRealPath();
            $ext = $file->getClientOriginalExtension();//临时文件的绝对路径
            $type = $file->getClientMimeType();     // image/jpeg
            $originalName = $file->getClientOriginalName(); // 文件原名

            $localName = md5(uniqid(microtime(true), true)) . '.' . $ext;
            $localPath = $uploadRealPath . DIRECTORY_SEPARATOR . $localName;

            $realName = md5(uniqid(microtime(true), true)) . '.' . $ext;
            $realPath = $uploadRealPath . DIRECTORY_SEPARATOR . $realName;

            $allowExt = array('jpeg', 'jpg', 'gif', 'png');
            $imageUrl = 'http://' . env('QINIU_DOMAINS_DEFAULT') . DIRECTORY_SEPARATOR . $realName;

            if (!in_array(strtolower($ext), $allowExt)) {
                $data = array('code' => '1', 'refresh' => false, 'state' => 'fail', 'msg' => '[非法文件类型]', 'html' => '', '__error' => '',);
            } else {
                $disk = Storage::disk('qiniu');

                if ($disk->put($realName, file_get_contents($realFile))) {
                    $imagesStore = new ImagesStore();

                    $data = [
                        'file_name' => $_FILES['file']['name'],
                        'real_name' => $realName,
                        'path' => $uploadRealPath,
                        'position' => $realPath,
                        'url' => $imageUrl,
                        'size' => $_FILES['file']['size'],
                        'status' => 1,
                        'user_id' => $user_id,
                    ];

                    if ($imagesStore::addData($imagesStore, $data) != false) {
                        $fileData = array('filename' => $_FILES['file']['name'], 'fileId' => strval($imagesStore->_id), 'src' => $imageUrl);
                        $data = array('code' => '0', 'refresh' => false, 'state' => 'success', 'msg' => '[操作成功]', 'data' => $fileData, 'html' => '', '__error' => '');
                    }

                } else {
                    $data = array('code' => '1', 'refresh' => false, 'state' => 'fail', 'msg' => '[操作失败]', 'html' => '', '__error' => '',);
                }

            }
            return response()->json($data);
        }
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function image(Request $request)
    {
        $user_id = $this->guard()->user()->id;
        if ($user_id) {
            $uploadRealPath = 'uploads/images/' . date('Y', time()) . date('m', time()) . date('d', time());
            $file = $request->file('file');
            $realFile = $file->getRealPath();
            $ext = $file->getClientOriginalExtension();//临时文件的绝对路径
            $type = $file->getClientMimeType();     // image/jpeg
            $originalName = $file->getClientOriginalName(); // 文件原名

            $realName = md5(uniqid(microtime(true), true)) . '.' . $ext;
            $realPath = $uploadRealPath . DIRECTORY_SEPARATOR . $realName;
            $allowExt = array('jpeg', 'jpg', 'gif', 'png');
            $imageUrl = 'http://' . env('QINIU_DOMAINS_DEFAULT') . DIRECTORY_SEPARATOR . $realName;

            if (!in_array(strtolower($ext), $allowExt)) {
                $data = array('statusCode' => '300', 'refresh' => false, 'state' => 'fail', 'message' => '[非法文件类型]', 'html' => '', '__error' => '',);
            } else {
                $disk = Storage::disk('qiniu');

                if ($disk->put($realName, file_get_contents($realFile))) {
                    $imagesStore = new ImagesStore();

                    $data = [
                        'file_name' => $_FILES['file']['name'],
                        'real_name' => $realName,
                        'path' => $uploadRealPath,
                        'position' => $realPath,
                        'url' => $imageUrl,
                        'size' => $_FILES['file']['size'],
                        'status' => 1,
                        'user_id' => $user_id,
                    ];

                    if ($imagesStore::addData($imagesStore, $data) != false) {
                        $fileData = array('filename' => $_FILES['file']['name'], 'fileId' => strval($imagesStore->_id), 'url' => $imageUrl);
                        $data = array('statusCode' => '200', 'refresh' => false, 'state' => 'success', 'message' => '[操作成功]', 'data' => $fileData, 'html' => '', '__error' => '');
                    }

                } else {
                    $data = array('statusCode' => '300', 'refresh' => false, 'state' => 'fail', 'message' => '[操作失败]', 'html' => '', '__error' => '',);
                }
            }
            return response()->json($data);
        }
    }
}
