<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Geburtstagsliste</title>
    {{--    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">--}}
    <style>
        @page {
            padding: 0;
            margin: 0;
            size: 255.118pt 107.717pt landscape;
        }

        @media dompdf {
            * {
                line-height: 1;
            }
        }

        body {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        /*table tr td {
            !*font-size: 10px;*!
        }*/
    </style>
</head>
<body>
<div style="max-width: 255.118pt; max-height: 107.717pt;">
    <table>
        <tr>
            <td>
                <img src="https://via.placeholder.com/1024" alt="" style="height: 20mm; width: 20mm; object-fit: cover; object-position: center center;">
            </td>
            <td style="vertical-align: top; text-overflow: ellipsis; overflow: hidden; white-space: nowrap; max-width: 252px;">
                <span style="font-weight: bold;">{{ $lager->artikels->art_name }}</span>
                <div style="padding-top: 10px; padding-bottom: 10px; font-size: small;">{{ 'Art. Nr.: '. $lager->artikels->art_nr }}</div>
                <table cellpadding="0" cellspacing="0">
                    <tr style="padding-top: 10px; max-width: 252px;">
                        <td style="width: 100px;">Min: <b>{{ $lager->la_min }}</b></td>
                        <td style="width: 100px;">Max: <b>{{ $lager->la_max }}</b></td>
                        <td style="font-size: small; width: 52px; text-align: center;">{{ $lager->artikels->art_einheit }}</td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td style="text-align: center;">
                <img src="data:image/png;base64, {!! base64_encode(QrCode::format('png')->size(57)->generate(route('backend.artikel.show', $lager->artikel_id))) !!} " alt="">
            </td>
            <td>
                <table cellspacing="0" cellpadding="0">
                    <tr style="max-width: 252px;">
                        <td style="font-size: small;">Lagerort: {{ $lager->la_lagerort }}</td>
                    </tr>
                    <tr style="max-width: 252px;">
                        <td style="font-size: small;">Nachbestellmenge: {{ $lager->la_min . ' ' . $lager->artikels->art_einheit }}</td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</div>
</body>
</html>
