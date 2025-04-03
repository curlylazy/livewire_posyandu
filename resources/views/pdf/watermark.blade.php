<style>
    #watermark {
        position: fixed;

        /**
            Set a position in the page for your image
            This should center it vertically
        **/
        bottom:   10cm;
        left:     3cm;

        /** Change image dimensions**/
        width:    8cm;
        height:   8cm;

        /** Your watermark should be behind every content**/
        z-index:  -1000;
    }
</style>

<div id="watermark">
    <img src="{{ public_path('logo.png') }}" style="opacity: 0.1;" height="500" width="500" />
</div>
