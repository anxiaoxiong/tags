@component('mail::message')
# 【医衡中央随机化系统】项目关联通知通知


======================================================
@component('mail::panel')
尊敬的用户您好，您已经关联至《{{$data['project']}}》项目当中，请及时登录系统查看
@endcomponent
======================================================

注：此邮件为系统自动发送，请勿回复。

@endcomponent
