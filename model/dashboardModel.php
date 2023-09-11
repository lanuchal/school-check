<?php
function getIDYearData()
{
    $sql = "SELECT IDYearData FROM [dbo].[TScore] WHERE [IDTeacher] = '" . $_SESSION['userId'] . "' GROUP BY IDYearData;";
    $query = sqlsrv_query($GLOBALS['conn'], $sql);

    if (!$query) {
        die("Query execution failed: " . sqlsrv_errors());
    }

    $results = array();
    while ($row = sqlsrv_fetch_array($query, SQLSRV_FETCH_ASSOC)) {
        $results[] = $row;
    }

    return $results;
}

function getIDYearDataById($id)
{
    $sql = "SELECT
                TScore.*, 
                TBStudent.PreName, 
                TBStudent.NameFirst, 
                TBStudent.NameLast
            FROM
                dbo.TScore
                INNER JOIN
                dbo.TBStudent
                ON 
                    TScore.IDStudent = TBStudent.IDStudent
            WHERE
                TScore.IDYearData = '$id';";

    $query = sqlsrv_query($GLOBALS['conn'], $sql);

    if (!$query) {
        die("Query execution failed: " . sqlsrv_errors());
    }

    $results = array();
    while ($row = sqlsrv_fetch_array($query, SQLSRV_FETCH_ASSOC)) {
        $results[] = $row;
    }

    return $results;
}
?>