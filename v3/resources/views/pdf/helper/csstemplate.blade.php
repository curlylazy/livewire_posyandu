<style type="text/css">

    @font-face {
        font-family: 'Times New Roman';
        src: url({{ storage_path('fonts\tnr.ttf') }}) format("truetype");
        font-weight: 400;
        font-style: normal;
    }

    @font-face {
        font-family: 'karla';
        src: url({{ storage_path('fonts\karla.ttf') }}) format("truetype");
        font-weight: 400;
        font-style: normal;
    }

    body {
        font-family: 'karla', Times, serif;
    }

    td {
        vertical-align: top;
    }

    .p-ket {
        text-indent: 50px !important;
        padding-top: 20px;
        text-align: justify;
    }

    #watermark {
        position: fixed;

        /**
            Set a position in the page for your image
            This should center it vertically
        **/
        bottom:   2cm;
        left:     7cm;

        /** Change image dimensions**/
        width:    8cm;
        /* height:   8cm; */

        /** Your watermark should be behind every content**/
        z-index:  -1000;
    }

    #watermark_landscape {
        position: fixed;

        /**
            Set a position in the page for your image
            This should center it vertically
        **/
        bottom:   9cm;
        left:     8cm;

        /** Change image dimensions**/
        width:    8cm;
        height:   8cm;

        /** Your watermark should be behind every content**/
        z-index:  -1000;
    }

    .center {
        font-family: 'Times New Roman', Times, serif;
        margin: auto;
        width: 90%;
        padding: 10px;
    }

    .table-center {
        margin-left: auto;
        margin-right: auto;
        width: 500px;
    }

    .table-detail tr:nth-child(even){ background-color: #f2f2f2; }

    .table-detail tr:hover {background-color: #ddd;}

    .table-detail td {
        font-size: 9pt;
    }

    .table-detail th {
        padding-top: 12px;
        padding-bottom: 12px;
        font-size: 9pt;
        text-align: left;
        background-color: #2f66ff;
        color: white;
    }

    .page_break { page-break-before: always; }

</style>
