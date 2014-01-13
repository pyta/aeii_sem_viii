<?php
class staticPage
{
    public static function getArticle($tabble)
    {
        $connect = sqlConnect(); 
        $result = @$connect->query("SELECT id, title, content FROM $tabble LIMIT 1");
        $all = $result->num_rows;
        if($all <= 0)
            echo Show::ShowMessage ("Brak artykułów do wyświetlenia...", false);
        else
        {
            if ($result === false)
            {
                throw new sqlQueryError();
                $connect -> close();
            }
            else 
            {
                $art = $result->fetch_assoc();
                Show::article($all, $art['id'], $art['title'], $art['content'], $tabble);
                $result -> close();
                $connect -> close();
            }
        }
    }
    
    public static function edit($tabble, $id, $title, $content, $action)
    {
        if(isset($action))
        {
            try
            {
                $connect = sqlConnect(); 
                $query = "UPDATE $tabble SET title='$title', content='$content'";
                $result = @$connect->query($query);
                Show::ShowMessage('Pomyślnie uaktualniono dane w bazie danych....', true);
            }
            catch(Exception $Error)	
            {
                echo Show::ShowMessage('Wystąpił poważny błąd. Proszę spróbować później...', false);
            }
        }
        else
        {
            try
            {
                $connect = sqlConnect(); 
                $query = "SELECT id, title, content FROM $tabble";
                $result = $connect->query($query);
                $edit = $result->fetch_assoc();
                Show::showEdit($edit['id'], $edit['title'], $edit['content'], $tabble);                
            }
            catch(Exception $Error)	
            {
                echo Show::ShowMessage('Wystąpił poważny błąd. Proszę spróbować później...', false);
            }
        }  
    }
}
?>
