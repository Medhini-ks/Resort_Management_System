<? php
session_start ();
unset ($ _ SESSION ['user_id']);
session_destroy ();

header ("Location: index.html");
exit;
?>