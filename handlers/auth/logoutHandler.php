<?php

//niszczy istniejaca sesje i przekierowuje na strone wejsciowa
session_destroy();
header("Location: ../index.php");