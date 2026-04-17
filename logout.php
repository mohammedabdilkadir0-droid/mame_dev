<?php
// ሴሽኑን ለመጀመር መጀመሪያ session_start() መጥራት አለበት
session_start();

// ሁሉንም የሴሽን መረጃዎች ሰርዝ
session_unset();

// ሴሽኑን ሙሉ በሙሉ አጥፋ
session_destroy();

// ተጠቃሚውን ወደ መግቢያ ገጽ (login.php) ወይም ወደ ዋናው ገጽ (index.php) መልሰው
header("Location: index.php");
exit();
?>