<html>
    <head>
        <title>交接清单</title>
        <style rel="stylesheet">
            @page {
                margin-top: 2.5cm;
                margin-bottom: 2.5cm;
                margin-left: 2cm;
                margin-right: 2cm;
                header: page-header;
                footer: page-footer;
            }
            body {
                font-family: 'ymfont', sans-serif;
            }
            th {
                background: #2a2a2a;
                color: white;
                font-size: 16px;
            }
            td {
                font-size: 14px;
                text-align: center;
            }
            table {
                margin-left: auto;
                margin-right: auto;
                width: 100%;
            }
            .content .title {
                text-align: center
            }
        </style>
    </head>
    <body>
        <htmlpageheader name="page-header">
            <table style="border-bottom: 1px solid #000000; font-size: 9pt; padding-bottom: 3mm; overflow: hidden;">
                <tbody>
                    <tr>
                        <td style="text-align: left;">
                            <span style="float: left; text-overflow: ellipsis; white-space: nowrap; overflow: hidden;" align="left">
                                项目：{{ $project['name'] }}
                            </span>
                        </td>
                        <td style="text-align: right; width: 6cm;">
                            <span style="float: left;" align="left">
                               打印时间：{{ date('Y-m-d H:i:s') }}
                            </span>
                        </td>
                    </tr>
                </tbody>
            </table>
        </htmlpageheader>
        <div class="content">
            <div class="title"><h2>交接清单</h2></div>
            <h4 class="fl">项目信息</h4>
            <table style="overflow: hidden;">
                <tbody>
                    <tr>
                        <td style="text-align: left;">
                            <span style="float: left; text-overflow: ellipsis; white-space: nowrap; overflow: hidden;" align="left">
                                申办方：{{ $project['sponsorinfo']['name'] }}
                            </span>
                        </td>
                    </tr>
                    <tr>
                        <td style="text-align: left;">
                            <span style="float: left; text-overflow: ellipsis; white-space: nowrap; overflow: hidden;" align="left">
                                项目名称：{{ $project['name'] }}
                            </span>
                        </td>
                    </tr>
                    <tr>
                        <td style="text-align: left;">
                            <span style="float: left; text-overflow: ellipsis; white-space: nowrap; overflow: hidden;" align="left">
                                临床试验方案号：{{ $project['scheme_no'] }}
                            </span>
                        </td>
                    </tr>
                    <tr>
                        <td style="text-align: left;">
                            <span style="float: left; text-overflow: ellipsis; white-space: nowrap; overflow: hidden;" align="left">
                                项目编号：{{ $project['number'] }}
                            </span>
                        </td>
                    </tr>
                    <tr>
                        <td style="text-align: left;">
                            <span style="float: left; text-overflow: ellipsis; white-space: nowrap; overflow: hidden;" align="left">
                                样本量：{{ $project['sample'] }}
                            </span>
                        </td>
                    </tr>
                    <tr>
                        <td style="text-align: left;">
                            <span style="float: left; text-overflow: ellipsis; white-space: nowrap; overflow: hidden;" align="left">
                                开始时间：{{ date('Y-m-d', strtotime($project['start_at'])) }}
                            </span>
                        </td>
                    </tr>
                    <tr>
                        <td style="text-align: left;">
                            <span style="float: left; text-overflow: ellipsis; white-space: nowrap; overflow: hidden;" align="left">
                                有效期：{{ $project['duration'] }}月
                            </span>
                        </td>
                    </tr>
                </tbody>
            </table>
            <h4 class="fl">运单信息</h4>
            <table>
                <thead>
                    <tr>
                        <th scope="col" width="10%">发货人</th>
                        <th scope="col" width="20%">收货单位</th>
                        <th scope="col" width="10%">收货人</th>
                        <th scope="col" width="10%">联系电话</th>
                        <th scope="col" width="15%">收货地址</th>
                        <th scope="col" width="15%">快递公司</th>
                        <th scope="col" width="15%">运单号</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>{{ $basic['conductor'] }}</td>
                        <td>{{ $basic['receiver'] }}</td>
                        <td>{{ $basic['contacter'] }}</td>
                        <td>{{ $basic['phone'] }}</td>
                        <td>{{ $basic['address'] }}</td>
                        <td>{{ $basic['express'] }}</td>
                        <td>{{ $basic['express_num'] }}</td>
                    </tr>
                </tbody>
            </table>
            <h4 class="fl">详细信息</h4>
            <table class="table">
                <thead class="thead-light">
                    <tr>
                        <th scope="col" width="15%">药物号</th>
                        <th scope="col" width="15%">批号</th>
                        <th scope="col" width="15%">产品类型</th>
                        <th scope="col" width="20%">有效期</th>
                        <th scope="col" width="15%">状态</th>
                        <th scope="col" width="20%">作废原因</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($products as $product)
                    <tr>
                        <td>{{ $product['number'] }}</td>
                        <td>{{ $product['batch'] }}</td>
                        <td>{{ config('define.product.type.'.$product['type']) }}</td>
                        <td>{{ date('Y-m-d', strtotime($product['expire_in'])) }}</td>
                        <td>{{ config('status.drug.'.$product['status']) }}</td>
                        <td>
                            @if ($product['remark'])
                            {{ $product['remark'] }}
                            @else
                            ---
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <htmlpagefooter name="page-footer">
            <table style="border-top: 1px solid #000000; font-size: 9pt; text-align: center; padding-top: 3mm;">
                <tbody>
                    <tr>
                        <td style="text-align: left;">
                            <p>发货人：</p>
                            <p>发货时间：</p>
                        </td>
                        <td style="width: 4cm; text-align: left;">
                            <p>收货人：</p>
                            <p>收货时间：</p>
                        </td>
                    </tr>
                </tbody>
            </table>
            <footer align="center">Page {PAGENO} | {nbpg}</footer>
        </htmlpagefooter>
    </body>
</html>