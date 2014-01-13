<?php
class noUser extends Exception
{
    function __toString()
    {
        return 'Porano błędny login lub hasło';
    }
}

class noValue extends Exception
{
    function __toString()
    {
        return 'Musisz podac login i hasło!!';
    }
}

class Value extends Exception
{
    function __toString()
    {
        return 'Musisz wypełnić wszystkie pola formularza!!';
    }
}
?>
