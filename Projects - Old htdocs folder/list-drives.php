<?PHP
$fso = new COM('Scripting.FileSystemObject');
foreach ($fso->Drives as $drive) {
        var_dump($drive->DriveLetter);
}

?>