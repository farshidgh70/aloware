<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use App\Traits\CommentTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;



class ApiController extends Controller
{
    use CommentTrait;

    public function NewComment()
    {
        try {
            $validator = Validator::make(request()->all(), [
                "content" => "required|max:1000",
                "parent" => "integer",
                "o" => "integer",
                "type" => "required|max:50",
            ]);
            if ($validator->fails()) {
                return response()->json([
                    'success' => false, 
                    "message" => "Incorrect inputs!"
                ]);
            }

            $type = request('type');
            $parent_id = request('parent');
            $object_id = request('o');

            // check type
            if(!in_array($type, ["article", "product"])){
                return response()->json(['success' => false, 'message' => 'Error 22322!']);
            }
            // check parent
            if($parent_id){
                if($parent_id != 0){
                    $e_comments = Comment::find($parent_id);
                    if(!$e_comments){
                        return response()->json(['success' => false, 'message' => 'Parent not found!']);
                    }
                }
            }
            // check object
            $morph = null;
            switch($type){
                case 'article':
                    $morph = Post::find($object_id);
                    break;
                // case 'product':
                //     $morph = Product::find($object_id);
                //     break;
            }
            if(!$morph){
                return response()->json(['success' => false, 'message' => 'Can not find post!']);
            }

            $item = new Comment();
            $item->parent_id = $parent_id;
            $item->commentable()->associate($morph);
            $item->name = request('name');
            $item->content = request('content');
            $item->ip = request()->ip();
            $item->save();

            return response()->json(['success' => true]);
        }
        catch(\Exception $ex){
            return response()->json(['success' => false, 'message' => 'error!']);
        }
    }

    public function Comments($type,$id)
    {
        try{
            $result = [];
            $item = null;

            switch($type){
                case 'article':
                    $item = Post::find($id);
                    break;
            }
            if(!$item){
                return response()->json(['success' => false, 'message' => 'Post not found!']);
            }
            if($Q_comments = $item->comments()->orderBy("id","desc")->get()){
                $result = $this->getJsonComments($Q_comments->toArray());
            }

            return response()->json(['success' => true, 'result' => $result]);
        }
        catch(\Exception $ex){return $ex;
            return response()->json(['success' => false, 'message' => 'Can not fetch data!']);
        }
    }
}
