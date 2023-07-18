<?php

include './cn.php';

$ids = isset($_GET['post']) ? $_GET['post'] : null;

$idsArray =  explode(',', $ids);

if (count($idsArray) > 0 && $ids != null) {

    $cn->begin_transaction();
    try {
        foreach ($idsArray as  $elem) {
            $sql =
                "SELECT * 
                    FROM detalle 
                    WHERE id_post = '$elem'";

            $result = $cn->query($sql);
            $all = $result->fetch_all(MYSQLI_ASSOC);

            $permant = [];
            $permantId = [];
            foreach ($all as  $value) {

                if (!in_array($value['id_preg'], $permant)) {
                    array_push($permant, $value['id_preg']);
                    array_push($permantId, $value['id']);
                }
            }

            $permantId = implode(',', $permantId);

            $delete_sql = "DELETE FROM detalle WHERE  id_post = '$elem' AND id NOT IN  ($permantId)";
            $rest = $cn->query($delete_sql);
        }

        $cn->commit();
        die('Exito');
    } catch (\Throwable $th) {
        $cn->rollback();
        die($th);
        //throw $th;
    }
}

echo 'No hay datos.';
