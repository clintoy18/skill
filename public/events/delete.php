<?php

require_once "../../Classes/Event.php";
$event = new Event();
$jsAlert = '';
$message = "Event Deleted Successfully!";
$message = $event->delete($_GET['evCode']);
$jsAlert = "<script>
    alert('".addslashes($message)."');
    window.location.href= 'index.php';
</script>";
echo $jsAlert;
?>
