<?php
function zipper($space_slug)
{
// Recupération de l'adresse réel du dossier
$rootPath = realpath($space_slug);

// Creation de l'objet ZIP
$zip = new ZipArchive();
/* Ouverture du fichier zip si existant */
$zip->open($space_slug . '.zip', ZipArchive::CREATE | 
ZipArchive::OVERWRITE);

// Creation d'un objet recursif representant le repertoire à zipper
/** @var SplFileInfo[] $files */
$files = new RecursiveIteratorIterator(
    new RecursiveDirectoryIterator($rootPath),
    RecursiveIteratorIterator::SELF_FIRST
);

foreach ($files as $name => $file)
{
    // on passe les repertoires car ils sont deja gerer 
    if (!$file->isDir())
    {
        
        $filePath = $file->getRealPath();
        $relativePath = substr($filePath, strlen($rootPath) + 1);

        $zip->addFile($filePath, $relativePath);
    }
}

// le zip est creer à la fermeture
$zip->close();

}


?>