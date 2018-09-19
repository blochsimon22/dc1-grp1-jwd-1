<?php

function getAllTagsByPhoto(int $id): array {
    global $connection;
    
    $query = "SELECT
                tag.id,
                tag.titre
            FROM tag
            INNER JOIN photo_has_tag ON photo_has_tag.tag_id = tag.id
            WHERE photo_has_tag.photo_id = :id;";
    
    $stmt = $connection->prepare($query);
    $stmt->bindParam(':id', $id);
    $stmt->execute();
    
    return $stmt->fetchAll();
}
