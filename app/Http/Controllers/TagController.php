<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Tag;

class TagController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $return = Tag::select('id','name','individual_id')->get();
        return $this->success('获取成功', $return);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
                'name' => 'bail|required|string',
                'individual_id' => 'bail|nullable|integer',
                ], [
                'name.required' => '请填写标签名',
                'name.string' => '标签名格式不正确',
                'individual_id.integer'=>'所属ID必须是整数',
                ]);
        if ($validator->fails()) {
            $message = $validator->errors();
            return $this->error(405, $message->first());
        }
        $res = Tag::create(
                [
                'name'=>$request->name,
                'individual_id'=>$request->individual_id??0
                ]
                );
        if ($res) {
            return $this->success("添加成功", $res);
        } else {
            return $this->error(405, "添加失败");
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if(!intval($id)){
            return $this->error(405, "tag的ID错误");
        }
        $return = Tag::select('id','name','individual_id')->find($id);
        return $this->success("获取成功", $return??[]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update($id,Request $request)
    {
        if(!intval($id)){
            return $this->error(405, "tag的ID错误");
        }
        $validator = Validator::make($request->all(), [
                'name' => 'bail|required|string',
                'individual_id' => 'bail|nullable|integer',
                ], [
                'name.required' => '请填写标签名',
                'name.string' => '标签名格式不正确',
                'individual_id.integer'=>'所属ID必须是整数',
                ]);
        if ($validator->fails()) {
            $message = $validator->errors();
            return $this->error(405, $message->first());
        }
        //判断id是否存在
        $tag = Tag::find($id);
        if(!$tag){
            return $this->error(405, "tag不存在");
        }
        $tag->name = $request->name;
        $tag->individual_id = $request->individual_id;
        if ($tag->save()) {
            return $this->success("修改成功");
        } else {
            return $this->error(405, "修改失败");
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        if(!intval($id)){
            return $this->error(405, "tag的ID错误");
        }
        //判断id是否存在
        $tag = Tag::find($id);
        if(!$tag){
            return $this->error(405, "tag不存在");
        }
        if ($tag->delete()) {
            return $this->success("删除成功");
        } else {
            return $this->error(405, "删除失败");
        }
    }
}
