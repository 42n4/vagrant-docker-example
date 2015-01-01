<?php

use Silex\Application;
use Silex\Provider\TwigServiceProvider;

require __DIR__ . '/../vendor/autoload.php';

$app = new Application();
$app->register(new TwigServiceProvider());

$app['debug'] = true;
$app['twig.path'] = [__DIR__.'/../templates'];
$app['twig.options'] = ['cache' => __DIR__.'/../var/cache/twig'];

$app
    ->get('/', function(Application $app) {
        $messages = [
            'Chuck Norris uses ribbed condoms inside out, so he gets the pleasure.' ,
            'MacGyver can build an airplane out of gum and paper clips. Chuck Norris can kill him and take it.',
            'Chuck Norris doesn\'t read books. He stares them down until he gets the information he wants.',
            'If you ask Chuck Norris what time it is, he always answers "Two seconds till". After you ask "Two seconds to what?", he roundhouse kicks you in the face.',
            'Chuck Norris lost his virginity before his dad did.',
            'Since 1940, the year Chuck Norris was born, roundhouse kick related deaths have increased 13,000 percent.',
            'Chuck Norris sheds his skin twice a year.',
            'Chuck Norris once challenged Lance Armstrong in a "Who has more testicles?" contest. Chuck Norris won by 5.',
            'There are no steroids in baseball. Just players Chuck Norris has breathed on.',
            'When Chuck Norris goes to donate blood, he declines the syringe, and instead requests a hand gun and a bucket.',
            'Pluto is actually an orbiting group of British soldiers from the American Revolution who entered space after the Chuck gave them a roundhouse kick to the face.',
            'Chuck Norris does not teabag the ladies. He potato-sacks them.',
            'According to the Encyclopedia Brittanica, the Native American "Trail of Tears" has been redefined as anywhere that Chuck Norris walks.',
            'In an average living room there are 1,242 objects Chuck Norris could use to kill you, including the room itself.',
            'The Chuck Norris military unit was not used in the game Civilization 4, because a single Chuck Norris could defeat the entire combined nations of the world in one turn.',
            'Chuck Norris doesn\'t shower, he only takes blood baths.',
            'Time waits for no man. Unless that man is Chuck Norris.',
            'Chuck Norris can hit you so hard that he can actually alter your DNA. Decades from now your descendants will occasionally clutch their heads and yell "What The Hell was That?".',
        ];

        return $app['twig']->render('index.html.twig', ['message' => $messages[mt_rand(0, count($messages) - 1)]]);
    })
;

$app->run();