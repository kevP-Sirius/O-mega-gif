# Dictionnaire des données

## USER

|Champ|Type|Spécificités|Description|
|-|-|-|-|
|id|INT|PRIMARY KEY, NOT NULL, UNSIGNED, AUTO_INCREMENT|L'identifiant de l'utilisateur |
|username|VARCHAR(64)|NOT NULL|Le nom de l'utilisateur|
|email|VARCHAR(255)|NOT NULL|L'email de l'utilisateur|
|password|VARCHAR(255)|NOT NULL|Le mot de passe de l'utilisateur|
|created_at|DATETIME|NOT NULL| La date de création de l'utilisateur|
|updated_at|DATETIME|NULL|La date de mise à jour de l'utilisateur|
|is_active|BOOLEAN|NOT_NULL|Indique si il est actif|
|gifList_id|FOREIGN_KEY|NULL|Clef étrangère de la liste de gif de l'utilisateur |


## ROLE

|Champ|Type|Spécificités|Description|
|-|-|-|-|
|id|INT|PRIMARY KEY, NOT NULL, UNSIGNED, AUTO_INCREMENT|
|name|VARCHAR(64)|NOT NULL|nom du role|
|roleString|VARCHAR(255)|NULL|code du role|
|created_at|DATETIME|NOT NULL| La date de création du role|
|updated_at|DATETIME|NULL|La date de mise à jour du role|
|is_active|BOOLEAN|NOT_NULL|Indique si il est actif|

## GIF


|Champ|Type|Spécificités|Description|
|-|-|-|-|
|id|INT|PRIMARY KEY, NOT NULL, UNSIGNED, AUTO_INCREMENT|
|name|VARCHAR(64)|NOT NULL|nom du gif|
|url|VARCHAR(255)|NULL|url du gif|
|created_at|DATETIME|NOT NULL| La date de création du gif|
|updated_at|DATETIME|NULL|La date de mise à jour du gif|
|is_active|BOOLEAN|NOT_NULL|Indique si il est actif|