@component('mail::message')
# 【医衡中央随机化系统】紧急揭盲通知


======================================================
@component('mail::panel')
**项目名称**：   【{{ $data['name'] }}】

**申办方名称**： 【{{ $data['sponsor'] }}】
@endcomponent
======================================================
@component('mail::panel')
受试者**{{ $data['abbr'] }}**已经揭盲，请您及时查看
@endcomponent

注：此邮件为系统自动发送，请勿回复。
@endcomponent
