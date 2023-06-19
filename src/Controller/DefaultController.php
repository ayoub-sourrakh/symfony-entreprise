<?php 

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route; // Pour la gestion des routes
use Symfony\Component\HttpFoundation\Response; // pour les réponses http

class DefaultController
{
    #[Route('/default_acueil', name: 'default_acueil')]
    public function index()
    {
        $content = '
            <html>
                <body>
                    <h1>Accueil</h1>
                    <hr>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent bibendum lorem convallis dolor consectetur, vel placerat tortor finibus. Sed imperdiet, mi a sagittis condimentum, mi enim tempus tortor, tempor tincidunt nibh lacus non libero. Morbi commodo metus nec erat lobortis, vel blandit nibh pharetra. Sed est lacus, consequat non egestas in, euismod sed nibh. Cras semper sagittis velit vel sagittis. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Maecenas vehicula leo nec velit euismod, a finibus ipsum rutrum. Cras pharetra diam dolor, porttitor ultrices neque suscipit id.</p>
                </body>
            </html>
        ';

        return  new Response($content);
    }

    #[Route('/default_galerie', name: 'default_galerie')]
    public function galerie()
    {
        $content = '
            <html>
                <body>
                    <h1>Galerie</h1>
                    <hr>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent bibendum lorem convallis dolor consectetur, vel placerat tortor finibus. Sed imperdiet, mi a sagittis condimentum, mi enim tempus tortor, tempor tincidunt nibh lacus non libero. Morbi commodo metus nec erat lobortis, vel blandit nibh pharetra. Sed est lacus, consequat non egestas in, euismod sed nibh. Cras semper sagittis velit vel sagittis. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Maecenas vehicula leo nec velit euismod, a finibus ipsum rutrum. Cras pharetra diam dolor, porttitor ultrices neque suscipit id.</p>
                </body>
            </html>
        ';

        return  new Response($content);
    }
}