<?php
setcookie("user_id",'',time()-60);
setcookie("name",'',time()-60);

header('Location: /transporte_publico');
?>