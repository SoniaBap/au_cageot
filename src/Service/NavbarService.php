<?php

namespace App\Service;

class NavbarService
{
    public function getVariables(): array
    {

        
        // Votre logique pour générer le tableau avec différentes variables
        $variables = [
            'is_authenticated' => 'Valeur 1',
            'variable2' => 'Valeur 2',
            // ... d'autres variables ...
        ];

        return $variables;
    }
}
