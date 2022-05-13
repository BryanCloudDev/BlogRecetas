<?php

require_once('./Class/Insert.php');

class Recipes extends Insert
    {

        static public function getRecipe(int $id) : array
            {
                $archiveContent = file_get_contents(RECIPES);
                $recipes = json_decode($archiveContent,true);
                $recipe = [];
                for($i = 1;$i < count($recipes);$i++){
                    if($recipes[$i]['id'] == $id)
                    {
                        $recipe = $recipes[$i];
                        break;
                    }
                }
                return $recipe;
            }

        static public function getAllRecipes() : array
            {
                $archiveContent = file_get_contents(RECIPES);
                $recipes = json_decode($archiveContent,true);
                $count = count($recipes);
                $totalRecipes = [];
                for($i = 1;$i < $count;$i++)
                {
                    $totalRecipes[] = $recipes[$i];
                }

                return array_reverse($totalRecipes);
            }

// #Obtiene las recetas que cumplan un cierto string

//         static public function getRecByTitle($title){
//             global $conn;
//             $query = "SELECT * FROM receta WHERE tituloPost LIKE :recTitle ORDER BY idReceta DESC";
//             $statement = $conn->prepare($query);
//             $statement->bindValue(":recTitle","%$title%");
//             $statement->execute();
//             $result = $statement->fetchAll(PDO::FETCH_ASSOC);
//             $statement->closeCursor();

//             return $result;
//         }

        static public function getRecipeByUserId(int $id) : array
        {
            $contenidoArchivo = file_get_contents(RECIPES);
            $recipes = json_decode($contenidoArchivo,true);
            $userRecipes = [];
            $count = count($recipes);
            for($i = 1;$i < $count;$i++){
                if($recipes[$i]['created_by'] == $id){
                    $userRecipes[] = $recipes[$i];
                }
            }
            return array_reverse($userRecipes);
        }
        static public function updateRegister($id,$data,$fileRoute,$keys)
        {
            $contentFile = file_get_contents($fileRoute);
            $currentData = json_decode($contentFile,true);
            $register = Recipes::getRecipe($id);
            $register = array_combine($keys,$data);
            for($i = 1;$i < count($currentData);$i++){
                    if($currentData[$i]['id'] == $id)
                    {
                        $currentData[$i] = $register;
                        break;
                    }
                }
            $archive = fopen($fileRoute,'w');
            fwrite($archive,json_encode($currentData));
            fclose($archive);
        }
            static public function getImagePath(int $id) : string
            {
                $contenidoArchivo = file_get_contents(RECIPES);
                $recipes = json_decode($contenidoArchivo,true);
                $path = '';
                $count = count($recipes);
                for($i = 1;$i < $count;$i++){
                    if($recipes[$i]['id'] == $id){
                        $path = $recipes[$i]['image'];
                        break;
                    }
                }
                return $path;
            }
    }