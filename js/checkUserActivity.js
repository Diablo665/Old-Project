let time = 120000;

$(document).ready(function(){
    window.onbeforeunload = confirmExit;
    function confirmExit()
    {
        return "Классная штука которая не работает)";

        // Ребят а зачем тогда возвращать текст который и так никто не увилит?

        /* Так надо брат 
            1. Надо сделать функционал.
            2. То что это сейчас не рабоатет не значит что он не заработает потом)
        
            Вот тебе котик и не переживай: ᓚᘏᗢ 
        
        */
    }
})