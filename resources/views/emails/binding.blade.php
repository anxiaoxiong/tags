@component('mail::message')
尊敬的先生/女士:

&nbsp;&nbsp;&nbsp;&nbsp;您好，医墨医衡产品与物流管理系统正在绑定邮箱。您在医衡系统绑定邮箱地址为:

{{ $data['url'] }}

@component('mail::button', ['url' => $data['url']])
绑定邮箱
@endcomponent

请点击以上按钮或复制链接绑定您的邮箱。

注：此邮件为系统自动发送，请勿回复。

@endcomponent
