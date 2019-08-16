<?php

echo'<script type="text/javascript">
    alert("Debe finalizar los test anteriores para desbloquear este.");
    window.location.href="index.php";
    </script>';
mysqli_close($mysqli);

?>