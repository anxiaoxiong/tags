@component('mail::message')
# 【医衡中央随机化系统】收货通知


订单号{{$data['order_id']}}已经接收，请您及时查看。

======================================================
@component('mail::panel')
**项目名称**：      {{$data['name']}}

**申办方名称**：    {{$data['sponsor']}}

**收货时间**：      {{$data['time']}}

**收货单位**：      {{$data['receiver']}}

**收货人**：        {{$data['conductor']}}
@endcomponent
======================================================

注：此邮件为系统自动发送，请勿回复。
@endcomponent
