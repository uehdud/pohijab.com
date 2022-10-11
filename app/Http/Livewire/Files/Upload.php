<?php

namespace App\Http\Livewire\Files;

use Log;
use File;
use Storage;
use Exception;
use Illuminate\Support\Facades\Storage as FacadesStorage;
use Livewire\Component;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;

class FileUpload extends Component
{
    public $image;

    public $files = [];

    public $listeners = [
        "single_file_uploaded" => 'singleFileUploaded',
        "add_file" => 'addFile',
        "clear_files" => 'clearFiles',
        "clear_file" => 'clearFile',
    ];

    public $validation_errors = [];

    public function render()
    {
        return view('livewire.files.edit-produk');
    }

    public function singleFileUploaded($file)
    {
        try {
            if($this->getFileInfo($file)["file_type"] == "image"){
                $this->image = $file;
            }else{
                session()->flash("error", "Uploaded file must be an image");
            }
        } catch (Exception $e) {
            
        }
    }

    public function addFile($file)
    {
        try {
            if($this->getFileInfo($file)["file_type"] == "image"){
                array_push($this->files, $file);
            }else{
                session()->flash("error", "Uploaded file must be an image");
            }
        } catch (Exception $e) {
            
        }
    }

    public function clearFile($index)
    {
        unset($this->files[$index]);
    }

    public function clearFiles()
    {
        $this->files = [];
    }

    public function getFileInfo($file)
    {
        $info = [
            "decoded_file" => null,
            "file_meta" => null,
            "file_mime_type" => null,
            "file_type" => null,
            "file_extension" => null,
        ];

        try {
            $info['decoded_file'] = base64_decode(substr($file, strpos($file, ',') + 1));
            $info['file_meta'] = explode(';', $file)[0];
            $info['file_mime_type'] = explode(':', $info['file_meta'])[1];
            $info['file_type'] = explode('/', $info['file_mime_type'])[0];
            $info['file_extension'] = explode('/', $info['file_mime_type'])[1];
        } catch(Exception $e) {

        }

        return $info;
    }

    public function uploadFiles()
    {
        try {

            $rules = [
                'image' => 'required',
                'files' => 'required',
            ];
    
            $messages = [
                "image.required" => "Image must be selected.",
                "files.required" => "Choose atleast one file.",
            ];

            $validator = Validator::make([
                "image" => $this->image,
                "files" => $this->files,
            ], $rules, $messages);

            $validator->after(function ($validator) {

                if($this->getFileInfo($validator->getData()["image"])["file_type"] != "image") {
                    $validator->errors()->add('image', 'File must be an image');   
                }
            });
            
            if($validator->fails()) {
                return $this->validation_errors = $validator->errors()->toArray();
            } else {
                // Single File Upload
                $file_data = $this->getFileInfo($this->image);
                $file_name = Str::random(10).'.'.$file_data['file_extension'];
                $result = FacadesStorage::disk('public')->put($file_name, $file_data['decoded_file']);
                
                // multiple files upload
                foreach($this->files as $value) {
                    $file_data = $this->getFileInfo($value);
                    $file_name = Str::random(10).'.'.$file_data['file_extension'];
                    $result = FacadesStorage::disk('public')->put($file_name, $file_data['decoded_file']);
                }
            }

            session()->flash("success", "Files uploaded successfully.");

            $this->image = null;
            $this->files = [];

        } catch (Exception $e) {
            session()->flash("error", "Files uploading error, please try again.");
        }
    }
}