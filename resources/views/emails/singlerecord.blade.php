@component('mail::message')
# 【医衡中央随机化系统】单组登记结果


======================================================
@component('mail::panel')

**项目名称**：  【{{ $data['name'] }}】

**申办方名称**：【{{ $data['sponsor'] }}】

@endcomponent
======================================================
@component('mail::panel')
**受试者姓名缩写**：  {{ $data['abbr'] }}

**生日**：          {{ $data['birthday'] }}

**筛选号**：        {{ $data['filter_num'] }}

**性别**：          {{ $data['gender'] }}

**登记号**：        {{ $data['sequence'] }}
@endcomponent
======================================================
@component('mail::panel')
**时间**：     {{ $data['record_at'] }}

**研究中心**：  {{ $data['organization'] }}

**研究者**：   {{ $data['conductor'] }}
@endcomponent
======================================================


注：此邮件为系统自动发送，请勿回复。
@endcomponent
