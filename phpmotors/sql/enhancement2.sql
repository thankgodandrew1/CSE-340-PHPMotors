-- Query 1
INSERT INTO clients (
        clientFirstname,
        clientLastname,
        clientEmail,
        clientPassword,
        clientLevel,
        comment
    );
VALUES (
        'Tony',
        'Stark',
        'tony@starkent.com',
        'Iam1ronM@n',
        1,
        'I am the real Ironman'
    );
-- Query 2
UPDATE clients
SET clientLevel = 3
WHERE clientFirstname = 'Tony'
    AND clientLastname = 'Stark';
-- Query 3
UPDATE inventory
SET invDescription = REPLACE(
        invDescription,
        'small interior',
        'spacious interior'
    )
WHERE invModel = 'Hummer';
-- Query 4
SELECT inventory.invModel,
    carclassification.classificationName
FROM inventory
    INNER JOIN carclassification ON inventory.classificationID = carclassification.classificationID
WHERE carclassification.classificationName = 'SUV';
-- Query 5
DELETE FROM inventory
WHERE invModel = 'Wrangler';
-- Query 6
UPDATE Inventory
SET invImage = CONCAT('/phpmotors', invImage),
    invThumbnail = CONCAT('/phpmotors', invThumbnail);