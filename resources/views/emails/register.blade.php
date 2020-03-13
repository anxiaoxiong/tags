@component('mail::message')
尊敬的先生/女士:

&nbsp;&nbsp;&nbsp;&nbsp;您好，医墨医衡产品与物流管理系统邀请您注册。您在医衡系统注册地址为:

{{ $data['url'] }}

@component('mail::button', ['url' => $data['url']])
点击激活
@endcomponent

请点击以上按钮或复制链接进行激活，并妥善管理您的登录名和密码。

注：此邮件为系统自动发送，请勿回复。

@endcomponent
