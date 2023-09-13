<?php

function getMissLeaveSick($idYearData, $idStudent)
{
    $sql = "SELECT
    SUM(CASE WHEN CodeReasonAbsent = '1' THEN 1 ELSE 0 END) AS Miss,
    SUM(CASE WHEN CodeReasonAbsent = '3' THEN 1 ELSE 0 END) AS Leave,
    SUM(CASE WHEN CodeReasonAbsent = '2' THEN 1 ELSE 0 END) AS Sick
  FROM [dbo].[TBStudentAbsent_subject]
  WHERE IDYearData ='$idYearData' and IDStudent = '$idStudent'
  ";
    // return $sql;

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

function updateMissLeaveSick($miss, $leave, $sick, $idYearData, $pSunjectCode, $idStudent)
{
    $sql = "UPDATE [dbo].[TScore] SET [nKD] = '$miss', [nLA] = '$leave', [nILL] = '$sick' WHERE [IDYearData] = '$idYearData' AND [PSubjectCode] = '$pSunjectCode' AND [IDStudent] = '$idStudent'";

    $query = sqlsrv_query($GLOBALS['conn'], $sql);

    if (!$query) {
        die("Query execution failed: " . sqlsrv_errors());
    }

}

if ($_GET['action'] == "checkOn") {

    $dateFull = date("Y-m-d H:i:s");
    $id = $_POST['id'];
    $detail = $_POST['detail'];
    $code = $_POST['code'];

    $idYearData = $_POST['idYearData'];
    $pSunjectCode = $_POST['pSunjectCode'];
    $idStudent = $_POST['idStudent'];



    $sql = "UPDATE [dbo].[TBStudentAbsent_subject] SET [ReasonAbsent] = '$detail', [CodeReasonAbsent] = '$code', [update_by] = '" . $_SESSION['userId'] . "', [update_time] = '$dateFull' WHERE [ID] = '$id'";
    $query = sqlsrv_query($GLOBALS['conn'], $sql);

    if (!$query) {
        die("Query execution failed: " . sqlsrv_errors());
    }
    $rowsAffected = sqlsrv_rows_affected($query);
    // $data = array(
    //     "id"=>$id,
    //     "detail"=>$detail,
    //     "code"=>$code,
    //     "idYearData"=>$idYearData,
    //     "pSunjectCode"=>$pSunjectCode,
    //     "idStudent"=>$id,
    // );
    if ($rowsAffected) {
        # code...
        $rusultGetMissLeaveSick = getMissLeaveSick($idYearData, $idStudent);
        $miss = $rusultGetMissLeaveSick[0]['Miss'];
        $leave = $rusultGetMissLeaveSick[0]['Leave'];
        $sick = $rusultGetMissLeaveSick[0]['Sick'];

        updateMissLeaveSick($miss, $leave, $sick, $idYearData, $pSunjectCode, $idStudent);

        echo json_encode(array("result" => $rowsAffected));
    }



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

function getIPSubjectCode()
{
    $sql = "SELECT TScore.PSubjectCode
    FROM dbo.TScore
    INNER JOIN dbo.TTeacherSubject ON TScore.PSubjectCode = TTeacherSubject.PSubjectCode
    WHERE TTeacherSubject.IDTeacher = '" . $_SESSION['userId'] . "'
    GROUP BY TScore.PSubjectCode";
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

function getIDYearDataById($id, $valPeriod, $pSubjectCode)
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
                TScore.IDYearData = '$id' AND TScore.PSubjectCode = '$pSubjectCode' ;";
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
            $sqlInsert = "INSERT INTO [dbo].[TBStudentAbsent_subject] ( [IDYearData], [IDStudent], [YMD], [ReasonAbsent], [IDTeacher], [CodeReasonAbsent], [ID], [Datetime], [Period],[PSubjectCode] )
            VALUES
            ( '" . $row['IDYearData'] . "', '" . $row['IDStudent'] . "', '$dateYMD', ' ', '" . $row['IDTeacherSub'] . "', '0', " . getLastId() . ", '$dateFull', '" . $lastPeriod . "','" . $row['PSubjectCode'] . "' )";

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

function getSetColorToView($id, $valPeriod, $pSubjectCode)
{

    $sql = "SELECT * FROM [dbo].[TBStudentAbsent_subject] WHERE IDYearData = '$id' AND PSubjectCode = '$pSubjectCode' AND Period ='$valPeriod';";
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