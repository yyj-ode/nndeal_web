<?php

namespace App\Http\Controllers\Frontend\Center;

use App\Http\Controllers\FrontendController;
use App\Jobs\AddImage;
use Illuminate\Http\Request;
use App\Library\Ftp;

use App\Models\Image;
use App\Store\ImagesStore;

use Storage;

class UploadsController extends FrontendController
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
//        $this->middleware('user');
    }

    /**
     * 用tclip 截图 并且用ftp上传到相应的服务器
     */
    public function headscreenshot(Request $request)
    {
        $user_id = $this->guard()->user()->id;
        $data = [];
        if ($user_id) {
            $catalog = 'uploads/image/' . date('Y', time()) . date('m', time()) . date('d', time());

            $allowExt = array('jpeg', 'jpg', 'gif', 'png');

            $ext = @pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);

            if (!in_array(strtolower($ext), $allowExt)) {
                $data = array('statusCode' => '300', 'refresh' => false, 'state' => 'fail', 'message' => '[非法文件类型]', 'html' => '', '__error' => '',);
            } else {
                $realName = md5(uniqid(microtime(true), true)) . '.' . $ext;

                $image_save_path = public_path($catalog);

                $realPath = $image_save_path . DIRECTORY_SEPARATOR . $realName;

                if (!file_exists($image_save_path)) {
                    @mkdir($image_save_path, 0777, true);
                } else {
                    @chmod($image_save_path, 0777);
                }

                $watermark_text = "";
                \tclip($_FILES['file']['tmp_name'], $realPath, 200, 200, $watermark_text);

                if (file_exists($realPath)) {
                    $imageUrl = config('ftp.url') . $catalog . DIRECTORY_SEPARATOR . $realName;

                    if (Storage::disk('ftp')->put($catalog . DIRECTORY_SEPARATOR . $realName, file_get_contents($realPath))) {
                        /**
                         * 保存图片信息
                         */
                        $fileModel = new Image();
                        $fileModel->file_name = $_FILES['file']['name'];
                        $fileModel->real_name = $realName;
                        $fileModel->path = $realPath;
                        $fileModel->position = $realPath;
                        $fileModel->url = $imageUrl;
                        $fileModel->size = $_FILES['file']['size'];
                        $fileModel->status = 1;
                        $fileModel->user_id = $user_id;
                        if ($fileModel->save()) {
                            $this->dispatch(new AddImage($fileModel->id));
                            $fileData = array('filename' => $_FILES['file']['name'], 'fileId' => $fileModel->id, 'url' => $imageUrl);
                            $data = array('statusCode' => '200', 'refresh' => false, 'state' => 'success', 'message' => '[操作成功]', 'data' => $fileData, 'html' => '', '__error' => '');
                        } else {
                            $data = array('statusCode' => '300', 'refresh' => false, 'state' => 'fail', 'message' => '[操作失败]', 'html' => '', '__error' => '',);
                        }
                    }

                    //删除本地图片
                    if (file_exists($realPath)) {
                        \unlink($realPath);
                    }
                } else {
                    $data = array('statusCode' => '300', 'refresh' => false, 'state' => 'fail', 'message' => '[操作失败]', 'html' => '', '__error' => '',);
                }
            }
        }

        return response()->json($data);
    }


    /**
     * 用tclip 截图 并且用ftp上传到相应的服务器
     */
    public function screenshot(Request $request)
    {
        $user_id = $this->guard()->user()->id;
        if ($request->ajax() && $user_id) {
            $catalog = 'uploads/image/' . date('Y', time()) . date('m', time()) . date('d', time());

            $allowExt = array('jpeg', 'jpg', 'gif', 'png');

            $ext = @pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);

            if (!in_array(strtolower($ext), $allowExt)) {
                $data = array('statusCode' => '300', 'refresh' => false, 'state' => 'fail', 'message' => '[非法文件类型]', 'html' => '', '__error' => '',);
            } else {
                $realName = md5(uniqid(microtime(true), true)) . '.' . $ext;

                $uploadRealPath = public_path($catalog);

                $realPath = $uploadRealPath . DIRECTORY_SEPARATOR . $realName;

                if (!file_exists($uploadRealPath)) {
                    @mkdir($uploadRealPath, 0777, true);
                } else {
                    @chmod($uploadRealPath, 0777);
                }

                $watermark_text = "";
                \tclip($_FILES['file']['tmp_name'], $realPath, 300, 225, $watermark_text);

                if (file_exists($realPath)) {
                    //ftp上传到服务器
                    $FTPConfig = array(
                        'hostname' => config('ftp.hostname'),
                        'username' => config('ftp.username'),
                        'password' => config('ftp.password'),
                        'port'     => config('ftp.port'),
                    );

                    $ftp = new Ftp();
                    $ftp->connect($FTPConfig);

                    //创建目录
                    $ftp->mkdir($catalog);
                    //给创建的目录分配权限
                    $ftp->chmod($catalog, 0755);

                    //执行上传
                    $ftp->upload($realPath, $catalog . DIRECTORY_SEPARATOR . $realName);
                    //给创建的文件分配权限
                    $ftp->chmod($catalog . DIRECTORY_SEPARATOR . $realName, 0755);
                    $ftp->close();
                    //图片url位置
                    $imageUrl = config('ftp.url') . $catalog . DIRECTORY_SEPARATOR . $realName;

                    //删除本地图片
                    if (file_exists($realPath)) {
                        \unlink($realPath);
                    }

                    /**
                     * 保存图片信息
                     */
                    $fileModel = new Image();
                    $fileModel->file_name = $_FILES['file']['name'];
                    $fileModel->real_name = $realName;
                    $fileModel->path = $realPath;
                    $fileModel->position = $realPath;
                    $fileModel->url = $imageUrl;
                    $fileModel->size = $_FILES['file']['size'];
                    $fileModel->status = 1;
                    $fileModel->user_id = $user_id;
                    if ($fileModel->save()) {
                        $this->dispatch(new AddImage($fileModel->id));
                        $fileData = array('filename' => $_FILES['file']['name'], 'fileId' => $fileModel->id, 'url' => $imageUrl);
                        $data = array('statusCode' => '200', 'refresh' => false, 'state' => 'success', 'message' => '[操作成功]', 'data' => $fileData, 'html' => '', '__error' => '');
                    } else {
                        $data = array('statusCode' => '300', 'refresh' => false, 'state' => 'fail', 'message' => '[操作失败]', 'html' => '', '__error' => '',);
                    }
                } else {
                    $data = array('statusCode' => '300', 'refresh' => false, 'state' => 'fail', 'message' => '[操作失败]', 'html' => '', '__error' => '',);
                }
            }
        }

        return response()->json($data);
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
            $imageUrl = config('ftp.url') . $realPath;

            if (!in_array(strtolower($ext), $allowExt)) {
                $data = array('statusCode' => '300', 'refresh' => false, 'state' => 'fail', 'message' => '[非法文件类型]', 'html' => '', '__error' => '',);
            } else {
                if (Storage::disk('ftp')->put($realPath, file_get_contents($realFile))) {
                    $fileModel = new Image();
                    $fileModel->file_name = $_FILES['file']['name'];
                    $fileModel->real_name = $realName;
                    $fileModel->path = $uploadRealPath;
                    $fileModel->position = $realPath;
                    $fileModel->url = $imageUrl;
                    $fileModel->size = $_FILES['file']['size'];
                    $fileModel->status = 1;
                    $fileModel->user_id = $user_id;

                    if( $fileModel->save()){
                        $this->dispatch(new AddImage($fileModel->id));
                    }

                    $fileData = array('filename' => $_FILES['file']['name'], 'fileId' => $fileModel->id, 'url' => $imageUrl);
                    $data = array('statusCode' => '200', 'refresh' => false, 'state' => 'success', 'message' => '[操作成功]', 'data' => $fileData, 'html' => '', '__error' => '');
                } else {
                    $data = array('statusCode' => '300', 'refresh' => false, 'state' => 'fail', 'message' => '[操作失败]', 'html' => '', '__error' => '',);
                }
            }
            return response()->json($data);
        }
    }


    public function articleimg(Request $request){
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
            $imageUrl = config('ftp.url') . $realPath;

            if (!in_array(strtolower($ext), $allowExt)) {
                $data = array('code' => '1', 'refresh' => false, 'state' => 'fail', 'msg' => '[非法文件类型]', 'html' => '', '__error' => '',);
            } else {
                //1,文件上传到本地
                Storage::disk('public')->put($localPath, file_get_contents($realFile));

                //2,对文件处理,加水印,固定图片大小
                $water = public_path('assets/frontend/index/web/images/water.png');
                $real_local_path = storage_path('app/public'.DIRECTORY_SEPARATOR.$localPath);
                $image_save_path = storage_path('app/public'.DIRECTORY_SEPARATOR.$realPath);
                ImageManager::make($real_local_path)
                    ->resize(500, null,function ($constraint) {$constraint->aspectRatio();})
                    ->insert($water, 'bottom-right', 5, 5)
                    ->save($image_save_path);

                //3,上传到ftp服务器
                if (Storage::disk('ftp')->put($realPath, file_get_contents($image_save_path))) {
                    $fileModel = new Image();
                    $fileModel->file_name = $_FILES['file']['name'];
                    $fileModel->real_name = $realName;
                    $fileModel->path = $uploadRealPath;
                    $fileModel->position = $realPath;
                    $fileModel->url = $imageUrl;
                    $fileModel->size = $_FILES['file']['size'];
                    $fileModel->status = 1;
                    $fileModel->user_id = $user_id;
                    if( $fileModel->save()){
                        $this->dispatch(new AddImage($fileModel->id));
                    }
                    $fileData = array('filename' => $_FILES['file']['name'], 'fileId' => $fileModel->id, 'src' => $imageUrl);
                    $data = array('code' => '0', 'refresh' => false, 'state' => 'success', 'msg' => '[操作成功]', 'data' => $fileData, 'html' => '', '__error' => '');
                } else {
                    $data = array('code' => '1', 'refresh' => false, 'state' => 'fail', 'msg' => '[操作失败]', 'html' => '', '__error' => '',);
                }

                //4,删除本地图片文件
                Storage::disk('public')->delete($localPath);
                Storage::disk('public')->delete($realPath);

            }
            return response()->json($data);
        }



