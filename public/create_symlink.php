<?php

if(symlink( __DIR__ . '/public/storage', __DIR__ . '/vilavolks/storage/app/public')){
    echo 'Link simbólico criado com sucesso!';
}else{
    echo 'Erro ao criar link simbólico!';
}
