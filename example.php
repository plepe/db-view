<?php include "conf.php"; /* load a local configuration */ ?>
<?php include "modulekit/loader.php"; /* loads all php-includes */ ?>
<?php call_hooks("init"); /* initialize submodules */ ?>
<!DOCTYPE html>
<html>
<head>
<?php print modulekit_to_javascript(); /* pass modulekit configuration to JavaScript */ ?>
<?php print modulekit_include_js(); /* prints all js-includes */ ?>
<?php print modulekit_include_css(); /* prints all css-includes */ ?>
<?php print_add_html_headers(); /* print additional html headers */ ?>
<script src='dist/build.js'></script>
</head>
<body>
</body>
</html>
