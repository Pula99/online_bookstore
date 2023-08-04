<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="admin/assets/css/preloader.css">
</head>
<body>
    <div id="preloader">
		<div class="preloader-content">
			<img src="images/logo.png" width='300' height='auto'>
		</div>
	</div>

    <script>
        window.addEventListener('load', function () {
            setTimeout(function(){
                const preloaderContainer = document.getElementById('preloader');
                preloaderContainer.style.opacity = 0;
                preloaderContainer.style.visibility = 'hidden';
            }, 1500);
        });
    </script>
</body>
</html>
