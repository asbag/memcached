<?php
	require_once 'singleserver.php';
    $sql = "
        SELECT `dataID`, `dataTitle`
        FROM `tbldata`
        WHERE `dataTypeID` BETWEEN 2 AND 2093
        AND `dataStatusID` IN (1,2,3,4)
        AND `dataTitle` LIKE '%something%'
        ORDER BY `dataDate` DESC
        LIMIT 10
    ";

    # Antes: Sin Memcached
    $rSlowQuery = mysql_query($sql);
    # $rSlowQuery is a MySQL resource
    $rows = mysql_num_rows($rSlowQuery);
    for ($i=0;$i<$rows;$i++) {
        $dataID = intval(mysql_result($rSlowQuery,$i,"dataID"));
        $dataTitle = mysql_result($rSlowQuery,$i,"dataTitle");

        echo "<a href=\"/somewhere/$dataID\">$dataTitle</a><br />\n";
    }

    # Despues Con Memcache
    $rSlowQuery = mysql_query_cache($sql);
    # $rSlowQuery is an array
    $rows = count($rSlowQuery);
    for ($i=0;$i<$rows;$i++) {
        $dataID = intval($rSlowQuery[$i]["dataID"]);
        $dataTitle = $rSlowQuery[$i]["dataTitle"];

        echo "<a href=\"/somewhere/$dataID\">$dataTitle</a><br />\n";
    }

?>