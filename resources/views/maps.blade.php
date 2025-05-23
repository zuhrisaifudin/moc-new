


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
<head id="ctl00_Head1"><meta name="viewport" content="width=device-width, initial-scale=1" /><title>

</title><link rel="stylesheet" type="text/css" href="https://digio.pgn.co.id/mapjs/MapsComponent/MapsCss/bootstrap.min.css" /><link rel="stylesheet" type="text/css" href="/mapjs/MapsComponent/MapsCss/home.min.css" />
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="Cache-control" content="no-cache">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <meta name="application-name" content="digio">
    <meta name="description" content="Digital Information For Gas Infrastructure Operation">
    <meta name="editor" content="FikriAchmad">
    <link rel="shortcut icon" href="images/favicon_alt.png">

    <link rel="stylesheet" type="text/css" href="https://digio.pgn.co.id/maps/lib/css/all.min.css">
    <link rel="stylesheet" type="text/css" href="https://digio.pgn.co.id/maps/css/digiomaster.css">

    <link rel="stylesheet" type="text/css" href="https://js.arcgis.com/3.33compact/esri/css/esri.css">
    <link rel="stylesheet" type="text/css" href="https://digio.pgn.co.id/mapjs/maps/css/map.css">
    <style type="text/css">
        #floatingPanel{
            position: fixed;
            top: 40px;
            left: 1em;
            z-index: 999;
            height: calc(100% - 2em);
            max-width: 300px;
        }
        .panel-content{
            overflow: auto;
            overflow-x: hidden !important;
            overflow-y: scroll !important;
        }
        .layerControlDijit .layerControlTableCheck .fa-border{
            box-sizing: content-box !important;
        }
        #accordionContainer h3{
            width: 100%;
            color: #ffffff;
            background-color: #082454;
            border-color: #b3b3b3;
        }
       
        .ui-state-active{
            border-color: #b3b3b3;
            background-color: #cac7c7;
            color: inherit;
        }

        .cmvIdentifyPanelWidget .esriPopup .contentPane .header {
            margin-bottom: 20px !important;
            margin-left: 6px;
        }
    </style>
</head>
<body class="bg-color--dark-white">
    <form name="aspnetForm" method="post" action="./moc.aspx?imocid=1" id="aspnetForm">
<div>
<input type="hidden" name="__VIEWSTATE" id="__VIEWSTATE" value="/wEPDwUJNDMyNDU0NjAzZGR6So/O/Ef/eqONFUYlkOHo2d79i2swJnahDynimQt2PA==" />
</div>

<div>

	<input type="hidden" name="__VIEWSTATEGENERATOR" id="__VIEWSTATEGENERATOR" value="9B529B16" />
</div>

                
        

               
        

    </form>
    
    
    <!-- panel buat widget ----------------------------------------------------------------- -->
    <div id="digio-sidepanel" class="active">
        <div id="panelIdentify" class="widgetPanel">
            <div class="panel-header">
                <i class="fa fa-crosshairs"></i>
                <span class="text">Identify</span>
            </div>
            <div class="panel-content">
                <div id="identifyDijit"></div>
            </div>
        </div>
    </div>
    <!-- end panel buat widget ------------------------------------------------------------- -->

    <div class="overlay"></div>
    

    </div> -->

    <script type="text/javascript" src="https://digio.pgn.co.id/mapjs/MapsComponent/MapsJs/jquery.min.js"></script>
    <script type="text/javascript" src="https://digio.pgn.co.id/mapjs/MapsComponent/MapsJs/bootstrap.min.js"></script>
    <script type="text/javascript">
        //Untuk identify pgn online
        var identKoordinat,convertKoordinat,klikPoint;//input koordinat identify.js
        var _symbol, _graphic, _outSR, coordsTable;
        var gsvc, pt;

        var identKoordinat,convertKoordinat;//input koordinat identify.js
        //Untuk identify pgn online
    </script>
    
    <!-- javascript section ---------------------------------------------------------------- -->
    <script src="https://digio.pgn.co.id/maps/lib/jquery-3.4.1/jquery-3.4.1.min.js"></script>
    <script src="https://digio.pgn.co.id/maps/js/digio/digiomaster.js"></script>

    <script type="text/javascript">
        var 
        s = window.location.search, 
        q = s.match(/locale=([^&]*)/i),
        imocid= s.match(/imocid=([^&]*)/i);

        var idmoc = imocid[1];

        var locale = (q && q.length > 0) ? q[1] : null;
        window.dojoConfig = {
            locale: locale,
            async: true
        };

        

        $('body').removeClass('bg-color--dark-white').addClass('cmv flat');


    </script>
    <!--[if lt IE 9]>
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/es5-shim/4.0.3/es5-shim.min.js"></script>
    <![endif]-->
    <script src="https://js.arcgis.com/3.33compact/"></script>
    <!-- <script src="https://gis.pgn.co.id/lib/arcgis_js_api/3.33/3.33compact/init.js"></script> -->
        <script src="https://digio.pgn.co.id/maps/js/config/app.js"></script>
    <script src="https://digio.pgn.co.id/maps/js/digio/map.js"></script>

   

    <!-- end javascript section ------------------------------------------------------------ -->

</body>
</html>
