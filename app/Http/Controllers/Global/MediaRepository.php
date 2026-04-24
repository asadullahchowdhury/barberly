<?php


namespace App\Http\Controllers\Global;

use App\Models\Media;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\ImageManager;

class MediaRepository
{
    /**
     * @param $file
     * @param string $type
     * @param null $filename
     * @return string|null
     */
    public static function Upload($request)
    {
        try {
            $input = $request->all();
            $validator = Validator::make($input, [
                'file' =>  'required|file',
                'media_type' => 'required|integer', //1.image 2. video 3. file
                'media_use' => 'nullable|integer'  //1.Avatar
            ]);
            if ($validator->fails()) {
                return ['status' => 500, 'error' => $validator->errors()];
            }
            $image_file = $request->file('file');
            $attrs = array(
                'filename' => $image_file->getClientOriginalName(),
                'extension' => $image_file->getClientOriginalExtension(),
                'size' => $image_file->getSize(),
                'mimeType' => $image_file->getMimeType()
            );
            if ($input['media_type'] == 1) {
                $filePath = Storage::disk('public')->put('/media/image', $input['file']);
            } else {
                $file_name = time().'-'.strtolower(str_replace(' ', '-', $attrs['filename']));
                $filePath = '/media/file/'.$file_name;
                Storage::disk('public')->put($filePath, file_get_contents($image_file));
            }

            /*Image Compress*/
            if($request->media_use == 1){
                $manager = new ImageManager(new Driver());
                $imageData = $manager->read(public_path('storage/' . $filePath));
                $height = $imageData->height();
                $width = $imageData->width();
                if($width >= $height && $width > 150){
                    $imageData->scale(150, null);
                    $imageData->save();
                }else if($height > $width && $height > 150){
                    $imageData->scale(null, 150);
                    $imageData->save();
                }
            }

            $new_name = basename($filePath);
            $MediaModel = new Media();
            $MediaModel->file_path = $new_name;
            $MediaModel->media_type = $input['media_type'];
            $MediaModel->attrs = serialize($attrs);
            $MediaModel->created_at = Carbon::now();
            $MediaModel->save();
            return ['status' => 200, 'data' => $MediaModel->toArray(), 'file_name' => $image_file->getClientOriginalName(),  'msg' => 'Data has been added successfully'];
        } catch (\Exception $e) {
            return ['status' => 500, 'error' => $e->getMessage()];
        }
    }

    public static function dummyAvatar($str)
    {
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://ui-avatars.com/api/?background=rgb(108, 213, 203)&color=fff&font-size=0.30&bold=true&name='.$str,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
        ));
        $response = curl_exec($curl);
        curl_close($curl);
        return $response;
    }

}
