<style type="text/css">

    @font-face {
        font-family: 'BaliSimbar';
        src: url({{ storage_path('fonts\balisimbar.TTF') }}) format("truetype");
        font-weight: 400;
        font-style: normal;
    }

    @font-face {
        font-family: 'karla';
        src: url({{ storage_path('fonts\karla.ttf') }}) format("truetype");
        font-weight: 400;
        font-style: normal;
    }

    .font-balisimbar{
        text-align: center;
        font-family: 'BaliSimbar';
        font-size: 20pt;
    }

    .font-normal{
        font-family: 'karla';
        text-align: center;
        font-size: 12pt;
    }

    .logo-header {
        position: absolute;
        left: 20px;
        top: 0px;
    }

</style>

<div>
    <img src="{{ public_path("logo.png") }}" style="float: left;" height="70" />
    <div style="margin-bottom: 10px; text-align: right;">
        <span class="font-normal" style="font-size: 18pt; font-weight: bold;">{{ config('app.webname') }}</span><br />
        <span class="font-normal" style="font-size: 11pt;">{{ config('app.alamat') }} {{ config('app.alamat2') }}</span><br />
        <span class="font-normal" style="font-size: 13pt;">{{ $pageTitle }}</span><br />
    </div>
    <hr />
</div>
