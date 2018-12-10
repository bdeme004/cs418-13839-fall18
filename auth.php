<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>lptColors</title>
        <script src=lptcolors.js></script>
    </head>
    <body>
        
        
        <form id="form1" action="https://github.com/login/oauth/access_token" method="POST">
            <input type="hidden" name="client_id" value="71ce02e70e6de763c9a2">
            <!--TEMP!!-->
            <input type="hidden" name="client_secret" value="77c14c0db28eb4b5db1131f7640024b8c29158a9">
            <input type="hidden" name="code" value="<?php echo $_GET["code"]?>">
        </form>
        
        <script>
        document.getElementById("form1").submit();
        </script>
        
    </body>
</html>