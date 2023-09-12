<?php

if ($_GET['action'] == "checkOn") {

    $dateFull = date("Y-m-d H:i:s");
    $id = $_POST['id'];
    $detail = $_POST['detail'];
    $code = $_POST['code'];

    $sql = "UPDATE [dbo].[TBStudentAbsent_subject] SET [ReasonAbsent] = '$detail', [CodeReasonAbsent] = '$code', [update_by] = '" . $_SESSION['userId'] . "', [update_time] = '$dateFull' WHERE [ID] = '$id'";
    $query = sqlsrv_query($GLOBALS['conn'], $sql);

    if (!$query) {
        die("Query execution failed: " . sqlsrv_errors());
    }
    $rowsAffected = sqlsrv_rows_affected($query);
    echo json_encode(array("result" => $rowsAffected));
    exit();
}

function getIDYearData()
{
    $sql = "SELECT TScore.IDYearData
    FROM dbo.TScore
    INNER JOIN dbo.TTeacherSubject ON TScore.PSubjectCode = TTeacherSubject.PSubjectCode
    WHERE TTeacherSubject.IDTeacher = '" . $_SESSION['userId'] . "'
    GROUP BY TScore.IDYearData";
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

function getIDYearDataById($id, $valPeriod)
{
    $sql = "SELECT
                TScore.*, 
                TBStudent.PreName, 
                TBStudent.NameFirst, 
                TBStudent.NameLast,
	            TTeacherSubject.IDTeacher AS IDTeacherSub
            FROM
                dbo.TScore
                INNER JOIN
                dbo.TBStudent
                ON 
                    TScore.IDStudent = TBStudent.IDStudent
                INNER JOIN
                dbo.TTeacherSubject
                ON 
                    TScore.PSubjectCode = TTeacherSubject.PSubjectCode
            WHERE
                TScore.IDYearData = '$id';";

    $query = sqlsrv_query($GLOBALS['conn'], $sql);

    if (!$query) {
        die("Query execution failed: " . sqlsrv_errors());
    }

    $results = array();
    $dateFull = date("Y-m-d H:i:s");
    $dateYMD = date("Ymd");
    $lastPeriod = getLastPeriod($id);
    $resultInsert = getLastInsetResult($id, $valPeriod);

    while ($row = sqlsrv_fetch_array($query, SQLSRV_FETCH_ASSOC)) {
        $results[] = $row;
        if (!$resultInsert) {
            $sqlInsert = "INSERT INTO [dbo].[TBStudentAbsent_subject] ( [IDYearData], [IDStudent], [YMD], [ReasonAbsent], [IDTeacher], [CodeReasonAbsent], [ID], [Datetime], [Period] )
            VALUES
            ( '" . $row['IDYearData'] . "', '" . $row['IDStudent'] . "', '$dateYMD', ' ', '" . $row['IDTeacherSub'] . "', '0', " . getLastId() . ", '$dateFull', '" . $lastPeriod . "' )";
            sqlsrv_query($GLOBALS['conn'], $sqlInsert);
        }
    }

    return $results;
}

function getLastPeriod($id)
{
    $queryLastId = sqlsrv_query($GLOBALS['conn'], "SELECT TOP 1 Period FROM [dbo].[TBStudentAbsent_subject] WHERE IDYearData = '$id' ORDER BY Period DESC;");
    if ($queryLastId === false) {
        die(print_r(sqlsrv_errors(), true));
    }

    $row = sqlsrv_fetch_array($queryLastId, SQLSRV_FETCH_ASSOC);

    if ($row !== null && array_key_exists('Period', $row)) {
        $lastId = $row['Period'];
        return $lastId + 1;
    } else {
        return 1;
    }
}

function getLastId()
{
    $queryLastId = sqlsrv_query($GLOBALS['conn'], "SELECT TOP 1 ID FROM [dbo].[TBStudentAbsent_subject] ORDER BY ID DESC;");
    if ($queryLastId === false) {
        die(print_r(sqlsrv_errors(), true));
    }
    $row = sqlsrv_fetch_array($queryLastId, SQLSRV_FETCH_ASSOC);
    if ($row !== null && array_key_exists('ID', $row)) {
        $lastId = $row['ID'];
        return $lastId + 1;
    } else {
        return 1;
    }
}

function getLastInsetResult($id, $valPeriod)
{
    $queryLastId = sqlsrv_query($GLOBALS['conn'], "SELECT TOP 1 Period FROM [dbo].[TBStudentAbsent_subject] WHERE IDYearData = '$id' AND Period = '$valPeriod' ORDER BY Period DESC;");
    if ($queryLastId === false) {
        die(print_r(sqlsrv_errors(), true));
    }
    $row = sqlsrv_fetch_array($queryLastId, SQLSRV_FETCH_ASSOC);
    if ($row !== null && array_key_exists('Period', $row)) {
        $lastId = $row['Period'];
        return $lastId;
    } else {
        return false;
    }
}

function getSetColorToView($id, $valPeriod)
{

    $sql = "SELECT * FROM [dbo].[TBStudentAbsent_subject] WHERE IDYearData = '$id' AND Period ='$valPeriod';";
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