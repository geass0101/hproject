<?php

namespace App\Api\Controllers;

use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;

class MessagesController extends BaseController
{
    public function createMessage(Request $request)
    {
        $message = new Message;
        $message->body = $request->body;
        $message->ori = JWTAuth::parseToken()->authenticate()->id;
        $message->des = $request->des;
        $idconv = Message::where('ori', $message->ori)->orwhere('ori', $message->des)
            ->where('des', $message->ori)->orwhere('des', $message->des);
        if (isset($idconv)) {
            $message->idconversation = $idconv;
        } else {
            $id = Message::order_by('idconversation', 'desc')->first()->idconversation;
            if (isset($id)) {
                $idconv = $id + 1;
            } else {
                $idconv = 1;
            }
            $message->idconversation = $idconv;

        }
        $message->type = $request->type;
        $message->save();
    }

    public function getMessages(Request $request)
    {
        $idconv = Message::where('ori', $request->ori)->orwhere('ori', $request->des)
            ->where('des', $request->ori)->orwhere('des', $request->des);
        $messages = Message::where('idconversation', $idconv)->order_by('created_at')->get();
        return $messages;

    }
}
