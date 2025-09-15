<?php
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
        // Eğer log atarken de hata olursa sessiz geç (sonsuz döngü önlenir)
        error_log("Logger failed: " . $logEx->getMessage());
    }
}
?>