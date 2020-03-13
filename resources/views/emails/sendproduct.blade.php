@component('mail::message')
# 【医衡中央随机化系统】发货通知


有一批待收货物(订单号：{{$data['order_id']}})，请您及时查看。

======================================================
@component('mail::panel')
**项目名称**：      {{$data['name']}}

**申办方名称**：    {{$data['sponsor']}}

**发货时间**：      {{$data['time']}}

**发货人**：        {{$data['conductor']}}

**收货单位**：      {{$data['receiver']}}
@endcomponent
======================================================

注：此邮件为系统自动发送，请勿回复。
@endcomponent
