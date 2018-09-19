<?php
function getAllPhotos(): array {
    global $connection;

    $query = "SELECT
                photo.id,
                photo.titre,
                photo.image,
                photo.nb_likes,
                photo.date_creation,
                photo.description,
                DATE_FORMAT(photo.date_creation, '%e %M %Y') AS 'date_creation_format',
                categorie.titre AS categorie
            FROM photo
            INNER JOIN categorie ON categorie.id = photo.categorie_id
            ORDER BY photo.date_creation DESC
            LIMIT 6;";

    $stmt = $connection->prepare($query);
    $stmt->execute();

    return $stmt->fetchAll();
}

function getAllPhotosByTag(int $id): array {
    global $connection;
    
    $query = "SELECT
                photo.*,
                DATE_FORMAT(photo.date_creation, '%e %M %Y') AS 'date_creation_format',
                categorie.titre AS categorie
            FROM photo
            INNER JOIN photo_has_tag ON photo_has_tag.photo_id = photo.id
            INNER JOIN categorie ON categorie.id = photo.categorie_id
            WHERE photo_has_tag.tag_id = :id;";
    
    $stmt = $connection->prepare($query);
    $stmt->bindParam(':id', $id);
    $stmt->execute();
    
    return $stmt->fetchAll();
}
function getAllPhotosByCategorie(int $id): array {
    global $connection;
    
    $query = "SELECT
                photo.*,
                DATE_FORMAT(photo.date_creation, '%e %M %Y') AS 'date_creation_format',
                categorie.titre AS categorie
            FROM photo
            INNER JOIN categorie ON categorie.id = photo.categorie_id
            WHERE categorie.id = :id;";
    
    $stmt = $connection->prepare($query);
    $stmt->bindParam(':id', $id);
    $stmt->execute();
    
    return $stmt->fetchAll();
}

function getPhoto(int $id): array {
    global $connection;
    
    $query = "SELECT
                photo.id,
                photo.titre,
                photo.image,
                photo.nb_likes,
                photo.date_creation,
                photo.description,
                DATE_FORMAT(photo.date_creation, '%e %M %Y') AS 'date_creation_format',
                categorie.titre AS 'categorie'
            FROM photo
            INNER JOIN categorie ON categorie.id = photo.categorie_id
            WHERE photo.id = :id";
    
    $stmt = $connection->prepare($query);
    $stmt->bindParam(":id", $id);
    $stmt->execute();

    return $stmt->fetch();
}