//
//
//        $uploadRealPath = 'uploads/images/' . date('Y', time()) . date('m', time()) . date('d', time());
//        $file = $request->file('file');
//        $realFile = $file->getRealPath();
//        $ext = $file->getClientOriginalExtension();//临时文件的绝对路径
//        $type = $file->getClientMimeType();     // image/jpeg
//        $originalName = $file->getClientOriginalName(); // 文件原名
//
//        $realName = md5(uniqid(microtime(true), true)) . '.' . $ext;
//        $realPath = $uploadRealPath . DIRECTORY_SEPARATOR . $realName;
//        $allowExt = array('jpeg', 'jpg', 'gif', 'png');
//        $imageUrl = config('ftp.url') . $realPath;
//
//        Storage::disk('public')->put($realPath, file_get_contents($realFile));
//
//        Storage::disk('public')->delete('file.jpg');
//
//        $real_local_path = storage_path('app/public'.DIRECTORY_SEPARATOR.$realPath);
//
//        /**
//         * 上传到图片服务器
//         */
//        if (Storage::disk('ftp')->put($realPath, file_get_contents($realFile))) {
//            $fileModel = new Image();
//            $fileModel->file_name = $_FILES['file']['name'];
//            $fileModel->real_name = $realName;
//            $fileModel->path = $uploadRealPath;
//            $fileModel->position = $realPath;
//            $fileModel->url = $imageUrl;
//            $fileModel->size = $_FILES['file']['size'];
//            $fileModel->status = 1;
//            $fileModel->user_id = $user_id;
//            $fileModel->save();
//            ImagesStore::add($fileModel);
//            $fileData = array('filename' => $_FILES['file']['name'], 'fileId' => $fileModel->id, 'src' => $imageUrl);
//            $data = array('code' => '0', 'refresh' => false, 'state' => 'success', 'msg' => '[操作成功]', 'data' => $fileData, 'html' => '', '__error' => '');
//        } else {
//            $data = array('code' => '1', 'refresh' => false, 'state' => 'fail', 'msg' => '[操作失败]', 'html' => '', '__error' => '',);
//        }
//
//        //删除本地图片
//        if (file_exists($realPath)) {
//            \unlink($realPath);
//        }

    }
}
