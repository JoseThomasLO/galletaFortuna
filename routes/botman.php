<?php
use App\Http\Controllers\BotManController;
use App\Cookie;
$botman = resolve('botman');

$botman->hears('Hi', function ($bot) {
    $bot->reply('Hello!');
});

$botman->hears('About', function ($bot) {
    $bot->reply('Este bot da frases de la fortuna y fue desarrollado por Jose Thomas Lopez Osorio');
});

$botman->hears('break cookie', function ($bot) {
    $cookie = Cookie::all()->random(1)->first();
    $bot->reply($cookie->message);
});

$botman->hears('create cookie {text}', function ($bot, $text) {
    
    $cookie = new Cookie(); //Crea una nueva cookie para añadirla a la base de datos.
    $cookie->message = $text; //Modifica el atributo text de la cookie
    $cookie->save(); // Guarda la cookie en la base de datos.

    $bot->reply("Cookie succesfully saved!");
});

$botman->hears('update cookie {id} with {text}', function ($bot, $id, $text) {
    
    $cookie = Cookie::find($id); //Busca la cookie con el ID

    if($cookie == null)
        $bot->reply("The cookie doesn't exist");
    else
    {
        $cookie->message = $text;
        $cookie->save(); //Guarda la modificación de la cookie en la base de datos.
        $bot->reply("Cookie succesfully updated!");
    }
});

$botman->hears('find cookie with {text}', function ($bot, $text) {
    
    $cookies = Cookie::where('message', '=', $text)->get(); //Muestra las cookies exactamente con ese texto

    foreach($cookies as $cookie)
    {
        $bot->reply("Cookie: ". $cookie->id);
    }

    if(count($cookies) == 0)
        $bot->reply("I couldn't find any cookies with that text");
});

$botman->hears('find cookie like {text}', function ($bot, $text) {
    
    $cookies = Cookie::where('message', 'LIKE', "%{$text}%")->get(); //Muestra las cookies que contengan ese taxto en algun momento.

    foreach($cookies as $cookie)
    {
        $bot->reply("Cookie: ". $cookie->id . " " . $cookie->message);
    }

    if(count($cookies) == 0)
        $bot->reply("I couldn't find any cookies with that text");
});

$botman->hears('delete cookie {id}', function ($bot, $id) {

    $control = Cookie::where('id', '=', $id)->delete();

    if($control == 0)
        $bot->reply("There isn't any cookie with that ID");
    else
        $bot->reply("Cookie succesfully deleted!");

    /* Manera mas larga.
    $cookie = Cookie::find($id); //Crea una nueva cookie para añadirla a la base de datos.
    
    if($cookie == null)
        $bot->reply("There isn't any cookie with that ID");
    else
    {
        $cookie->delete();
        $bot->reply("Cookie succesfully deleted!");
    }
    */
});

$botman->hears('Start conversation', BotManController::class.'@startConversation');
