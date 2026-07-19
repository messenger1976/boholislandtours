<?php
/**
 * Legacy redirect — home content lives on index.php
 */
header('Location: index.php', true, 301);
exit;
