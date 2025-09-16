<?php
//****************************************************************************************//
//****** Sistemin herhangi Bir yerinde Hata olması Durumunda Veritabanına LOG Atar *******//
//****************************************************************************************//
function logError(PDO $pdo, Exception $ex, string $action, string $tableName, ?int $userId = null): void
{
    try {
        
        $stmt = $pdo->prepare("INSERT INTO Logger (Action, TableName, UserID, MessageText, File, Line, TraceText, CreateDate) 
            VALUES 
            (:Action, :TableName, :UserID, :MessageText, :File, :Line, :TraceText, :CreateDate)");

        $stmt->execute([
            ':Action' => $action,
            ':TableName' => $tableName,
            ':UserID' => $userId,
            ':MessageText' => $ex->getMessage(),
            ':File' => $ex->getFile(),
            ':Line' => $ex->getLine(),
            ':TraceText' => $ex->getTraceAsString(),
            ':CreateDate' => (new DateTime('now', new DateTimeZone('Europe/Istanbul')))->format('Y-m-d H:i:s'),
        ]);
    } catch (Exception $logEx) {
        //****** Eğer LOG Atarken Hata Olursa Sessiz Geç (sonsuz döngü önlenir) *******//
        error_log("Logger failed: " . $logEx->getMessage());
    }
}
?>