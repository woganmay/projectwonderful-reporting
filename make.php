<?php

$parrots = [
    'aussiecongaparrot.gif',
    'aussieparrot.gif',
    'aussiereversecongaparrot.gif',
    'blondesassyparrot.gif',
    'bluecluesparrot.gif',
    'boredparrot.gif',
    'chillparrot.gif',
    'christmasparrot.gif',
    'coffeeparrot.gif',
    'confusedparrot.gif',
    'congaparrot.gif',
    'congapartyparrot.gif',
    'darkbeerparrot.gif',
    'dealwithitparrot.gif',
    'dreidelparrot.gif',
    'explodyparrot.gif',
    'fastparrot.gif',
    'fieriparrot.gif',
    'fiestaparrot.gif',
    'gentlemanparrot.gif',
    'gothparrot.gif',
    'hamburgerparrot.gif',
    'harrypotterparrot.gif',
    'ice-cream-parrot.gif',
    'magaritaparrot.gif',
    'middleparrot.gif',
    'moonwalkingparrot.gif',
    'oldtimeyparrot.gif',
    'oriolesparrot.gif',
    'parrot.gif',
    'parrotbeer.gif',
    'parrotcop.gif',
    'parrotdad.gif',
    'parrotmustache.gif',
    'parrotsleep.gif',
    'parrotwave1.gif',
    'parrotwave2.gif',
    'parrotwave3.gif',
    'parrotwave4.gif',
    'parrotwave5.gif',
    'parrotwave6.gif',
    'parrotwave7.gif',
    'partyparrot.gif',
    'pizzaparrot.gif',
    'reversecongaparrot.gif',
    'rightparrot.gif',
    'sadparrot.gif',
    'sassyparrot.gif',
    'shufflefurtherparrot.gif',
    'shuffleparrot.gif',
    'shufflepartyparrot.gif',
    'slowparrot.gif',
    'stableparrot.gif',
    'tripletsparrot.gif',
    'twinsparrot.gif',
    'upvotepartyparrot.gif',
    'witnessprotectionparrot.gif',
];

foreach($parrots as $parrot)
{
    $name = str_replace(".gif", "", $parrot);
    $src = "http://cultofthepartyparrot.com/parrots/" . $parrot;
    
    echo "  - name: $name
    src: $src
";
    
}