@component('mail::message')
# 【医衡中央随机化系统】密码修改通知


======================================================
@component('mail::panel')
您的密码已经修改，操作时间为:{{$data['time']}}
@endcomponent
======================================================

注：此邮件为系统自动发送，请勿回复。

@endcomponent
