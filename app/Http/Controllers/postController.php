<?php

namespace App\Http\Controllers;

use App\Models\follow;
use App\Models\Post;
use App\Models\PostLikeDislike;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use PHPUnit\Framework\Constraint\Count;

class postController extends Controller
{

    public function following()
    {

        $id  = Auth::user()->id;
        $data = follow::where("userid", $id)->get()->toArray();
        $userdata = [];

        for ($i = 0; $i < count($data); $i++) {
            $following_id = $data[$i]['you_foloow'];
            $user = User::where("id", $following_id)->get()->toArray();
            array_push($userdata, $user);
        }

        return view("following")->with(compact("userdata"));
    }



    public function Followers()
    {

        $id  = Auth::user()->id;
        $data = follow::where("you_foloow", $id)->get()->toArray();
        $userdata = [];

        for ($i = 0; $i < count($data); $i++) {
            $Followers_id = $data[$i]['userid'];
            $user = User::where("id", $Followers_id)->get()->toArray();
            array_push($userdata, $user);
        }

        return view("Followers")->with(compact("userdata"));
    }

    public function people_post()
    {

        //         $userId = Auth::user()->id;

        // $users = DB::table('users')
        //     ->select('users.*', 'post.*' , 'follows.*', 'post_like_dislike.*')
        //     ->leftJoin('post', 'users.id', '=', 'post.userid')
        //     ->leftJoin('follows', 'users.id', '=', 'follows.you_foloow')
        //     ->leftJoin('post_like_dislike', 'users.id', '=', 'post_like_dislike.userid')
        //     ->where('users.id', '=', $userId)
        //     ->get()->toArray();

        //     echo '<pre>';
        //     print_r($users);
        //     die;


        $id  = Auth::user()->id;
        $data = follow::where("userid", $id)->get()->toArray();

        $allid = [];
        for ($i = 0; $i < count($data); $i++) {
            $following_id = $data[$i]['you_foloow'];
            array_push($allid, $following_id);
        }
        $ConfirmData = [];

        for ($i = 0; $i < count($allid); $i++) {
            $userpost = Post::where("userid", $allid[$i])->get()->toArray();
            array_push($ConfirmData, $userpost);
        }

        $user = [];
        for ($i = 0; $i < count($allid); $i++) {
            $userdetail = User::where("id", $allid[$i])->get()->toArray();
            array_push($user, $userdetail);
        }

        $likedata = PostLikeDislike::where("userid", Auth::user()->id)->get()->ToArray();


        return view("people_post")->with(compact("ConfirmData", "user", "likedata"));
    }




    public function alluser_list()
    {
        $alluser =  User::all()->toArray();

        // $q = "SELECT * FROM `users` WHERE `id` NOT IN( SELECT `you_foloow` FROM `follows`) ";
        // $results = DB::table('users')
        // ->whereNotIn('id', function($query) {
        //     $query->select('you_foloow')->from('follows');
        // })
        // ->get()->toArray();

        $results = DB::table('users')
            ->whereNotIn('id', function ($query) {
                $query->select('you_foloow')
                    ->from('follows')
                    ->where('userid', Auth::user()->id);
            })
            ->where('id', '!=', Auth::user()->id)
            ->get()
            ->toArray();



        return view("explore")->with(compact("results"));
    }


    public function addto_you_foloow(Request $request)
    {

        $userid = $request->all()['id'];
        $curruntuserid = Auth::user()->id;
        $responce['status'] = 0;

        if (follow::create([
            "userid" => $curruntuserid,
            "you_foloow" => $userid,
            "who_follow_you" => 0,
        ])) {
            $responce['status'] = 0;
            $responce['msg'] = "Followed";
            return $responce;
        } else {
            $responce['status'] = 1;
            $responce['msg'] = "Finding Some Error";
            return $responce;
        }
    }








    public function add(Request $request)
    {
        $userid = Auth::user()->id;


        $requestData = $request->all();
        if ($requestData['hid'] > 0) {
            $responce['status'] = 0;

            $tododata = Post::find($requestData['hid']);
            if ($tododata->update([
                'title' => $requestData['title'],
                'post' => $requestData['post'],
            ])) {
                $responce['status'] = 0;
                $responce['msg'] = "Post Updated Succsessfully";
                return $responce;
            } else {
                $responce['status'] = 1;
                $responce['msg'] = "Finding Some Error";
                return $responce;
            }
        } else {
            $responce['status'] = 0;


            if (Post::create([
                'userid' => $userid,
                'title' => $requestData['title'],
                'post' => $requestData['post'],
            ])) {
                $responce['status'] = 0;
                $responce['msg'] = "Post Added Succsessfully";
                return $responce;
            } else {
                $responce['status'] = 1;
                $responce['msg'] = "Finding Some Error";
                return $responce;
            }
        }
    }




    public function list()
    {
        $userid = Auth::user()->id;
        $post = Post::where("userid", $userid)->get()->toArray();
        return view("list")->with(compact('post'));
    }


    public function delete(Request $request)
    {


        $id = $request->all()['id'];

        $responce['status'] = 0;

        if (Post::find($id)->delete()) {
            $responce['status'] = 0;
            $responce['msg'] = "Post Deleted Succsessfully";
            return $responce;
        } else {
            $responce['status'] = 1;
            $responce['msg'] = "Finding Some Error";
            return $responce;
        }
    }




    function edit(Request $request)
    {


        $post = $request->all();
        $editId = $post["id"];
        $data = Post::find($editId);

        return $data;
    }




    public function like(Request $request)
    {
        $id = $request->all()['id'];
        $postlike = PostLikeDislike::where("postid", $id)
            ->where("userid", "=", Auth::user()->id)
            ->get()
            ->toArray();


        if (empty($postlike)) {
            if (PostLikeDislike::create([
                'postid' => $id,
                'like_dislike_status' => 0,
                'userid' => Auth::user()->id,
            ])) {
                $responce['status'] = 0;
                $responce['msg'] = "You Liked";
                return $responce;
            } else {
                $responce['status'] = 1;
                $responce['msg'] = "Finding Some Error";
                return $responce;
            }
        } else {
            $postlike = PostLikeDislike::where("postid", $id);


            if ($postlike->update([
                'like_dislike_status' => 0,
            ])) {
                $responce['status'] = 0;
                $responce['msg'] = "You unliked";
                return $responce;
            } else {
                $responce['status'] = 1;
                $responce['msg'] = "Finding Some Error";
                return $responce;
            }
        }
    }






    public function dislike(Request $request)
    {
        $id = $request->all()['id'];
        $postlike = PostLikeDislike::where("postid", $id);


        if ($postlike->update([
            'like_dislike_status' => 1,
        ])) {
            $responce['status'] = 0;
            $responce['msg'] = "You unliked";
            return $responce;
        } else {
            $responce['status'] = 1;
            $responce['msg'] = "Finding Some Error";
            return $responce;
        }
    }
}
