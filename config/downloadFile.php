<?php
    header('Content-type: application/json');
    header('Content-Disposition: attachment; filename="results.json"');
    readfile('results.json');
?>