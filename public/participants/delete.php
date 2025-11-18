<?php

require_once "../../Classes/Participants.php";
$participant = new Participants();
$jsAlert = '';
$message = "Participant Deleted Successfully!";
$message = $participant->delete($_GET['partId']);
$jsAlert = "<script>
    alert('".addslashes($message)."');
    window.location.href= 'index.php';
</script>";
echo $jsAlert;
?>
