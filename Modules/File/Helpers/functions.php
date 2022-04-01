<?php

if(!function_exists('file_show')){
    function file_show($filename){
        if(Storage::exists($filename)){
            return response()->download(storage_path('app/'.$filename),null,[],null);
        }
        return abort(404);
    }
}

if(!function_exists('file_open')){
    function file_open($filename){
        if(Storage::exists($filename)){
        }
        return abort(404);
        // return response()->streamDownload(function () {
        //     echo GitHub::api('repo')
        //                 ->contents()
        //                 ->readme('laravel', 'laravel')['contents'];
        // }, 'laravel-readme.md');
    }
}

if(!function_exists('file_download')){
    function file_download($filename){
        if(Storage::exists($filename)){
            return response()->download(storage_path('app/'.$filename));
        }
        return abort(404);
    }
}


// if(!function_exists('file_public_show')){
//     function file_public_show($filename){
//         if(Storage::exists($filename)){
//             return route('file.public.show',$filename);
//         }
//         return abort(404);
//     }
// }

// if(!function_exists('file_public_open')){
//     function file_public_open($filename){
//         if(Storage::exists($filename)){
//             return route('file.public.open',$filename);
//         }
//         return abort(404);
//     }
// }

// if(!function_exists('file_public_download')){
//     function file_public_download($filename){
//         if(Storage::exists($filename)){
//             return route('file.public.download',$filename);
//         }
//         return abort(404);
//     }
// }

// if(!function_exists('file_private_show')){
//     function file_private_show($filename){
//         if(Auth::check())
//         {
//             if(Storage::exists($filename)){
//                 return route('file.private.show',$filename);
//             }
//             return abort(404);
//         }
//         return abort(403);
//     }
// }

// if(!function_exists('file_private_open')){
//     function file_private_open($filename){
//         if(Auth::check())
//         {
//             if(Storage::exists($filename)){
//                 return route('file.private.open',$filename);
//             }
//             return abort(404);
//         }
//         return abort(403);
//     }
// }

// if(!function_exists('file_private_download')){
//     function file_private_download($filename){
//         if(Auth::check())
//         {
//             if(Storage::exists($filename)){
//                 return route('file.private.download',$filename);
//             }
//             return abort(404);
//         }
//         return abort(403);
//    }
// }