<html style="width:640px;height:480px;">
<head>

   <!-- player skin -->
   <link rel="stylesheet" type="text/css" href="/js/flowplayer/skin/minimalist.css" />

   <!-- site specific styling -->
   <style>
   body { font: 12px "Myriad Pro", "Lucida Grande", sans-serif; text-align: center; padding-top: 5%; }
   .flowplayer { width: 80%; }
   </style>

   <!-- flowplayer depends on jQuery 1.7.1+ (for now) -->
   <script src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>

   <!-- include flowplayer -->
   <script src="/js/flowplayer/flowplayer.min.js"></script>

</head>

<body style="width:640px;height:480px;margin:0;padding:0;overflow:hidden;">

  <div class="flowplayer" style="width:640px;height:480px;left:8px;top:8px;" data-swf="/js/flowplayer/flowplayer.swf" data-ratio="0.417">
	  <video autoplay>
	     <source type="video/mp4" src="/video/<?php echo (@$_REQUEST['vid']); ?>.mp4"/>
	  </video>
	</div>

</body>
</html>