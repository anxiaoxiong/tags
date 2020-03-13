<html>
    <head>
        <title>受试者清单</title>
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
            img {
                width: 100%;
            }
        </style>
    </head>
    <body>
        <htmlpageheader name="page-header">
            <table style="border-bottom: 1px solid #000000; font-size: 9pt; padding-bottom: 3mm; overflow: hidden; width: 100%;">
                <tbody>
                    <tr>
                        <td style="text-align: left;">
                            <span style="float: left; text-overflow: ellipsis; white-space: nowrap; overflow: hidden;" align="left">
                                项目：{{ $project['name'] }}
                            </span>
                        </td>
                        <td style="text-align: right; width: 6cm;">
                            <span style="float: left;" align="left">
                               创建时间：{{ date('Y-m-d H:i:s') }}
                            </span>
                        </td>
                    </tr>
                </tbody>
            </table>
        </htmlpageheader>
        <div class="content">
            @foreach ($pics as $pic)
                <img src="{{ $pic }}" />
            @endforeach
        </div>
        <htmlpagefooter name="page-footer">
            <table style="font-size: 14pt; text-align: center; padding-top: 3mm;">
                <tbody>
                    <tr>
                        <td style="text-align: left;">
                        </td>
                        <td style="width: 4cm; text-align: left;">
                            <p>签字：</p>
                            <p>时间：</p>
                        </td>
                    </tr>
                </tbody>
            </table>
            <footer align="center">Page {PAGENO} | {nbpg}</footer>
        </htmlpagefooter>
    </body>
</html>